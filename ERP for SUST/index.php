<html lang="en">

<head>
    <title>ERP for SUST</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- header -->
    <?php 
        include 'header.php';
    ?>
    <!-- header -->

    <div class="container" id="container01">
        <!-- <h2>Enterprise Resource Planning for Shahjalal University of Science and Technology</h2> --> 
        <div class="row">   
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="flip-card">
                    <div class="flip-card-inner"> 
                        <div class="flip-card-front img-thumbnail">
                            <img class="img-responsive" src="Img/Avatars/avatar_teacher.png" alt="Teacher-Avatar" style="width: 290px; height: 290px;">
                            <h2><br>Teacher</h2>
                        </div>
            
                        <div class="flip-card-back">
                            <ul>
                                <?php 
                                    if(($occupation_s == "teacher" || $occupation_s == "admin") && $login_s){
                                        echo '<br><br>
                                        <li><a target="_blank" href="addAssignments.php">Add Assignment</a></li>
                                        <br>
                                        <li><a target="_blank" href="addAttendance.php">Add Attendance</a></li>
                                        <br>
                                        <li><a target="_blank" href="addResults.php">Add Result</a></li>
                                        <br>
                                        <li><a target="_blank" href="addEvents.php">Add Event</a></li>';
                                    } 
                                    else if(!$login_s)
                                        echo "<h4><br><br><br><br><br><br>Log In into your account first.</h4>";
                                    else
                                        echo "<h4><br><br><br><br><br><br>You can't access this as you are a $occupation_s</h4>";
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
            
                        <div class="flip-card-back">
                            <ul>
                                <?php 
                                    if(($occupation_s == "student" || $occupation_s == "admin") && $login_s){
                                        echo '<br><br>
                                        <li><a target="_blank" href="viewAssignments.php">View Assignment</a></li>
                                        <br>
                                        <li><a target="_blank" href="viewAttendance.php">View Attendance</a></li>
                                        <br>
                                        <li><a target="_blank" href="">View Routine</a></li>
                                        <br>
                                        <li><a target="_blank" href="viewResults.php">View Result</a></li>
                                        ';
                                    } 
                                    else if(!$login_s)
                                        echo "<h4><br><br><br><br><br><br>Log In into your account first.</h4>";
                                    else
                                        echo "<h4><br><br><br><br><br><br>You can't access this as you are a $occupation_s</h4>";
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
            
                        <div class="flip-card-back">
                            <ul>
                                <?php 
                                    if(($occupation_s == "librarian" || $occupation_s == "admin") && $login_s){
                                        echo '<br><br>
                                        <li><a target="_blank" href="addBook.php">Add Books</a></li>
                                        <br>
                                        <li><a target="_blank" href="issueBook.php">Issue Book</a></li>
                                        <br>
                                        <li><a target="_blank" href="returnBook.php">Return Book</a></li>
                                        <br>
                                        <li><a target="_blank" href="displayBook.php">View Book</a></li>
                                        ';
                                    } 
                                    else if(!$login_s)
                                        echo "<h4><br><br><br><br><br><br>Log In into your account first.</h4>";
                                    else
                                        echo "<h4><br><br><br><br><br><br>You can't access this as you are a $occupation_s</h4>";
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="button showEvent">
            <button id='eventname' class="eventToggle1 btn btn-primary dropdown-toggle">Show Events </button>
            <div class="dropup">
                <button id='eventname' class="eventToggle2 btn btn-primary dropdown-toggle" style="display: none;">Hide Events </button>
            </div>
        </div>

        <div id="events" class="eventToggle" style="display: none;"></div>
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
</body>
</html>