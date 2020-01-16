<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LogIn Window</title>

    <link rel="stylesheet" href="StyleSheets/logIn.css">
</head>
<body>

    <div>
        <?php  
            session_start();

            $conn = mysqli_connect("localhost", "root", "", "erp_users_accounts");
            $msg = null;

            if(!$conn)
                echo ("Error Connection: ".mysqli_connect_error());

            if(isset($_POST['submit'])){
                $name = $_POST['uname'];
                $pass = $_POST['psw'];

                $sql = "select * from users where UserName='$name' and Psw='$pass'";
                $result = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($result);

                if($count){
                    $rows = mysqli_fetch_assoc($result);
                    $_SESSION['name'] = $rows['UserName'];
                    $_SESSION['login'] = true;
                    $_SESSION['occupation'] = $rows['Occupation'];

                    header('Location: index.php');
                }
                else
                    $msg = '<br><font color="#FF0000"> Sorry buddy, Invalid Username Or Password </font><br><br>';
            }
        ?>
    </div>

    <div class="topBorder">  
        <a href="index.php"><img src="Img/Logos/logo2.png" style="width:120px"></a>
    </div>

    <div class="main-container">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <div class="imgcontainer">
                <img src="Img/Avatars/LogIn_avatar.png" alt="Avatar" class="avatar">
            </div>
                
            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" required>
                
                <?php echo $msg ?>

                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>

                <br>

                <div class="clearfix">
                    <button type="submit" name="submit" class="loginbtn">Login</button>
                    <a href="index.php"><button type="button" class="cancelbtn">Cancel</button></a>
                </div>

                <span class="extra-content"><a href="#">Forgot password?</a></span>
                <br><br>
                <span class="extra-content"><a href="signUp.php">Create an account</a></span>
            </div>
        </form>
    </div>  
</body>
</html>