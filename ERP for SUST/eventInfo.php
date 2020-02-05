<?php 
    require 'config/db.php';
    include 'header.php'
?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Events</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="StyleSheets/main.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">

            <!-- <h1><br>Shahjalal University of Science & Technology.<br><br></h1> -->

            <?php
                $your_assignment = true;
				$file_id = null;
				
				if(isset($_POST['readmore']))
					$file_id = $_POST['id'];
            
				// Create database connection
				// require 'config/db.php';
                // if(!($conn = mysqli_connect("localhost", "root", "", "erp_datas")))
				// 	echo "<h2>Connection lost with the database!<br>Check your internet connection or try again later.</h2>";
					
                $result = mysqli_query($conn, "SELECT * FROM events");
                $authorization = true;
            
                if(!($occupation_s == "teacher" || $occupation_s == "student" || $occupation_s == "admin" || $occupation_s == "librarian")) $authorization = false;

                if(!$login_s && $conn) echo "<h2>Log in into your account first.</h2>";
                else if(!$authorization && $conn) echo "<h2>You are not authorize to see the contents of this page.</h2>";
                else if(!(mysqli_num_rows($result)) && $login_s && $authorization  && $conn)
                    echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2>";
                else if($conn){
                    while($row = mysqli_fetch_array($result)){
                        if($authorization && $file_id == $row['id']){
                            $your_assignment = false;
							$path = "Data/events/".$row['files'];
							$event_time = date("h:ia", strtotime($row['time']));
							$event_date = date("d-m-Y", strtotime($row['edate']));
							echo "<h1>Event name: </b>".$row['ename']."</h1>";
							echo "<div class='card card-body bg-light'>";
								echo "<br>";
								echo "<div class='row'>";
									echo "<div class='col-sm-12 col-md-12 col-lg-8 pull-center' style='margin-left: 90px'>";
										if($row['link'] != null){
											echo "<p><b>Published at: </b>".$row['date']."<br><b>Organized by: </b>".$row['orname']."<br><b>Event date: </b>"
											.$event_date." ".$row['day']." ".$event_time."<br><b>Link: </b><a target='_blank' href=".$row['link'].">Learn more.</a><br><br><b>Description: </b>".$row['comments']."</p>";
										}
										else{
											echo "<p><b>Published at: </b>".$row['date']."<br><b>Organized by: </b>".$row['orname']."<br><b>Event date: </b>"
											.$event_date." ".$row['day']." ".$event_time."<br><br><b>Description: </b>".$row['comments']."</p>";
										}
									echo "</div>";
									if($row['files'] != null){
										// echo "<embed width='430px' height='250px' src='$path'></embed>";
										echo "<div>";
											echo "<a class='btn btn-info' target='_blank' href='Data/events/".$row['files']."' style='margin-left: 145px'>Attachment</a>";
										echo "</div>";
									}
								echo "</div>";
								echo "<br>";
							echo "</div>";
							echo "<br>";
							break;
                        }
                    }
                    if($your_assignment) echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2>";
                }
			?>
		</div>
        <script>
            $(".dropdown").click(function(){
                $(".toggle").fadeToggle(1000);
            });
        </script>
	</body>
</html>