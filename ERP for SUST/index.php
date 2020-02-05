<?php 
    require 'config/db.php';
    require_once 'controllers/authController.php';
    include 'header.php';
?>

<html lang="en">

<head>
    <title>SustERP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container" id="container01">
        <!-- <script>
            // alert("Safari doesn't support certain things that are used in this website, so we recommend to use any chromium based browser, firefox or opera.");
            alert("If you are using safari then use any chromium based browser, firefox or opera, because safari doesn't support certain things that we care about.");
        </script> -->

        <?php
            // Verify user using token
            if(isset($_GET['token'])){
                $token = $_GET['token'];
                verifyUser($token);
            }

            // Grabbing token for reset-password
            if(isset($_GET['password-token'])){
                $passwordToken = $_GET['password-token'];
                resetPassword($passwordToken);
            }

            // if(!isset($_SESSION['login'])){
            //     $URL="login.php";
            //     echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            //     echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';

            //     // header("location: login.php");
            //     exit();
            // }
        ?>
         
        <div class="row">   
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="flip-card">
                    <div class="flip-card-inner"> 
                        <div class="flip-card-front img-thumbnail">
                            <img class="img-responsive" src="Img/Avatars/avatar_teacher.png" alt="Teacher-Avatar" style="width: 290px; height: 290px;">
                            <h2><br>Teacher</h2>
                        </div>
            
                        <div class="flip-card-back img-thumbnail">
                            <ul>
                                <?php 
                                    if(($occupation_s == "teacher" || $occupation_s == "admin") && $login_s){
                                        echo '
                                        <div class="card-back-element">
                                            <li><a href="addAssignments.php">Add Assignment</a></li>
                                            
                                            <li><a href="addAttendance.php">Add Attendance</a></li>
                                            
                                            <li><a href="addResults.php">Add Result</a></li>
                        
                                            <li><a href="addEvents.php">Add Event</a></li>
                                        </div>';
                                    } 
                                    else if(!$login_s)
                                        echo "<div class='non-auth'> <h4>Log In into your account first.</h4> </div>";
                                    else
                                        echo "<div class='non-auth'> <h4>You can't access this as you are a $occupation_s</h4> </div>";
                                ?>
                            </ul>                   
                        </div>
                    </div> 
                </div>
            </div>          

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="flip-card">
                    <div class="flip-card-inner"> 
                        <div class="flip-card-front img-thumbnail">
                            <img class="img-responsive" src="Img/Avatars/avatar_student.png" alt="Student-Avatar" style="width: 290px; height: 290px;">
                            <h2><br>Student</h2>
                        </div>
            
                        <div class="flip-card-back img-thumbnail">
                            <ul>
                                <?php 
                                    if(($occupation_s == "student" || $occupation_s == "admin") && $login_s){
                                        echo '
                                        <div class="card-back-element">
                                            <li><a href="viewAssignments.php">View Assignment</a></li>
                                            
                                            <li><a href="viewAttendance.php">View Attendance</a></li>
                                            
                                            <li><a href="viewRoutines.php">View Routine</a></li>
                                            
                                            <li><a href="viewResults.php">View Result</a></li>
                                        </div>';
                                    } 
                                    else if(!$login_s)
                                        echo "<div class='non-auth'> <h4>Log In into your account first.</h4> </div>";
                                    else
                                        echo "<div class='non-auth'> <h4>You can't access this as you are a $occupation_s</h4> </div>";
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="flip-card">
                    <div class="flip-card-inner"> 
                        <div class="flip-card-front img-thumbnail">
                            <img class="img-responsive" src="Img/Avatars/avatar_librarian.png" alt="Librarian-Avatar" style="width: 290px; height: 290px;">
                            <h2><br>Librarian</h2>
                        </div>
            
                        <div class="flip-card-back img-thumbnail">
                            <ul>
                                <?php 
                                    if(($occupation_s == "librarian" || $occupation_s == "admin") && $login_s){
                                        echo '
                                        <div class="card-back-element">
                                            <li><a href="returnBook.php">Return a book</a></li>

                                            <li><a href="issueBook.php">Issue a book</a></li>

                                            <li><a href="displayBook.php">View books</a></li>

                                            <li><a href="addBook.php">Add Books</a></li>
                                        </div>';
                                    } 
                                    else if(!$login_s)
                                        echo "<div class='non-auth'> <h4>Log In into your account first.</h4> </div>";
                                    else
                                        echo "<div class='non-auth'> <h4>You can't access this as you are a $occupation_s</h4> </div>";
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 8%;">
        <h3 style="padding-right: 0.5%;">Events</h3>
        <div id="div1">
            <script>
                $("#div1").load("indexEvents.php #first_three");
            </script>
        </div>

        <div id="events" class="eventToggle" style="display: none;"></div>
        
        <div class="button showEvent" style="margin-bottom: 5%;">
            <button id='eventname' class="eventToggle1 btn btn-primary dropdown-toggle">Show more </button>
            <div class="dropup">
                <button id='eventname' class="eventToggle2 btn btn-primary dropdown-toggle" style="display: none;">Show less </button>
            </div>
        </div>
    </div>

    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous">
    </script>

    <script>
        let a = 1;
        $(".showEvent").click(function(event){
            a++;
            if(a%2 == 0){
                $(".eventToggle1").fadeOut(0);
                $(".eventToggle2").fadeIn(0);
            }
            else{
                $(".eventToggle1").fadeIn(0);
                $(".eventToggle2").fadeOut(0);
            }

            $(".eventToggle").fadeToggle(1000);

            let x = 0;

            $.ajax({
                type : "POST",
                url : "viewEvents.php",
                data : x,
                success : function(data) {
                    $("#events").html(data);
                    window.scrollTo(0, window.innerHeight);
                }
            });               
        });
    </script>
    
    <?php include 'footer.php'; ?>
</body>
</html>