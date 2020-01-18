<?php
    session_start();
    $login = false;
    $name = null;
    $occupation = null;
    $department = null;
    $batch = null;
    if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) {
        $name = $_SESSION['name'];
        $login = $_SESSION['login']; 
        $occupation = $_SESSION['occupation'];
        $department = $_SESSION['department'];
        $batch = $_SESSION['batch'];
    }

    // Create database connection
	$db = mysqli_connect("localhost", "root", "", "erp_datas");
    $result = mysqli_query($db, "SELECT * FROM assignments");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>View Assignments</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../../StyleSheets/addAssignments.css">
	</head>
	<body>
		<div id="content">
            <?php
                if(!(mysqli_num_rows($result)))
                    echo "<h2>Sorry buddy, your assignment hasn't been uploaded yet.....</h2>";
                else if(!$login) echo "<h2>You are logged out from your account</h2>";
                else{
                    while($row = mysqli_fetch_array($result)){
                        if(($occupation == "student" && $department == $row['department_name'] && $batch == $row['batch_year']) || ($occupation == "admin")){
                            $path = "../files/assignments/".$row['files'];
                            echo "<div id='file_div'>";
                                echo "<embed src='$path'></embed>";
                                echo "<p>Time: ".$row['date']."<br>Department: ".$row['department_name']."<br>Batch: ".$row['batch_year']."<br>Semester: ".$row['semester']."<br>Name: 
                                ".$row['files']."<br> Comment: ".$row['comments']."</p>";
                                echo "<div>";
                                    echo "<form target='_blank' action='../files/assignments/".$row['files']."'>";
                                        echo "<button type='submit'>View</button>";
                                    echo "</form>";
                                echo "</div>";
                            echo "</div>";
                        }
                        else echo "<h2>Sorry buddy, your assignment hasn't been uploaded yet.....</h2>";
                    }
                }
			?>
		</div>
	</body>
</html>