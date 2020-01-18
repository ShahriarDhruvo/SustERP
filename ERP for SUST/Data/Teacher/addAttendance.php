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
    if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        $login_s = $_SESSION['login']; 
        $occupation_s = $_SESSION['occupation'];
        $department_s = $_SESSION['department'];
    }

	// Create database connection
	$db = mysqli_connect("localhost", "root", "", "erp_datas");

	// Initialize message variable
	$msg = "";

	// If upload button is clicked ...
	if (isset($_POST['upload'])){
		if($login_s){
			$department = $_POST['department'];
			$batch = $_POST['batch'];
			$year_semes = $_POST['year_semes'];
			
			if($department != $department_s)
				echo "<h2>You cannot upload files other than your department's.</h2>";
			else{
				// Get file name
				$name = $_FILES['files']['name'];

				$data = mysqli_query($db, "SELECT MAX(id) FROM attendance");
				$inc = mysqli_fetch_row($data);
				$id = $inc[0] + 1;

				$file = "(".$id.")_".$name;
				
				$time = date("d/m/Y")." ".date("l")." ".date("h:i:sa");
				
				// Get text
				$comment = mysqli_real_escape_string($db, $_POST['comment']);

				if(!empty($name)){
					// file directory
					$target = "../files/attendance/".basename($file);

					$sql = "INSERT INTO attendance (date, department_name, batch_year, semester, files, comments) VALUES ('$time', '$department', '$batch', '$year_semes', '$file', '$comment')";
					
					// execute query
					if(!mysqli_query($db, $sql))
						echo "There is an error while quering.";

					if(move_uploaded_file($_FILES['files']['tmp_name'], $target))
						$msg = "File uploaded successfully";
					else
						$msg = "Failed to upload the file, Try again later.";

					echo '<script language="javascript">';
					echo 'alert("'.$msg.'")';
					echo '</script>';
				}
				else{
					echo '<script language="javascript">';
						echo 'alert("Select a file to upload!")';
					echo '</script>';
				}
			}
		}
		else echo "<h2>You logged out from your account</h2>";
	}
	$result = mysqli_query($db, "SELECT * FROM attendance");
?>
<?php
	if(!($occupation_s == "teacher" || $occupation_s == "admin") && $login_s)
		echo "<h2>You are not authorize to see the contents of this page.</h2>";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Upload Attendance</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../../StyleSheets/addAssignments.css">
	</head>
	<body>
		<div id="content">
			<?php
				if(!(mysqli_num_rows($result)))
					echo "<h2>Sorry buddy, you haven't uploaded any attendance yet.....</h2>";
				else if(!$login_s) echo "<h2>You logged out from your account</h2>";
				else{
					while ($row = mysqli_fetch_array($result)){
						if(($occupation_s == "teacher" && $department_s == $row['department_name']) || ($occupation_s == "admin")){
							$path = "../files/attendance/".$row['files'];
							echo "<div id='file_div'>";
								echo "<embed src='$path'></embed>";
								echo "<p>Time: ".$row['date']."<br>Department: ".$row['department_name']."<br>Batch: ".$row['batch_year']."<br>Semester: ".$row['semester']."<br>Name: ".$row['files']."<br> Comment: ".$row['comments']."</p>";
								echo "<div>";
									echo "<form target='_blank' action='../files/attendance/".$row['files']."'>";
										echo "<button type='submit'>View</button>";
									echo "</form>";
									echo "<form method='POST' action='addAttendance.php' enctype='multipart/form-data'>";
										echo "<input type='hidden' name='id' value='".$row['id']."'>";
										echo "<input type='hidden' name='files' value='".$row['files']."'>";
										echo "<button type='submit' name='delete'>Delete</button>";
									echo "</form>";
								echo "</div>";
							echo "</div>";
						}
						else echo "<h2>Sorry buddy, you haven't uploaded any attendance yet.....</h2>";
					}
				}

				if(isset($_POST['delete'])){
					$file_id = $_POST['id'];
					$file_name = ucfirst($_POST['files']);
					$path = "../files/attendance/".$_POST['files'];

					$sql = "DELETE FROM attendance WHERE id=$file_id";
			
					if (mysqli_query($db, $sql) && unlink($path)){
						echo '<script language="javascript">';
                        	echo 'alert("'.$file_name.' deleted successfully.")';
                        echo '</script>';
					}
					else{
						echo '<script language="javascript">';
                        	echo 'alert("Error deleting '.$file_name.'")';
                        echo '</script>';
					}
					header("refresh: 0.5; url = addAttendance.php");
				}
			?>
			<form method="POST" action="addAttendance.php" enctype="multipart/form-data">
				<input type="hidden" name="size" value="10000000">
				<div>   
                    <label class=""><b>Department</b></label>
                    <select class="" name="department">
                        <option value="SWE" selected="selected">SWE</option>
                        <option value="CSE">CSE</option>
                        <option value="EEE">EEE</option>
                        <option value="MEE">MEE</option>
                        <option value="CEE">CEE</option>
                        <option value="CEP">CEP</option>
                        <option value="IPE">IPE</option>
                        <option value="PME">PME</option>
                    </select>

                    <label><b>Batch</b></label>
                    <input type="number" placeholder="Batch Year" name="batch">

                    <label><b>Year/Semester</b></label>
                    <input type="text" placeholder="Enter Semester year/semester format" name="year_semes" required>

                    <input type="file" name="files">
				</div>
				<div>
					<textarea 
						id="text" 
						cols="40" 
						rows="4" 
						name="comment" 
						placeholder="Leave a comment..."></textarea>
				</div>
				<div>
					<button type="submit" name="upload">Upload</button>
				</div>
			</form>
		</div>
	</body>
</html>