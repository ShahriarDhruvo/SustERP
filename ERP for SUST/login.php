<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="StyleSheets/main.css">
        <link rel="stylesheet" href="StyleSheets/logIn.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php 
            include 'header.php';
            require_once 'controllers/authController.php';
        ?>

        <div class="container">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="text-center">
                    <strong><?php echo $verification_error_msg; ?></strong>
                </div>
                
                <div class="text-center">
                    <img src="Img/Avatars/LogIn_avatar.png" alt="Avatar" class="avatar">
                </div>
                    
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-body bg-light">
                                <div class="form-group">
                                    <label for="email" class="mt-2"><b>Email</b></label>
                                    <input type="email" value="<?php echo $email; ?>" placeholder="Enter email" name="email" class="form-control" required>

                                    <?php echo $email_error; ?>

                                    <label for="psw" class="mt-2"><b>Password</b></label>
                                    <input type="password" placeholder="Enter Password" name="psw" class="form-control" required>
                                    
                                    <?php echo $psw_error_msg; ?>
                                </div>

                                <div class="form-check">    
                                    <input type="checkbox" checked="checked" name="remember" class="form-check-input"> 
                                    <label for="remember" class="form-check-label">Remember me</label>
                                </div>

                                <div class="text-right">
                                    <span class=""><a href="forgot_password.php">Forgot password?</a></span>
                                    <br>
                                    <span class="">Not yet a member? <a href="signUp.php">Sign Up</a></span>
                                </div>

                                <button type="submit" name="login-btn" class="btn btn-primary" style="width: 12%;">Login</button>
                                <a href="index.php"><button type="button" class="btn btn-danger" style="width: 12%;">Cancel</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </form>
        </div> 
        
        <?php include 'footer.php'; ?>
    </body>
</html>