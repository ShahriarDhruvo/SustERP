<!DOCTYPE html>
<html>
	<head>
		<title>View Results</title>
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
                session_start();
                $login = false;
                $name = null;
                $occupation = null;
                $department = null;
                $your_assignment = true;
                $batch = null;
                if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) {
                    $name = $_SESSION['name'];
                    $login_s = $_SESSION['login']; 
                    $occupation = $_SESSION['occupation'];
                    $department = $_SESSION['department'];
                    $batch = $_SESSION['batch'];
                }
            
                // Create database connection
                if(!($db = mysqli_connect("localhost", "root", "", "erp_datas")))
                    echo "<h2>Connection lost with the database!<br>Check your internet connection or try again later.</h2>";
                $result = mysqli_query($db, "SELECT * FROM results");
                $authorization = true;
            
                if(!($occupation == "teacher" || $occupation == "student" || $occupation == "admin")) $authorization = false;
                
                if(!$login_s && $db) echo "<h2>Log in into your account first.</h2>";
                else if(!$authorization && $db) echo "<h2>You are not authorize to see the contents of this page.</h2>";
                else if(!(mysqli_num_rows($result)) && $login_s && $authorization  && $db)
                    echo "<h2>Sorry buddy, your result hasn't been uploaded yet.....</h2>";
                else if($db){
                    while($row = mysqli_fetch_array($result)){
                        if(($occupation == "student" && $department == $row['department_name'] && $batch == $row['batch_year']) || ($occupation == "admin")){
                            $your_assignment = false;
                            $path = "../files/results/".$row['files'];
                            echo "<br><br><br><h2>Result: </h2><br>";
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
											echo "<form method='POST' action='addAssignments.php' enctype='multipart/form-data'>";
												echo "<a class='btn btn-info' target='_blank' href='../files/assignments/".$row['files']."' style='margin-left: 90px;'>View</a>";
											echo "</form>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
								echo "<br>";
							echo "</div>";
                            echo "<br>"; 
                        }
                    }
                    if($your_assignment) echo "<h2>Sorry buddy, your result hasn't been uploaded yet.....</h2>";
                }
			?>
		</div>
	</body>
</html>