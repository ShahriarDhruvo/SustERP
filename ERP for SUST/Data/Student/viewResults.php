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
?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Results</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../../StyleSheets/addAssignments.css">
	</head>
	<body>
		<div id="content">
            <h1>Shahjalal University of Science & Technology.</h1>
            <?php
                if(!$login_s && $db) echo "<h2>Log in into your account first.</h2>";
                else if(!$authorization && $db) echo "<h2>You are not authorize to see the contents of this page.</h2>";
                else if(!(mysqli_num_rows($result)) && $login_s && $authorization  && $db)
                    echo "<h2>Sorry buddy, your result hasn't been uploaded yet.....</h2>";
                else if($db){
                    while($row = mysqli_fetch_array($result)){
                        if(($occupation == "student" && $department == $row['department_name'] && $batch == $row['batch_year']) || ($occupation == "admin")){
                            $your_assignment = false;
                            $path = "../files/results/".$row['files'];
                            echo "<div id='file_div'>";
                                echo "<p>Time: ".$row['date']."<br>Uploaded By: ".$row['uploaders_name']."<br>Department: ".$row['department_name']."<br>Course name: ".$row['course_name']."<br>Batch: ".$row['batch_year']."<br>Semester: ".$row['semester']."<br>File name: 
                                ".$row['files']."</p>";
                                echo "<h2>Result: </h2>";
                                echo "<embed src='$path'></embed>";
                                echo "<div>";
                                    echo "<form target='_blank' action='../files/results/".$row['files']."'>";
                                        echo "<button type='submit'>View</button>";
                                    echo "</form>";
                                echo "</div>";
                            echo "</div>";
                        }
                    }
                    if($your_assignment) echo "<h2>Sorry buddy, your result hasn't been uploaded yet.....</h2>";
                }
			?>
		</div>
	</body>
</html>