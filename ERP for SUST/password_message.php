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
    <title>Password message</title>
</head>
<body>
    <div class="container" style="margin-top: 15%;">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body bg-light">
                        <div class="alert alert-success">
                            <p>
                                An email has been sent to your email address with a link to reset your 
                                password.
                            </p>
                        </div>
                        <div>
                            <a class="btn btn-block btn-lg btn-primary" href="https://www.gmail.com" role="button">Check your email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>