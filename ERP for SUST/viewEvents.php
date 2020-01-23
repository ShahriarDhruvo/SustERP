<!DOCTYPE html>
<html>
	<head>
		<title>View Events</title>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="StyleSheets/index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
            <?php
                session_start();
                $login_s = false;
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
                $result = mysqli_query($db, "SELECT * FROM events");
                $authorization = true;
            
                if(!($occupation == "teacher" || $occupation == "student" || $occupation == "admin" || $occupation == "librarian")) $authorization = false;

                if(!$login_s && $db) echo "<h2>Log in into your account first.</h2>";
                else if(!$authorization && $db) echo "<h2>You are not authorize to see the contents of this page.</h2>";
                else if(!(mysqli_num_rows($result)) && $login_s && $authorization  && $db)
                    echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2>";
                else if($db){
                    while($row = mysqli_fetch_array($result)){
                        if($authorization){
                            $your_assignment = false;
                            $path = "Data/files/events/".$row['files'];
                            echo "<div class='card card-body bg-light'>";
								echo "<br>";
								echo "<div class='row'>";
									echo "<div class='col-sm-12 col-md-12 col-lg-12 pull-center' style='margin-left: 90px'>";
                                        echo "<p><b>Time: </b>".$row['date']."<br><b>Event name: </b>".$row['ename']."<br><b>Organized by: </b>".$row['orname']."</p>";
                                    echo "</div>";
                                    echo "<form method='POST' target='_blank' action='eventInfo.php' enctype='multipart/form-data'>";
                                        echo "<input type='hidden' name='id' value='".$row['id']."'>";
                                        echo "<button type='submit' class='btn btn-info' name='readmore' style='margin-left: 105px;'>Read more</button>";
                                    echo "</form>";
								echo "</div>";
							echo "</div>";
							echo "<br>";



                            // echo "<div id='file_div'>";
                            //     echo "<p>Time: ".$row['date']."<br>Event name: ".$row['ename']."<br>Organized by: ".$row['orname']."</p>";
                            //     echo "<div class=''>";
                            //         echo "<form method='POST' target='_blank' action='eventInfo.php' enctype='multipart/form-data'>";
                            //             echo "<input type='hidden' name='id' value='".$row['id']."'>";
                            //             echo "<button type='submit' class='btn btn-info' name='readmore' style='margin: 0px 5px 0px 5px;'>Read more</button>";
                            //         echo "</form>";
                            //     echo "</div>";
                            // echo "</div>";
                        }
                    }
                    if($your_assignment) echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2>";
                }
			?>
		</div>
	</body>
</html>