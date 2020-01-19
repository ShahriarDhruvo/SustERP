<?php
	ini_set('upload_max_filesize', '10M');
	ini_set('post_max_size', '10M');
	ini_set('max_input_time', 300);
	ini_set('max_execution_time', 300);
	date_default_timezone_set('Asia/Dhaka');

	session_start();
    $login_s = false;
    $occupation_s = null;
    $department_s = null;
    $name_s = null; 
    if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        $login_s = $_SESSION['login'];
        $name_s = $_SESSION['name'];
        $department_s = $_SESSION['department']; 
        $occupation_s = $_SESSION['occupation'];
    }

	// Create database connection
	if(!($db = mysqli_connect("localhost", "root", "", "erp_datas")))
		echo "<h2>Connection lost with the database!<br>Check your internet connection or try again later.</h2>";

	// Initialize message variable
	$msg = "Event posted successfully.";
	$time = date("d/m/Y")." ".date("l")." ".date("h:i:sa");

	// If upload button is clicked ...
	if (isset($_POST['upload'])){
		if($login_s && $db){
			$ename = $_POST['ename'];
			$orname = $_POST['orname'];
			$link = $_POST['link'];
            // Get file name
            $name = $_FILES['files']['name'];

            $data = mysqli_query($db, "SELECT MAX(id) FROM events");
            $inc = mysqli_fetch_row($data);
            $id = $inc[0] + 1;

			$file = null;
			if(!empty($name))
				$file = "(".$id.")_".$name;
            
            $edate = $_POST['edate'];
            
            // Get text
			$comment = mysqli_real_escape_string($db, $_POST['comment']);
			
			$_SESSION['event_attachment'] = false;
			$_SESSION['event_link'] = false;

			if(!empty($link))
				$_SESSION['event_link'] = true;

			if(!empty($name))
				$_SESSION['event_attachment'] = true;

			// file directory
			$target = "../files/events/".basename($file);

			$sql = "INSERT INTO events (date, ename, orname, edate, link, files, comments) VALUES ('$time', '$ename', '$orname', '$edate', '$link', '$file', '$comment')";
			
			// execute query
			if(!mysqli_query($db, $sql))
				echo "There is an error while quering.";

			if(!empty($name)){
				if(!move_uploaded_file($_FILES['files']['tmp_name'], $target))
					$msg = "Failed to upload the file, Try again later.";
			}

			echo '<script language="javascript">';
				echo 'alert("'.$msg.'")';
			echo '</script>';
			
			header("refresh: 0.5; url = addEvents.php");
		}
		else echo "<h2>Log in into your account first.</h2>";
	}
	$result = mysqli_query($db, "SELECT * FROM events");
	$authorization = true;

	if(!($occupation_s == "teacher" || $occupation_s == "admin") && $login_s) $authorization = false;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Upload Events</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../../StyleSheets/addAssignments.css">
	</head>
	<body>
		<div id="content">
			<?php
				if(!(mysqli_num_rows($result)) && $login_s && $authorization && $db)
					echo "<h2>Sorry buddy, you haven't uploaded any event yet.....</h2>";
				else if($login_s && $authorization && $db){
					while ($row = mysqli_fetch_array($result)){
						if(($occupation_s == "teacher") || ($occupation_s == "admin")){
							$path = "../files/events/".$row['files'];
							echo "<div id='file_div'>";
								echo "<p>Time: ".$row['date']."<br>Event name: ".$row['ename']."<br>Organized by: ".$row['orname']."<br>Event date: ".$row['edate']."<br>Link: ".$row['link']."<br>File name: 
								".$row['files']."<br> Description: ".$row['comments']."</p>";
								if($row['files'] != null){
									echo "<embed src='$path'></embed>";
									echo "<div>";
										echo "<form target='_blank' action='../files/events/".$row['files']."'>";
											echo "<button type='submit'>View</button>";
										echo "</form>";
									echo "</div>";
								}
								echo "<div>";
									echo "<form method='POST' action='addEvents.php' enctype='multipart/form-data'>";
										echo "<input type='hidden' name='id' value='".$row['id']."'>";
										echo "<input type='hidden' name='files' value='".$row['files']."'>";
										echo "<button type='submit' name='delete'>Delete</button>";
									echo "</form>";
								echo "</div>";
							echo "</div>";
						}
						else echo "<h2>Sorry buddy, you haven't uploaded any event yet.....</h2>";
					}
				}

				if(isset($_POST['delete'])){
					$file_id = $_POST['id'];
					$file_name = ucfirst($_POST['files']);
					$path = "../files/events/".$_POST['files'];

					$sql = "DELETE FROM events WHERE id=$file_id";
					
					if($_POST['files'] != null) unlink($path);

					if (mysqli_query($db, $sql)){
						echo '<script language="javascript">';
                        	echo 'alert("Event deleted successfully.")';
                        echo '</script>';
					}
					else{
						if($file_name == null) $file_name = "the event.";
						echo '<script language="javascript">';
                        	echo 'alert("Error deleting '.$file_name.'")';
                        echo '</script>';
					}
					header("refresh: 0.5; url = addEvents.php");
				}
			?>
			<form method="POST" action="addEvents.php" enctype="multipart/form-data">
				<?php
					if(!$login_s && $db) echo "<h2>Log in into your account first.</h2>";
					else if(!$authorization && $db) echo "<h2>You are not authorize to see the contents of this page.</h2>";
					else if($db){
						echo '
						<input type="hidden" name="size" value="10000000">
						<div>
							<label><b>Event name </b></label>
							<input type="text" name="ename" required>
							<label><b>Organized by </b></label>
							<input type="text" name="orname" required>
							<label><b>Event date</b></label>
							<input type="text" placeholder="Date" name="edate" value="'.$time.'" required>
							<label><b>Attachment </b></label>
							<input type="file" name="files">
							<br>
							<label><b>External Link </b></label>
							<input type="text" name="link">
						</div>
						<div>
							<label><b>Description</b><br></label>
							<textarea 
								id="text" 
								cols="40" 
								rows="4" 
								name="comment" 
								placeholder="Add a description..." required></textarea>
						</div>
						<div>
							<button type="submit" name="upload">Post</button>
						</div>
						';
					}
				?>
			</form>
		</div>
	</body>
</html>