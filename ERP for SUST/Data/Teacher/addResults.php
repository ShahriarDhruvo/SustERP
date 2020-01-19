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
	$your_assignment = true;
	$name_s = null;
    if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) {
		$login_s = $_SESSION['login']; 
		$name_s = $_SESSION['name'];
        $occupation_s = $_SESSION['occupation'];
        $department_s = $_SESSION['department'];
    }

	// Create database connection
	if(!($db = mysqli_connect("localhost", "root", "", "erp_datas")))
		echo "<h2>Connection lost with the database!<br>Check your internet connection or try again later.</h2>";

	// Initialize message variable
	$msg = "";

	// If upload button is clicked ...
	if (isset($_POST['upload'])){
		if($login_s && $db){
			$department = $_POST['department'];
			$batch = $_POST['batch'];
			$year_semes = $_POST['year_semes'];
			$course_name = $_POST['course_name'];
			
			if($department != $department_s && $occupation_s != "admin")
				echo "<h2>You cannot upload files other than your department's.</h2>";
			else{
				// Get file name
				$name = $_FILES['files']['name'];

				$data = mysqli_query($db, "SELECT MAX(id) FROM results");
				$inc = mysqli_fetch_row($data);
				$id = $inc[0] + 1;

				$file = "(".$id.")_".$name;
				
				$time = date("d/m/Y")." ".date("l")." ".date("h:i:sa");

				if(!empty($name)){
					// file directory
					$target = "../files/results/".basename($file);

					$sql = "INSERT INTO results (date, uploaders_name, department_name, course_name, batch_year, semester, files) VALUES ('$time', '$name_s', '$department', '$course_name', '$batch', '$year_semes', '$file')";
					
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

					header("refresh: 0.5; url = addResults.php");
				}
				else{
					echo '<script language="javascript">';
						echo 'alert("Select a file to upload!")';
					echo '</script>';
				} 
			}
		}
		else echo "<h2>Log in into your account first.</h2>";
	}
	$result = mysqli_query($db, "SELECT * FROM results");
	$authorization = true;

	if(!($occupation_s == "teacher" || $occupation_s == "admin") && $login_s) $authorization = false;
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Upload Results</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../../StyleSheets/addAssignments.css">
	</head>
	<body>
		<div id="content">
            <h1>Shahjalal University of Science & Technology.</h1>
			<?php
				if(!(mysqli_num_rows($result)) && $login_s && $authorization && $db)
					echo "<h2>Sorry buddy, you haven't uploaded any result yet.....</h2>";
				else if($login_s && $authorization && $db){
					while ($row = mysqli_fetch_array($result)){
						if(($occupation_s == "teacher" && $department_s == $row['department_name']) || ($occupation_s == "admin")){
							$your_assignment = false;
							$path = "../files/results/".$row['files'];
							echo "<div id='file_div'>";
								echo "<p>Time: ".$row['date']."<br>Uploaded By: ".$row['uploaders_name']."<br>Department: ".$row['department_name']."<br>Course name: ".$row['course_name']."<br>Batch: ".$row['batch_year']."<br>Semester: ".$row['semester']."<br>File name: 
                                ".$row['files']."</p>";
                                echo "<embed src='$path'></embed>";
								echo "<div>";
									echo "<form target='_blank' action='../files/results/".$row['files']."'>";
										echo "<button type='submit'>View</button>";
									echo "</form>";
									echo "<form method='POST' action='addResults.php' enctype='multipart/form-data'>";
										echo "<input type='hidden' name='id' value='".$row['id']."'>";
										echo "<input type='hidden' name='files' value='".$row['files']."'>";
										echo "<button type='submit' name='delete'>Delete</button>";
									echo "</form>";
								echo "</div>";
							echo "</div>";
						}
					}
					if($your_assignment) echo "<h2>Sorry buddy, you haven't uploaded any result yet.....</h2>";
				}

				if(isset($_POST['delete'])){
					$file_id = $_POST['id'];
					$file_name = ucfirst($_POST['files']);
					$path = "../files/results/".$_POST['files'];

					$sql = "DELETE FROM results WHERE id=$file_id";
			
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
					header("refresh: 0.5; url = addResults.php");
				}
			?>
			<form method="POST" action="addResults.php" enctype="multipart/form-data">
				<?php
					if(!$login_s && $db) echo "<h2>Log in into your account first.</h2>";
					else if(!$authorization && $db) echo "<h2>You are not authorize to see the contents of this page.</h2>";
					else if($db){
						echo '
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

							<label><b>Course name </b></label>
							<input type="text" placeholder="Enter the course name" name="course_name" required>

							<input type="file" name="files">
						</div>
						<div>
							<button type="submit" name="upload">Upload</button>
						</div>
						';
					}
				?>
			</form>
		</div>
	</body>
</html>