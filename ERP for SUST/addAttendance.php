<?php 
    require 'config/db.php';
    include 'header.php'
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Upload Attendance</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="StyleSheets/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<?php
				ini_set('upload_max_filesize', '10M');
				ini_set('post_max_size', '10M');
				ini_set('max_input_time', 300);
				ini_set('max_execution_time', 300);
				date_default_timezone_set('Asia/Dhaka');
			
				$your_assignment = true;
			
				// Initialize message variable
				$msg = "";
				$date = date("d/m/Y")." ".date("l")." ".date("h:i:sa");
			
				// If upload button is clicked ...
				if (isset($_POST['upload'])){
					if($login_s && $conn){
						$department = htmlspecialchars($_POST['department']);
						$batch = htmlspecialchars($_POST['batch']);
						$year_semes = $_POST['year']."/".$_POST['semes'];
						$course_name = htmlspecialchars($_POST['course_name']);
						
						if($department != $department_s && $occupation_s != "admin")
							echo "<h2>You cannot upload files other than your department's.</h2>";
						else{
							// Get file name
							$name = htmlspecialchars($_FILES['files']['name']);
			
							$data = mysqli_query($conn, "SELECT MAX(id) FROM attendance");
							$inc = mysqli_fetch_row($data);
							$id = $inc[0] + 1;
			
							$file = "(".$id.")_".$name;
							
							// Get text
							$comment = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['comment']));
			
							if(!empty($name)){
								// file directory
								$target = "Data/attendance/".basename($file);
			
								$sql = "INSERT INTO attendance (date, uploaders_name, department_name, batch_year, semester, course_name, files, comments) 
								VALUES ('$date', '$name_s', '$department', '$batch', '$year_semes', '$course_name', '$file', '$comment')";
								
								// execute query
								if(!mysqli_query($conn, $sql))
									echo "There is an error while quering.";
			
								if(move_uploaded_file($_FILES['files']['tmp_name'], $target))
									$msg = "File uploaded successfully";
								else
									$msg = "Failed to upload the file, Try again later.";
			
								echo '<script language="javascript">';
								echo 'alert("'.$msg.'")';
								echo '</script>';
			
								$URL="addAttendance.php";
								echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
								echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';
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
				if(!($occupation_s == "admin"))
					$ssql = "SELECT * FROM attendance WHERE uploaders_name = '$name_s'";
				else $ssql = "SELECT * FROM attendance";

				$search_term = null;
				$filter = null;

				if(isset($_POST['search'])){
					$search_term = htmlspecialchars($_POST['search_box']);
					$filter = $_POST['filter'];

					if($filter == "1")
						$ssql .= " WHERE CONCAT(date, uploaders_name, department_name, batch_year, semester, course_name, files, comments) LIKE '%".$search_term."%'";
					else if($filter == "2")
						$ssql .= " WHERE department_name LIKE '%".$search_term."%'";
					else if($filter == "3")
						$ssql .= " WHERE batch_year LIKE '%".$search_term."%'";
					else if($filter == "4")
						$ssql .= " WHERE semester LIKE '%".$search_term."%'";
					else if($filter == "5")
						$ssql .= " WHERE course_name LIKE '%".$search_term."%'";
				}

				if(!$result = mysqli_query($conn, $ssql)) echo mysqli_error($conn);

				$authorization = true;
			
				if(!($occupation_s == "teacher" || $occupation_s == "admin") && $login_s) $authorization = false;
			?>

			<h3>Upload an attendance<br><br></h3>

			<form method="POST" action="addAttendance.php" enctype="multipart/form-data" class="card card-body bg-light">
				<?php
					if(!$login_s && $conn) echo "<h2>Log in into your account first.</h2><br><br><br>";
					else if(!$authorization && $conn) echo "<h2>You are not authorize to see the contents of this page.</h2><br><br><br>";
					else if($conn){
						$year = date("Y")-1;
						echo '
						<input type="hidden" name="size" value="10000000">
						<div>
							<div class="form-group">
								<label><b>Course name</b></label>
								<input type="text" placeholder="Enter the course name" name="course_name" class="form-control" required>
							</div>

							<div class="form-group">
								<div class="custom-file">
									<input type="file" name="files" class="custom-file-input" id="inputGroupFile02" required>
									<label class="custom-file-label" for="inputGroupFile02">Choose file...</label>
								</div>
							</div>
							
							<div class="form-group" style="margin-right: 2%;">
								<div class="form-inline">
									<label class="mr-sm-2"><b>Department</b></label>
									<select class="form-control mb-2 mr-sm-4" name="department">
										<option value="SWE" selected="selected">SWE</option>
										<option value="CSE">CSE</option>
										<option value="EEE">EEE</option>
										<option value="MEE">MEE</option>
										<option value="CEE">CEE</option>
										<option value="CEP">CEP</option>
										<option value="IPE">IPE</option>
										<option value="PME">PME</option>
									</select>

									<label class="mr-sm-2"><b>Batch</b></label>
									<input type="number" min="1986" max="'.$year.'" value="'.$year.'" placeholder="Batch Year" name="batch" class="form-control mb-2 mr-sm-4">

									<label class="mr-sm-2"><b>Year</b></label>
									<input type="number" min="1" max="4" placeholder="Year" name="year" class="form-control mb-2 mr-sm-4" value="1" required>

									<label class="mr-sm-2"><b>Semester</b></label>
									<input type="number" min="1" max="2" placeholder="Semester" name="semes" class="form-control mb-2 mr-sm-4" value="1" required>
								</div>
							</div>
						</div>
						<div>
							<textarea 
								id="text" 
								cols="40" 
								rows="4" 
								class="form-control"
								name="comment" 
								placeholder="Leave a comment..."></textarea><br>
						</div>
						<div>
							<button type="submit" class="btn btn-primary" name="upload">Upload</button>
						</div>
						';
					}
				?>
			</form>

			<!-- search -->
			<div style="margin-top: 10%;">
				<form method="POST" action="addAttendance.php" enctype="multipart/form-data" class="card card-body bg-light">
					<div class="form-inline">
						<input type="text" class="form-control mr-sm-4" placeholder="Search" name="search_box" value="<?php echo $search_term; ?>" style="width: 74%;">

						<select class="form-control mr-sm-4" name="filter">
							<option <?php if($filter == 1) echo 'selected'; ?> value="1">All</option>
							<option <?php if($filter == 2) echo 'selected'; ?> value="2">Department</option>
							<option <?php if($filter == 3) echo 'selected'; ?> value="3">Batch</option>
							<option <?php if($filter == 4) echo 'selected'; ?> value="4">Year/Semester</option>
							<option <?php if($filter == 5) echo 'selected'; ?> value="5">Course</option>
						</select>

						<button class="btn btn-primary" type="submit" name="search">Search</button>
					</div>
				</form>
			</div>
			<!-- search -->
			
			<div style="margin-top: 10%;">
				<h3>Attendance</h3>
			</div>

			<?php
				if(!(mysqli_num_rows($result)) && $login_s && $authorization && $conn)
					echo "<h2>Sorry buddy, you haven't uploaded any attendance yet.....</h2><br><br><br>";
				else if($login_s && $authorization && $conn){
					while ($row = mysqli_fetch_array($result)){
						if(($occupation_s == "teacher" && $department_s == $row['department_name']) || ($occupation_s == "admin")){
							$your_assignment = false;
							$path = "Data/attendance/".$row['files'];
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
											echo "<form method='POST' action='addAttendance.php' enctype='multipart/form-data'>";
												echo "<a class='btn btn-info' target='_blank' href='Data/attendance/".$row['files']."' style='padding-right: 17px; padding-left: 17px;'>View</a>";
												echo "<input type='hidden' name='id' value='".$row['id']."'>";
												echo "<input type='hidden' name='files' value='".$row['files']."'>";
												echo "<button type='submit' class='btn btn-danger' name='delete' style='margin: 0px 5px 0px 5px;'>Delete</button>";
											echo "</form>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
								echo "<div class='col-lg-12'>";
									echo "<br><b>Comment: </b>".ucfirst($row['comments'])."</p>";
								echo "</div>";
							echo "</div>";
							echo "<br>";
						}
					}
					if($your_assignment) echo "<h2>Sorry buddy, you haven't uploaded any attendance yet.....</h2><br><br><br>";
				}

				if(isset($_POST['delete'])){
					$file_id = $_POST['id'];
					$file_name = ucfirst($_POST['files']);
					$path = "Data/attendance/".$_POST['files'];

					$sql = "DELETE FROM attendance WHERE id=$file_id";
			
					if (mysqli_query($conn, $sql) && unlink($path)){
						echo '<script language="javascript">';
							echo 'alert("'.$file_name.' deleted successfully.")';
						echo '</script>';
					}
					else{
						echo '<script language="javascript">';
							echo 'alert("Error deleting '.$file_name.'")';
						echo '</script>';
					}

					$URL="addAttendance.php";
					echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
					echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';
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

		<?php include 'footer.php'; ?>
	</body>
</html>