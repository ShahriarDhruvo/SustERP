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
		<div>
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
                require 'config/db.php';
                // if(!($conn = mysqli_connect("localhost", "root", "", "erp_datas")))
                //     echo "<h2>Connection lost with the database!<br>Check your internet connection or try again later.</h2>";

                $result = mysqli_query($conn, "SELECT * FROM events ORDER BY edate, time LIMIT 3, 4");
                $authorization = true;
            
                if(!($occupation == "teacher" || $occupation == "student" || $occupation == "admin" || $occupation == "librarian")) $authorization = false;

                if(!$login_s && $conn) echo "<h2>Log in into your account first.</h2>";
                else if(!$authorization && $conn) echo "<h2>You are not authorize to see the contents of this page.</h2>";
                else if(!(mysqli_num_rows($result)) && $login_s && $authorization  && $conn)
                    echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2>";
                else if($conn){
                    echo "<div class='row'>";
                        while($row = mysqli_fetch_array($result)){
                            if($authorization){
                                $your_assignment = false;
                                $path = "Data/files/events/".$row['files'];
                                $event_time = date("h:ia", strtotime($row['time']));
                                $event_date = date("d-m-Y", strtotime($row['edate']));
                                echo "<div class='col-sm-12 col-md-6 col-lg-4' style='margin-top: 1%;'>";
                                    echo "<div class='card bg-light'>";
                                        echo "<div class='card-header'>".ucfirst($row['ename']).
                                        "<br>".$event_date." ".$row['day']." ".$event_time."</div>";
                                        echo "<div class='card-body'>";
                                            echo "<p><b>Published at: </b>".ucfirst($row['date'])."<br><b>Organized by: </b>".ucfirst($row['orname'])."</p>";
                                            echo "<form method='POST' target='_blank' action='eventInfo.php' enctype='multipart/form-data'>";
                                                echo "<input type='hidden' name='id' value='".$row['id']."'>";
                                                echo "<button type='submit' class='btn btn-primary' name='readmore'>Read more</button>";
                                            echo "</form>";
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            }
                        }
                    echo "</div>";
                    if($your_assignment) echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2><br><br><br>";
                }
			?>
		</div>
	</body>
</html>