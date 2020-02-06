<?php 
    require 'config/db.php';
    include 'header.php'
?>

<html lang="en">

<head>
    <title>Return Book</title>
    <!-- <link rel="stylesheet" href="StyleSheets/returnBook.css"> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <?php 
            $date = date("Y-m-d");
            ini_set('upload_max_filesize', '10M');
            ini_set('post_max_size', '10M');
            ini_set('max_input_time', 300);
            ini_set('max_execution_time', 300);
    
            if(isset($_POST['submit'])){
                $Student_Id = htmlspecialchars($_POST['studentId']);
                $Book_name = htmlspecialchars($_POST['bookName']);
                $Serial_Number = htmlspecialchars($_POST['bookSerial']);
                $date = htmlspecialchars($_POST['date']);

                $getIsdate = mysqli_query($conn, "SELECT * FROM issuebook WHERE Book_Name = '$Book_name' AND Book_Serial = '$Serial_Number'");
                $row = mysqli_fetch_array($getIsdate);
                $issuedate = $row['Issue_Date'];

                $delete = mysqli_query($conn, "SELECT * FROM issuebook WHERE Book_Name = '$Book_name' AND Student_id = '$Student_Id' AND Book_Serial = '$Serial_Number'");
                
                if(mysqli_num_rows($delete) <= 0){
                    $emsg = "There is no record of issuing ".$Book_name." of serial ".$Serial_Number." by Reg.No: ".$Student_Id;
                    echo '<script language="javascript">';
                        echo 'alert("'.$emsg.'")';
                    echo '</script>';
                }
                else
                    mysqli_query($conn, "DELETE FROM issuebook WHERE Book_Name = '$Book_name' AND Student_id = '$Student_Id' AND Book_Serial = '$Serial_Number'");
                
                $earlier = new DateTime($issuedate);
                $later = new DateTime($date);
                $diff = $later->diff($earlier)->format("%a");

                $sql = "INSERT INTO returnbook (Student_id, Book_Name, Book_Serial, Issue_Date, Return_Date, days, received_by)
                VALUES('$Student_Id', '$Book_name', '$Serial_Number', '$issuedate', '$date', '$diff', '$name_s')";

                $result = mysqli_query($conn, $sql);
                mysqli_query($conn, "UPDATE addbook SET Number_Of_Books = Number_Of_Books+1 WHERE Book_Name = '$Book_name'");
                
                if(!$result)
                    echo mysqli_error($conn);
                else
                    $msg = "Updated books library successfully.";

                echo '<script language="javascript">';
                echo 'alert("'.$msg.'")';
                echo '</script>';

                $URL="returnBook.php";
                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';

                // header("refresh: 0.5; url = returnBook.php");
            }
        ?>

        <h3>Return Book</h3>

        <form action="" method="post" style="margin-bottom: 8%;" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="card card-body bg-light">
                        <label for="studentId" class="mt-3"><b>Student_Reg.</b></label>
                        <input type="number" max="3000999999" min="1986000000" placeholder="Registration number"
                            name="studentId" class="form-control" required>

                        <label for="bookName" class="mt-3"><b>Book's Name</b></label>
                        <input type="text" placeholder="Name" name="bookName" class="form-control" required>

                        <label for="bookSerial" class="mt-3"><b>Book's Serial Number</b></label>
                        <input type="text" placeholder="Serial Number" name="bookSerial" class="form-control" required>

                        <label for="date" class="mt-3"><b>Return Date</b></label>
                        <input type="date" max="3000-12-31" min="1986-01-01" value="<?php echo $date; ?>"
                            placeholder="Date" name="date" class="form-control mb-2 mr-sm-2" class="form-control"
                            required>

                        <button type="submit" name="submit" class="btn btn-primary mt-3">Return</button>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
        <?php
            $your_assignment = true;
            $this_file_name = "returnBook.php";

            $ssql = "SELECT * FROM returnbook";

            $search_term = null;
            $filter = null;

            if(isset($_POST['search'])){
                $search_term = htmlspecialchars($_POST['search_box']);
                $filter = $_POST['filter'];

                if($filter == "1")
                    $ssql .= " WHERE CONCAT(Student_id, Book_Name, Book_Serial, Issue_Date, Return_Date, days, received_by) LIKE '%".$search_term."%' ORDER BY Return_Date";
                else if($filter == "2")
                    $ssql .= " WHERE Book_Name LIKE '%".$search_term."%' ORDER BY Return_Date";
                else if($filter == "3")
                    $ssql .= " WHERE Book_Serial LIKE '%".$search_term."%' ORDER BY Return_Date";
                else if($filter == "4")
                    $ssql .= " WHERE Student_id LIKE '%".$search_term."%' ORDER BY Return_Date";
            }
            else $ssql .= " ORDER BY Return_Date";

            if(!$result = mysqli_query($conn, $ssql)) echo mysqli_error($conn);

            $authorization = true;
        
            if(!($occupation_s == "librarian" || $occupation_s == "admin")) $authorization = false;
        ?>

        <!-- search -->
        <div style="margin-top: 10%;">
            <form method="POST" action="returnBook.php" enctype="multipart/form-data" class="card card-body bg-light">
                <div class="form-inline">
                    <input type="text" class="form-control mr-sm-4" placeholder="Search" name="search_box" value="<?php echo $search_term; ?>" style="width: 74%;">

                    <select class="form-control mr-sm-4" name="filter">
                        <option <?php if($filter == 1) echo 'selected'; ?> value="1">All</option>
                        <option <?php if($filter == 2) echo 'selected'; ?> value="2">Book Name</option>
                        <option <?php if($filter == 3) echo 'selected'; ?> value="3">Serial Number</option>
                        <option <?php if($filter == 4) echo 'selected'; ?> value="4">Student Reg.</option>
                    </select>

                    <button class="btn btn-primary" type="submit" name="search">Search</button>
                </div>
            </form>
        </div>
        <!-- search -->

        <div style="margin-top: 10%;">
            <h3>Returned Books</h3>
        </div>

        <?php
            // $result = mysqli_query($conn, "SELECT * FROM returnbook");
            
            if($authorization){
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered table-hover'>";
                    echo "<thead>";
                        echo "<th scope='col'>"; echo "#"; echo "</th>";
                        echo "<th scope='col'>"; echo "Student ID"; echo "</th>";
                        echo "<th scope='col'>"; echo "Book Name"; echo "</th>";
                        echo "<th scope='col'>"; echo "Book Serial"; echo "</th>";
                        echo "<th scope='col'>"; echo "Issue Date"; echo "</th>";
                        echo "<th scope='col'>"; echo "Return Date"; echo "</th>";
                        echo "<th scope='col'>"; echo "Days"; echo "</th>";
                        echo "<th scope='col'>"; echo "Received By"; echo "</th>";
                    echo "</thead>";

                while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                        echo "<th scope='row'>"; echo $row["id"]; echo "</th>";
                        echo "<td>"; echo $row["Student_id"]; echo "</td>";
                        echo "<td>"; echo $row["Book_Name"]; echo "</td>";
                        echo "<td>"; echo $row["Book_Serial"]; echo "</td>";
                        echo "<td>"; echo $row["Issue_Date"]; echo "</td>";
                        echo "<td>"; echo $row["Return_Date"]; echo "</td>";  
                        echo "<td>"; echo $row["days"]; echo "</td>"; 
                        echo "<td>"; echo $row["received_by"]; echo "</td>"; 
                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
            else echo "<h2>You are not authorize to see the contents of this page.</h2>";
        ?>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>