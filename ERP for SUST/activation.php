<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Activate your account</title>
</head>
<body>
    <div class="container" style="margin-top: 15%;">
        <?php
            include 'controllers/authController.php';
        ?>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="alert <?php echo $_SESSION['alert-class']; ?>">
                            <?php echo $_SESSION['message']; ?>
                        </div>
                        
                        <h3>Welcome, <?php echo $_SESSION['name']; ?></h3>
                        <?php if(!$_SESSION['verified']): ?>
                            <div class="alert alert-warning">
                                You need to verify your account.
                                Sign in to your email account and click on the 
                                verification link we just emailed you at
                                <strong><?php echo $_SESSION['email']; ?></strong>
                            </div>
                        <?php endif; ?>
                        <br>
                        <?php if($_SESSION['verified']): ?>
                            <a class="btn btn-block btn-lg btn-primary" href="login.php" role="button">Login into your account</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>