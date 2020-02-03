<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>My Profile</title>
</head>
<body>
    <!-- header -->
    <?php include 'header.php'; ?>
    <!-- header -->

    <div class="container" style="margin-top: 0%;">
        <?php
            include 'controllers/authController.php';
        ?>
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <img src="Img/Avatars/LogIn_avatar.png" alt="Profile picture" style="width: 42%; margin-bottom: 5%;">

                <?php 
                    echo "<h3 style='margin-bottom: -1px; color: #044d92;'><b>".ucfirst($_SESSION['name'])."</b></h3>"; 
                    if($_SESSION['designation'] != 'none')
                        echo "<p>".ucfirst($_SESSION['designation'])."</p>";
                ?>

                <div class="card" style="margin-top: 10%;">
                    <div class="card-body bg-light pt-4">
                        <form action="reset_password.php" method="post">
                            <p><b>Email: </b><?php echo $_SESSION['email'] ?></p>
                            <p><b>Department: </b><?php echo ucfirst($_SESSION['department']); ?></p>
                            <p><b>Occupation: </b><?php echo ucfirst($_SESSION['occupation']); ?></p>
                            <p><a href="forgot_password.php">Reset your password</a></p>
                        </form>
                    </div>
                </div>
                <p class="mt-4"><a href="mailto:erpsust@gmail.com?subject=Changing info">Mail us at erpsust@gmail.com for changing any other info</a></p>
            </div>
        </div>
    </div>

    <?php include'footer.php'; ?>
</body>
</html>