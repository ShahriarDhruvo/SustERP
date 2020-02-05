<?php 
    require 'config/db.php';
    include 'header.php'
?>

<html lang="en">
<head>
    <title>About</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/main.css">
    <link rel="stylesheet" href="StyleSheets/about.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2>About</h2>

        <div class="row" style="margin-top: 11%;">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body bg-light text-center pr-4 pl-4 pt-4 pb-2">
                        <p>
                            ERP(Enterprises Resource Planning)  university Management Module which is used by University to manage their daily activities
                            which include the management of Employees, Students, Books and Library Records, Assignments,
                            Admission Process, Results and Reports, Exams, Events, Attendance, Timetable, Fees and Other Reports. 
                            It provides one-point access to manage these wide range of activities both effectively and efficiently.
                            Managing a university or any educational institution without a perfect software solution in the present times 
                            is painful, same in the case of any enterprises or business.
                            Hence an appropriate solution is required which can ensure the smooth functioning of the organization as a whole,
                            and with ERP college Management Module, this problem can simply be solved.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>