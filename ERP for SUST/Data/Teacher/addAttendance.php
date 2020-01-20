<!DOCTYPE html>
<html>
	<head>
		<title>Upload Attendance</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
		<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
		<link rel="stylesheet" href="../../StyleSheets/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="../../Scripts/bootstrap.min.js"></script>
		<!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->
		<style>
			h2, h3 {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<?php
				ini_set('upload_max_filesize', '10M');
				ini_set('post_max_size', '10M');
				ini_set('max_input_time', 300);
				ini_set('max_execution_time', 300);
				date_default_timezone_set('Asia/Dhaka');
			
				session_start();
				$login_s = false;
				$your_assignment = true;
				$occupation_s = null;
				$department_s = null;
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
				$time = date("d/m/Y")." ".date("l")." ".date("h:i:sa");
			
				// If upload button is clicked ...
				if (isset($_POST['upload'])){
					if($login_s && $db){
						$department = $_POST['department'];
						$batch = $_POST['batch'];
						$year_semes = $_POST['year_semes'];
						$course_name = $_POST['course_name'];
						$time = $_POST['time'];
						
						if($department != $department_s && $occupation_s != "admin")
							echo "<h2>You cannot upload files other than your department's.</h2>";
						else{
							// Get file name
							$name = $_FILES['files']['name'];
			
							$data = mysqli_query($db, "SELECT MAX(id) FROM attendance");
							$inc = mysqli_fetch_row($data);
							$id = $inc[0] + 1;
			
							$file = "(".$id.")_".$name;
							
							// Get text
							$comment = mysqli_real_escape_string($db, $_POST['comment']);
			
							if(!empty($name)){
								// file directory
								$target = "../files/attendance/".basename($file);
			
								$sql = "INSERT INTO attendance (date, uploaders_name, department_name, batch_year, semester, course_name, files, comments) VALUES ('$time', '$name_s', '$department', '$batch', '$year_semes', '$course_name', '$file', '$comment')";
								
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
			
								header("refresh: 0.5; url = addAttendance.php");
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
				$result = mysqli_query($db, "SELECT * FROM attendance");
				$authorization = true;
			
				if(!($occupation_s == "teacher" || $occupation_s == "admin") && $login_s) $authorization = false;

				echo "<h3><br>Upload an attendance<br><br></h3>";

				if(!(mysqli_num_rows($result)) && $login_s && $authorization && $db)
					echo "<h2>Sorry buddy, you haven't uploaded any attendance yet.....</h2>";
				else if($login_s && $authorization && $db){
					while ($row = mysqli_fetch_array($result)){
						if(($occupation_s == "teacher" && $department_s == $row['department_name']) || ($occupation_s == "admin")){
							$your_assignment = false;
							$path = "../files/attendance/".$row['files'];
							echo "<div id='file_div'>";
								echo "<embed src='$path'></embed>";
								echo "<p>Time: ".$row['date']."<br>Uploaded By: ".$row['uploaders_name']."<br>Department: ".$row['department_name']."<br>Course name: ".$row['course_name']."<br>Batch: ".$row['batch_year']."<br>Semester: ".$row['semester']."<br>File name: 
								".$row['files']."<br>Comment: ".$row['comments']."</p>";
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
					}
					if($your_assignment) echo "<h2>Sorry buddy, you haven't uploaded any attendance yet.....</h2>";
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

							<label><b>Date</b></label>
							<input type="text" placeholder="Date" name="time" value="'.$time.'" required>

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
						';
					}
				?>
			</form>
		</div>
	</body>
</html>