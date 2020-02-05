<?php 
    require 'config/db.php';
    require_once 'controllers/authController.php'; 
    include 'header.php';
?>

<html lang="en">
<head>
    <title>Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/main.css">
    <link rel="stylesheet" href="StyleSheets/signUp.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="signUp.php" method="post">
            <h2>Sign Up</h2>

            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10 card card-body bg-light">
                    <label for="uname" class="mt-2"><b>Name</b></label>
                    <input type="text" value="<?php echo $username; ?>" placeholder="Enter full name" name="username" class="form-control" required>

                    <div class="form-inline mt-4">
                        <label for="department" class="mr-2"><b>Department</b></label>
                        <select class="form-control mr-3" name="department">
                            <option value="SWE" selected="selected">SWE</option>
                            <option value="CSE">CSE</option>
                            <option value="EEE">EEE</option>
                            <option value="MEE">MEE</option>
                            <option value="CEE">CEE</option>
                            <option value="CEP">CEP</option>
                            <option value="IPE">IPE</option>
                            <option value="PME">PME</option>
                        </select>

                        <label for="occupation" class="mr-2"><b>Occupation</b></label>
                        <select class="form-control mr-3" name="occupation">
                            <option value="admin">Admin</option>
                            <option value="teacher">Teacher</option>
                            <option value="student" selected="selected">Student</option>
                            <option value="librarian">Librarian</option>
                        </select>
                    
                        <label for="designation" class="mr-2"><b>Designation</b></label>
                        <select class="form-control mr-3" name="designation">
                            <option value="none" selected="selected">None</option>
                            <option value="professor">Professor</option>
                            <option value="assistant professor">Assistant Professor</option>
                            <option value="lecturer">Lecturer</option>
                        </select>

                        <label for="session" class="mr-2"><b>Batch</b></label>
                        <input type="number" min="1986" max="3000" placeholder="Enter Batch" value="<?php echo $sess; ?>" name="session" class="form-control" style="width: 15%;">
                    </div>
                    
                    <br>

                    <label for="email"><b>Email</b></label>
                    <input type="email" value="<?php echo $email; ?>" placeholder="Enter Email" name="email" class="form-control" required>

                    <div class="mt-2 mb-2">
                        <?php echo $email_error; ?>
                    </div>

                    <div class="form-group mt-1">
                        <label for="psw" class="mt-2"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" class="form-control mb-1" required>
                    
                        <label for="psw-repeat" class="mt-2"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Repeat Password" name="psw-repeat" class="form-control mb-1" required>  
                    </div>

                    <div class="mb-3">
                        <?php echo $psw_error_msg; ?>
                    </div>

                    <div class="form-check mb-2">
                        <input type="checkbox" checked="checked" name="remember" class="form-check-input">
                        <label class="form-check-label">Remember me</label>
                    </div>

                    <div class="form-check mb-2">
                        <input type="checkbox" name="terms_policy" class="form-check-input" required> 
                        <label class="form-check-label">I agree to the <a href="#">Terms & Policy</a></label>
                    </div>

                    <div class="form-group">
                        <div class="text-right">
                            <p>Already have an account? <a href="login.php">Login</a></p>
                        </div>
                        <button type="submit" name="signup-btn" class="btn btn-primary" style="width: 12%;">Sign Up</button>
                        <a href="login.php"><button type="button" class="btn btn-danger" style="width: 12%;">Cancel</button></a>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>