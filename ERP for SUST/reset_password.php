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
    <title>Reset password</title>
</head>
<body>
    <div class="container" style="margin-top: 15%;">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body bg-light">
                        <form action="reset_password.php" method="post">
                            <h3>Reset Your password</h3>

                            <div class="form-group">
                                <label for="password"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="password" class="form-control form-control-lg" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="password"><b>Confirm Password</b></label>
                                <input type="password" placeholder="Confirm Password" name="passwordConf" class="form-control form-control-lg" required>
                            </div>

                            <?php echo $psw_error_msg; ?>

                            <div class="form-group">
                                <button type="submit" name="reset-password" class="btn btn-primary btn-block btn-lg">
                                    Reset password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>