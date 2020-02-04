<!-- header -->
<?php include 'header.php'; ?>
<!-- header -->

<!DOCTYPE html>
<html>
	<head>
		<title>Upload Events</title>
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

				// Create database connection
				require 'config/db.php';
				// if(!($conn = mysqli_connect("localhost", "root", "", "erp_datas")))
				// 	echo "<h2>Connection lost with the database!<br>Check your internet connection or try again later.</h2>";

				// Initialize message variable
				$msg = "Event posted successfully.";
				$edate = date("Y-m-d");
				$time = date("h:i");

				// If upload button is clicked ...
				if (isset($_POST['upload'])){
					if($login_s && $conn){
						$ename = htmlspecialchars($_POST['ename']);
						$orname = htmlspecialchars($_POST['orname']);
						$link = null;

						if($_POST['link'] != null)
							$link = '"https://'.$_POST['link'].'/"';

						// Get file name
						$name = htmlspecialchars($_FILES['files']['name']);

						$data = mysqli_query($conn, "SELECT MAX(id) FROM events");
						$inc = mysqli_fetch_row($data);
						$id = $inc[0] + 1;

						$file = null;
						if(!empty($name))
							$file = "(".$id.")_".$name;
						
						$edate = htmlspecialchars($_POST['edate']);
						$time = htmlspecialchars($_POST['time']);
						$timestamp = strtotime($edate);
						$day = date('l', $timestamp);
						
						// Get text
						$comment = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['comment']));
						
						$_SESSION['event_attachment'] = false;
						$_SESSION['event_link'] = false;

						if(!empty($link))
							$_SESSION['event_link'] = true;

						if(!empty($name))
							$_SESSION['event_attachment'] = true;

						// file directory
						$target = "Data/events/".basename($file);
						$curr_time = date("d-m-Y")." ".date("h:ia");

						$sql = "INSERT INTO events (date, day, time, ename, orname, edate, link, files, comments) 
						VALUES ('$curr_time', '$day', '$time', '$ename', '$orname', '$edate', '$link', '$file', '$comment')";
						
						// execute query
						if(!mysqli_query($conn, $sql))
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
				$result = mysqli_query($conn, "SELECT * FROM events ORDER BY edate, time");
				$authorization = true;

				if(!($occupation_s == "teacher" || $occupation_s == "admin") && $login_s) $authorization = false;
			?>

			<h3>Upload an event<br><br></h3>

			<form method="POST" action="addEvents.php" enctype="multipart/form-data" class="card card-body bg-light">
				<?php
					if(!$login_s && $conn) echo "<h2>Log in into your account first.</h2>";
					else if(!$authorization && $conn) echo "<h2>You are not authorize to see the contents of this page.</h2>";
					else if($conn){
						echo '
						<input type="hidden" name="size" value="10000000">
						<div>
							<div class="form-group">
								<label><b>Event name </b></label>
								<input class="form-control" type="text" name="ename" required>
							</div>
							<div class="form-group">
								<label><b>Organized by </b></label>
								<input class="form-control" type="text" name="orname" required>
							</div>
							<br>
							<div class="form-inline">
								<label class="mr-sm-2"><b>Event Date:</b></label>
								<input type="date" max="3000-12-31" min="'.$edate.'" placeholder="Date" name="edate" value="'.$edate.'" class="form-control mb-2 mr-sm-2" required>
								<label class="mr-sm-2"><b>Time:</b></label>
								<input type="time" name="time" value="'.$time.'" class="form-control mb-2 mr-sm-2" required>
							</div>
							<br>
							<div class="form-group">
								<label><b>External Link </b></label>
								<input class="form-control" type="text" name="link">
							</div>
							<div class="custom-file">
								<input type="file" name="files" class="custom-file-input" id="inputGroupFile02">
								<label class="custom-file-label" for="inputGroupFile02">Choose attachment...</label>
							</div>
						</div>
						<div class="form-group">
							<br>
							<label><b>Description</b><br></label>
							<textarea 
								id="text" 
								cols="40" 
								rows="4"
								class="form-control" 
								name="comment" 
								placeholder="Add a description..." required></textarea>
						</div>
						<div>
							<button type="submit" class="btn btn-primary" name="upload">Post</button>
						</div>
						';
					}
				?>
			</form>

			<h3><br><br>Events<br><br></h3>

			<?php
				if(!(mysqli_num_rows($result)) && $login_s && $authorization && $conn)
					echo "<h2>Sorry buddy, you haven't uploaded any event yet.....</h2><br><br><br>";
				else if($login_s && $authorization && $conn){
					while ($row = mysqli_fetch_array($result)){
						if(($occupation_s == "teacher") || ($occupation_s == "admin")){
							$path = "Data/events/".$row['files'];
							$event_time = date("h:ia", strtotime($row['time']));
							$event_date = date("d-m-Y", strtotime($row['edate']));
							echo "<div class='card card-body bg-light'>";
								echo "<br>";
								echo "<div class='row'>";
									echo "<div class='col-sm-12 col-md-12 col-lg-8 pull-center' style='margin-left: 90px'>";
										if($row['link'] != null && $row['files'] != null){
											echo "<p><b>Published at: </b>".$row['date']."<br><b>Event name: </b>".$row['ename']."<br><b>Organized by: </b>".$row['orname']."<br><b>Event date: </b>"
											.$event_date." ".$row['day']." ".$event_time."<br><b>Link: </b><a target='_blank' href=".$row['link'].">Learn more.</a><br><b>File name: 
											</b>".$row['files']."<br><br><b>Description: </b>".$row['comments']."</p>";
										}
										else if($row['link'] != null){
											echo "<p><b>Published at: </b>".$row['date']."<br><b>Event name: </b>".$row['ename']."<br><b>Organized by: </b>".$row['orname']."<br><b>Event date: </b>"
											.$event_date." ".$row['day']." ".$event_time."<br><b>Link: </b><a target='_blank' href=".$row['link'].">Learn more.</a><br><br><b>Description: </b>".$row['comments']."</p>";
										}
										else if($row['files'] != null){
											echo "<p><b>Published at: </b>".$row['date']."<br><b>Event name: </b>".$row['ename']."<br><b>Organized by: </b>".$row['orname']."<br><b>Event date: </b>"
											.$event_date." ".$row['day']." ".$event_time."<br><b>File name: </b>".$row['files']."<br><br><b>Description: </b>".$row['comments']."</p>";
										}
										else{
											echo "<p><b>Published at: </b>".$row['date']."<br><b>Event name: </b>".$row['ename']."<br><b>Organized by: </b>".$row['orname']."<br><b>Event date: </b>"
											.$event_date." ".$row['day']." ".$event_time."<br><br><b>Description: </b>".$row['comments']."</p>";
										}
									echo "</div>";
									if($row['files'] != null){
										// echo "<embed width='430px' height='250px' src='$path'></embed>";
										echo "<div>";
											echo "<a class='btn btn-info' target='_blank' href='Data/events/".$row['files']."' style='margin-left: 68px'>Attachment</a>";
										echo "</div>";
										echo "<div>";
										echo "<form method='POST' action='addEvents.php' enctype='multipart/form-data'>";
											echo "<input type='hidden' name='id' value='".$row['id']."'>";
											echo "<input type='hidden' name='files' value='".$row['files']."'>";
											echo "<button type='submit' class='btn btn-danger' name='delete' style='margin: 0px 5px 0px 5px;'>Delete</button>";
										echo "</form>";
									echo "</div>";
									}
									else{
										echo "<div>";
											echo "<form method='POST' action='addEvents.php' enctype='multipart/form-data'>";
												echo "<input type='hidden' name='id' value='".$row['id']."'>";
												echo "<input type='hidden' name='files' value='".$row['files']."'>";
												echo "<button type='submit' class='btn btn-danger' name='delete' style='margin: 0px 5px 0px 180px;'>Delete</button>";
											echo "</form>";
										echo "</div>";
									}
								echo "</div>";
								echo "<br>";
							echo "</div>";
							echo "<br>";
						}
						else echo "<h2>Sorry buddy, you haven't uploaded any event yet.....</h2><br><br><br>";
					}
				}

				if(isset($_POST['delete'])){
					$file_id = $_POST['id'];
					$file_name = ucfirst($_POST['files']);
					$path = "Data/events/".$_POST['files'];

					$sql = "DELETE FROM events WHERE id=$file_id";
					
					if($_POST['files'] != null) unlink($path);

					if (mysqli_query($conn, $sql)){
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
					// header("refresh: 0.5; url = addEvents.php");
					echo "<script>location.href='addEvents.php'</script>";
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