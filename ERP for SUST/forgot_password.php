<?php
    include 'controllers/authController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Forgot password</title>
</head>
<body>
    <div class="container" style="margin-top: 15%;">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body bg-light">
                        <form action="forgot_password.php" method="post">
                            <h3>Recover Your password</h3>

                            <p>
                                Please enter your email address you used to sign up on this site
                                and we will assist you in recovering your password.
                            </p>

                            <div class="form-group">
                                <!-- <label for="email">Email</label> -->
                                <input type="email" name="email" placeholder="Enter your email address" class="form-control form-control-lg" required>
                            </div>

                            <?php echo $email_error; ?>

                            <div class="form-group">
                                <button type="submit" name="forgot-password" class="btn btn-primary btn-block btn-lg">Reset your password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>