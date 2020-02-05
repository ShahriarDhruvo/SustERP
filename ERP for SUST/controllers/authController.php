<?php

require_once 'emailController.php';

$verification_error_msg = null;
$psw_error_msg = null;
$email_error = null;
$username = null;
$email = null;
    
if(isset($_POST['signup-btn'])){
    $username = htmlspecialchars($_POST['username']);
    $department = htmlspecialchars($_POST['department']);
    $occupation = htmlspecialchars($_POST['occupation']);
    $designation = htmlspecialchars($_POST['designation']);
    $sess = htmlspecialchars($_POST['session']);
    $email = htmlspecialchars($_POST['email']);
    $psw = htmlspecialchars($_POST['psw']);
    $psw_repeat = htmlspecialchars($_POST['psw-repeat']);

    if($sess == null) $sess = 0;

    $sql_e = "SELECT * FROM users WHERE Email='$email' LIMIT 1";
    $res_e = mysqli_query($conn, $sql_e);

    if(mysqli_num_rows($res_e) > 0)
        $email_error = "<font color='#FF0000'> This email address is already in use </font>"; 	
    else{
        $pattern = false;
        if(strlen($psw) >= 8 && !ctype_upper($psw) && !ctype_lower($psw)) $pattern = true;

        if(!$pattern) $psw_error_msg = "<font color='#FF0000'> Your password should be of at least 8 length and contain one upper and lower case character </font>";
        else if($psw != $psw_repeat)
            $psw_error_msg = "<font color='#FF0000'> Your password doesn't match! </font>";
        else{
            $hpsw = password_hash($psw, PASSWORD_DEFAULT);
            $token = bin2hex(random_bytes(50));
            $verified = 0;

            $sql = "INSERT INTO users (UserName, Department, Occupation, Designation, Sess, Email, Psw, token, verified)
                    VALUES('$username', '$department', '$occupation', '$designation', '$sess', '$email', '$hpsw', '$token', '$verified')";
            $result = mysqli_query($conn, $sql);

            $user_id = $conn->insert_id;
            $_SESSION['id'] = $user_id;
            $_SESSION['name'] = $username;
            $_SESSION['designation'] = $designation;
            $_SESSION['email'] = $email;
            $_SESSION['message'] = "You are all set, just one more step to activate your account!";
            $_SESSION['alert-class'] = "alert-success";
            $_SESSION['verified'] = $verified;

            sendVerificationEmail($email, $token);

            if($result){
                // echo '<script language="javascript">';
                //     echo 'alert("You have successfully created an account.")';
                // echo '</script>';

                $URL="activation.php";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';

                // header("refresh: 0.5; url = activation.php");
                exit();
            }
            else{
                echo '<script language="javascript">';
                    echo 'alert("Database error: Failed to register")';
                echo '</script>';
            }
        }
    }
}

if(isset($_POST['login-btn'])){
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['psw']);

    $sql = "SELECT * from users WHERE Email='$email'";
    $result = mysqli_query($conn, $sql);

    if(!(mysqli_num_rows($result) > 0))
        $email_error = "<font color='#FF0000'> This email address doesn't exist in our database </font><br>";

    $rows = mysqli_fetch_assoc($result);
    $hpsw = $rows['Psw'];
    $_SESSION['designation'] = $rows['Designation'];
    $verified = $rows['verified'];

    if(password_verify($pass, $hpsw) && $verified){
        $verification_error_msg = null;
        $_SESSION['login'] = true;
        $_SESSION['department'] = $rows['Department'];
        $_SESSION['batch'] = $rows['Sess'];
        $_SESSION['name'] = $rows['UserName'];
        $_SESSION['email'] = $rows['Email'];
        $_SESSION['occupation'] = $rows['Occupation'];
        $_SESSION['verified'] = $verified;

        $URL="index.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';

        // header('Location: index.php');
        exit();
    }
    else if(!$verified && $email_error == null)
        $verification_error_msg = '<font color="#FF0000"> Sorry buddy, verify your account first </font>';
    else if($email_error == null)
        $psw_error_msg = '<font color="#FF0000"> Sorry buddy, invalid Email Or Password </font>';
}

// verify user by token

function verifyUser($token){
    global $conn;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $rows = mysqli_fetch_assoc($result);
        $update_query = "UPDATE users SET verified=1 WHERE token='$token'";

        if(mysqli_query($conn, $update_query)){
            $_SESSION['login'] = true;
            $_SESSION['department'] = $rows['Department'];
            $_SESSION['batch'] = $rows['Sess'];
            $_SESSION['name'] = $rows['UserName'];
            $_SESSION['email'] = $rows['Email'];
            $_SESSION['occupation'] = $rows['Occupation'];
            $_SESSION['verified'] = 1;

            $_SESSION['message'] = "Your email address was successfully verified!";
            $_SESSION['alert-class'] = "alert-success";

            $URL="index.php";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';

            // header('Location: index.php');
            exit();
        }
        else echo "User not found";
    }
}

if(isset($_POST['forgot-password'])){
    $email = $_POST['email'];

    $sql = "SELECT * FROM users WHERE Email='$email' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $token = $user['token'];
        sendPasswordResetLink($email, $token);

        $URL="password_message.php";
        echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
        echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';

        // header('location: password_message.php');
        exit();
    } 
    else $email_error = "<font color='#FF0000'> This email address doesn't exist in the database</font>"; 
}

if(isset($_POST['reset-password'])){
    $psw = $_POST['password'];
    $psw_repeat = $_POST['passwordConf'];
    $hpsw = password_hash($psw, PASSWORD_DEFAULT);
    $email = $_SESSION['email'];

    $pattern = false;
    if(strlen($psw) >= 8 && !ctype_upper($psw) && !ctype_lower($psw)) $pattern = true;

    if(!$pattern) $psw_error_msg = "<font color='#FF0000'> Your password should be of at least 8 length and contain one upper and lower case character </font>";
    else if($psw != $psw_repeat)
        $psw_error_msg = "<font color='#FF0000'> Your password doesn't match!</font>";
    else{
        $sql = "UPDATE users SET Psw='$hpsw' WHERE Email='$email'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $_SESSION['login'] = false;
            $URL="login.php";
            echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
            echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';

            // header("location: login.php");
            exit();
        }
    }
}

function resetPassword($token){
    global $conn;
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $_SESSION['email'] = $user['Email'];

    $URL="reset_password.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';

    // header("location: reset_password.php");
    exit();
}