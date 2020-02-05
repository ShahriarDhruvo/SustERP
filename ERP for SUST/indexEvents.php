<?php

require 'config/db.php';

$result = mysqli_query($conn, "SELECT * FROM events ORDER BY edate, time");
$authorization = true;

if(!($occupation_s == "teacher" || $occupation_s == "student" || $occupation_s == "admin" || $occupation_s == "librarian")) $authorization = false;

if(!$login_s && $conn) echo "<h2>Log in into your account first.</h2>";
else if(!$authorization && $conn) echo "<h2>You are not authorize to see the contents of this page.</h2>";
else if(!(mysqli_num_rows($result)) && $login_s && $authorization  && $conn)
    echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2>";
else if($conn){
    echo "<div id='first_three'>";
        echo "<div class='row'>";
            for($i=0; $i<3; $i++){
                $row1 = mysqli_fetch_array($result);
                if($authorization){
                    $your_assignment = false;
                    $path = "Data/files/events/".$row1['files'];
                    $event_time = date("h:ia", strtotime($row1['time']));
                    $event_date = date("d-m-Y", strtotime($row1['edate']));
                    echo "<div class='col-sm-12 col-md-6 col-lg-4' style='margin-top: 1%;'>";
                        echo "<div class='card bg-light'>";
                            echo "<div class='card-header'>".ucfirst($row1['ename']).
                            "<br>".$event_date." ".$row1['day']." ".$event_time."</div>";
                            echo "<div class='card-body'>";
                                echo "<p><b>Published at: </b>".ucfirst($row1['date'])."<br><b>Organized by: </b>".ucfirst($row1['orname'])."</p>";
                                echo "<form method='POST' target='_blank' action='eventInfo.php' enctype='multipart/form-data'>";
                                    echo "<input type='hidden' name='id' value='".$row1['id']."'>";
                                    echo "<button type='submit' class='btn btn-primary' name='readmore'>Read more</button>";
                                echo "</form>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            }
        echo "</div>";
        if($your_assignment) echo "<h2>Sorry buddy, no event has been uploaded yet.....</h2><br><br><br>";
    echo "</div>";
}