<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>
    <link rel="stylesheet" href="StyleSheets/signUp.css">
</head>
<body>
    <div>
        <?php
            $psw_error_msg = null;

            if(isset($_POST['signUp'])){
                $conn = mysqli_connect("localhost", "root", "");

                if(!$conn)
                    echo ("Error Connection: ".mysqli_connect_error());
                if(!mysqli_select_db($conn, "erp_users_accounts"))
                    echo "Failed to load the database";

                $username = $_POST['username'];
                $department = $_POST['department'];
                $occupation = $_POST['occupation'];
                $designation = $_POST['designation'];
                $sess = $_POST['session'];
                $email = $_POST['email'];
                $psw = $_POST['psw'];
                $psw_repeat = $_POST['psw-repeat'];

                if($psw != $psw_repeat)
                    $psw_error_msg = "<br><font color='#FF0000'> Your password doesn't match! </font><br><br>";
                else{
                    $sql = "INSERT INTO users (UserName, Department, Occupation, Designation, Sess, Email, Psw)
                            VALUES('$username', '$department', '$occupation', '$designation', '$sess', '$email', '$psw')";
                    $result = mysqli_query($conn, $sql);

                    if($result){
                        echo '<script language="javascript">';
                        echo 'alert("You have successfully created an account.")';
                        echo '</script>';
                    }
                    else{
                        echo '<script language="javascript">';
                        echo 'alert("An error occured while saving the data!\nTry again after sometime.")';
                        echo '</script>';
                    }
                    header("refresh: 0.75; url = login.php");
                }
            }
        ?>
    </div>

    <div class="topBorder">  
        <a href="index.php"><img src="Img/Logos/logo2.png" style="width:120px"></a>
    </div>

    <form action="signUp.php" method="post">
        <div class="container">
            <h1>Sign Up</h1>
                <!-- <p>Please fill in this form to create an account.</p> -->
            <hr>
            
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <!-- <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" required>

            <label for="lname"><b>Last Name</b></label>
            <input type="text" placeholder="Enter Last Name" required> -->

            <div class="selectContent">
                <label for="department" class="dname"><b>Department</b></label>
                <select class="sdname" name="department">
                    <option value="SWE" selected="selected">SWE</option>
                    <option value="CSE">CSE</option>
                    <option value="EEE">EEE</option>
                    <option value="MEE">MEE</option>
                    <option value="CEE">CEE</option>
                    <option value="CEP">CEP</option>
                    <option value="IPE">IPE</option>
                    <option value="PME">PME</option>
                </select>

                <label for="occupation" class="occupation"><b>Occupation</b></label>
                <select class="soccupation" name="occupation">
                    <option value="admin">Admin</option>
                    <option value="teacher">Teacher</option>
                    <option value="student" selected="selected">Student</option>
                    <option value="librarian">Librarian</option>
                </select>
            
                <label for="designation" class="designation"><b>Designation</b></label>
                <select class="sdesignation" name="designation">
                    <option value="none" selected="selected">None</option>
                    <option value="professor">Professor</option>
                    <option value="assistant professor">Assistant Professor</option>
                    <option value="lecturer">Lecturer</option>
                </select>
            </div>
            
            <br>

            <label for="session"><b>Session</b></label>
            <input type="text" placeholder="Enter Session" name="session">
            
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>
        
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
        
            <label for="psw-repeat"><b>Repeat Password</b></label>
            <input type="password" placeholder="Repeat Password" name="psw-repeat" required>  

            <?php echo $psw_error_msg; ?>

            <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>
            
            <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

            <div class="clearfix">
                <button type="submit" name="signUp" class="signupbtn">Sign Up</button>
                <a href="login.php"><button type="button" class="cancelbtn">Cancel</button></a>
            </div>
        </div>
    </form>
</body>
</html>