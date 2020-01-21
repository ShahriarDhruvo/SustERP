<!DOCTYPE html>
<html>
	<head>
		<title>Upload Results</title>
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
			h1, h2, h3 {
				text-align: center;
			}
		</style>
	</head>
	<body>
		<div class="container">

            <h1><br>Shahjalal University of Science & Technology.</h1>

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
						$department = htmlspecialchars($_POST['department']);
						$batch = htmlspecialchars($_POST['batch']);
						$year_semes = htmlspecialchars($_POST['year_semes']);
						$course_name = htmlspecialchars($_POST['course_name']);
						
						if($department != $department_s && $occupation_s != "admin")
							echo "<h2>You cannot upload files other than your department's.</h2>";
						else{
							// Get file name
							$name = htmlspecialchars($_FILES['files']['name']);

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

			<h3><br>Upload a result<br><br></h3>

			<form method="POST" action="addResults.php" enctype="multipart/form-data" class="card card-body bg-light">
				<?php
					if(!$login_s && $db) echo "<h2>Log in into your account first.</h2>";
					else if(!$authorization && $db) echo "<h2>You are not authorize to see the contents of this page.</h2>";
					else if($db){
						echo '
						<input type="hidden" name="size" value="10000000">
						<div>   
							<div class="form-group"> 
								<label><b>Department</b></label>
								<select class="form-control" name="department">
									<option value="SWE" selected="selected">SWE</option>
									<option value="CSE">CSE</option>
									<option value="EEE">EEE</option>
									<option value="MEE">MEE</option>
									<option value="CEE">CEE</option>
									<option value="CEP">CEP</option>
									<option value="IPE">IPE</option>
									<option value="PME">PME</option>
								</select>
							</div>
							<div class="form-group">
								<label><b>Batch</b></label>
								<input type="number" placeholder="Batch Year" name="batch" class="form-control">
							</div>
							<div class="form-group">
								<label><b>Year/Semester</b></label>
								<input type="text" placeholder="Enter Semester year/semester format" name="year_semes" class="form-control" required>
							</div>
							<div class="form-group">
								<label><b>Course name</b></label>
								<input type="text" placeholder="Enter the course name" name="course_name" class="form-control" required>
							</div>
							<div class="custom-file">
								<input type="file" name="files" class="custom-file-input" id="inputGroupFile02" required>
								<label class="custom-file-label" for="inputGroupFile02">Choose file...</label>
							</div>
						</div>
						<div>
							<br>
							<button type="submit" class="btn btn-primary" name="upload">Upload</button>
						</div>
						';
					}
				?>
			</form>

			<h3><br><br>Results<br><br></h3>

			<?php
				if(!(mysqli_num_rows($result)) && $login_s && $authorization && $db)
					echo "<h2>Sorry buddy, you haven't uploaded any result yet.....</h2>";
				else if($login_s && $authorization && $db){
					while ($row = mysqli_fetch_array($result)){
						if(($occupation_s == "teacher" && $department_s == $row['department_name']) || ($occupation_s == "admin")){
							$your_assignment = false;
							$path = "../files/results/".$row['files'];
							echo "<div class='card card-body bg-light'>";
								echo "<br>";
								echo "<div class='row'>";
									echo "<div class='col-sm-12 col-md-12 col-lg-4' style='margin-left: 15px;'>";
										echo "<embed width='430px' height='250px' src='$path'></embed>";
									echo "</div>";
									echo "<div class='col-sm-12 col-md-12 col-lg-5 pull-center' style='margin-left: 90px'>";
										echo "<br><p><b>Time: </b>".$row['date']."<br><b>Uploaded By: </b>".ucfirst($row['uploaders_name'])."<br><b>Department: </b>".$row['department_name'].
										"<br><b>Course name: </b>".ucfirst($row['course_name'])."<br><b>Batch: </b>".$row['batch_year']."<br><b>Semester: </b>".$row['semester']."<br><b>File name: </b>
										".$row['files']."</p>";
									echo "</div>";
									echo "<div>";
										echo "<div class='text-right'>";
											echo "<form method='POST' action='addResults.php' enctype='multipart/form-data'>";
												echo "<a class='btn btn-info' target='_blank' href='../files/results/".$row['files']."' style='padding-right: 17px; padding-left: 17px;'>View</a>";
												echo "<input type='hidden' name='id' value='".$row['id']."'>";
												echo "<input type='hidden' name='files' value='".$row['files']."'>";
												echo "<button type='submit' class='btn btn-danger' name='delete' style='margin: 0px 5px 0px 5px;'>Delete</button>";
											echo "</form>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
								echo "<br>";
							echo "</div>";
							echo "<br>";
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
					// header("refresh: 0.5; url = addResults.php");
					echo "<script>location.href='addResults.php'</script>";
				}
			?>
		</div>
		<script>
            $('#inputGroupFile02').on('change',function(){
                //get the file name
                let fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })
        </script>
	</body>
</html>