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
?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Events</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="StyleSheets/addAssignments.css">
	</head>
	<body>
		<div id="content">
            <h1>Shahjalal University of Science & Technology.</h1>
            <?php
                if(!$login_s && $db) echo "<h2>Log in into your account first.</h2>";
                else if(!$authorization && $db) echo "<h2>You are not authorize to see the contents of this page.</h2>";
                else if(!(mysqli_num_rows($result)) && $login_s && $authorization  && $db)
                    echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2>";
                else if($db){
                    while($row = mysqli_fetch_array($result)){
                        if($authorization){
                            $your_assignment = false;
                            $path = "Data/files/events/".$row['files'];
                            echo "<div id='file_div'>";
                                echo "<p>Time: ".$row['date']."<br>Event name: ".$row['ename']."<br>Organized by: ".$row['orname']."<br>Event date: ".$row['edate']."<br>Link: ".$row['link']."<br>File name: 
                                ".$row['files']."<br> Description: ".$row['comments']."</p>";
                                if($row['files'] != null){
                                    echo "<embed src='$path'></embed>";
                                    echo "<div>";
                                        echo "<form target='_blank' action='$path'>";
                                            echo "<button type='submit'>View</button>";
                                        echo "</form>";
                                    echo "</div>";
                                }
                            echo "</div>";
                        }
                    }
                    if($your_assignment) echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2>";
                }
			?>
		</div>
	</body>
</html>