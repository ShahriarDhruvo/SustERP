<?php 
    require 'config/db.php';
    include 'header.php'
?>

<html lang="en">

<head>
    <title>Issue Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/main.css">
    <!-- <link rel="stylesheet" href="StyleSheets/issueBook.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <?php 
          $date = date("Y-m-d");
          $number_of_books_error = null;
          
          ini_set('upload_max_filesize', '10M');
          ini_set('post_max_size', '10M');
          ini_set('max_input_time', 300);
          ini_set('max_execution_time', 300);

          // Create database connection
          // require 'config/db.php';
          // $conn=mysqli_connect("localhost", "root", "", "erp_datas");
          // if(!$conn)
          //     echo ("Error Connection: ".mysqli_connect_error());

          if(isset($_POST['submit'])){
              $Student_Id = htmlspecialchars($_POST['studentId']);
              $Book_name = htmlspecialchars($_POST['bookName']);
              $Serial_Number = htmlspecialchars($_POST['bookSerial']);
              $date = htmlspecialchars($_POST['date']);
                  
              $sql = "INSERT INTO issuebook (Student_id, Book_Name, Book_Serial, Issue_Date)
                VALUES('$Student_Id', '$Book_name', '$Serial_Number', '$date')";
              
              $result = mysqli_query($conn, "SELECT * FROM addbook WHERE Book_Name = '$Book_name'");
              $row = mysqli_fetch_array($result);
              
              if($row['Number_Of_Books'] <= 0) 
                $number_of_books_error = "<br><font color='#FF0000'> The stock of ".$Book_name." is empty! </font>"; 
              else{
                mysqli_query($conn, "UPDATE addbook SET Number_Of_Books = Number_Of_Books-1 WHERE Book_Name = '$Book_name'");
                $result = mysqli_query($conn, $sql);
                
                if(!$result)
                  echo mysqli_error($conn);

                else
                  $msg = "Updated books library successfully.";

                echo '<script language="javascript">';
                echo 'alert("'.$msg.'")';
                echo '</script>';

                header("refresh: 0.5; url = issueBook.php");
              }
          }
        ?>

        <h2>Issue a Book</h2>

        <form class="mx-auto" style="margin-bottom: 8%;" action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card card-body bg-light">
                        <label for="studentId" class="mt-3"><b>Student_Reg.</b></label>
                        <input type="number" max="3000999999" min="1986000000" placeholder="Registration number"
                            name="studentId" class="form-control" required>

                        <label for="bookName" class="mt-3"><b>Book's Name</b></label>
                        <input type="text" placeholder="Name" name="bookName" class="form-control" required>

                        <?php echo $number_of_books_error; ?>

                        <label for="bookSerial" class="mt-3"><b>Book's Serial Number</b></label>
                        <input type="text" placeholder="Serial Number" name="bookSerial" class="form-control" required>

                        <label for="date" class="mt-3"><b>Issue Date</b></label>
                        <input type="date" max="3000-12-31" min="1986-01-01" value="<?php echo $date; ?>"
                            placeholder="Date" name="date" class="form-control" required>

                        <button type="submit" name="submit" class="btn btn-primary mt-4">Issue</button>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </form>

        <h2>Issued Books</h2>

        <?php
            $result = mysqli_query($conn, "SELECT * FROM issuebook");
            
            echo "<div class='table-responsive'>";
              echo "<table class='table table-striped table-bordered table-hover'>";
                echo "<thead>";
                  echo "<th scope='col'>"; echo "#"; echo "</th>";
                  echo "<th scope='col'>"; echo "Student ID"; echo "</th>";
                  echo "<th scope='col'>"; echo "Book Name"; echo "</th>";
                  echo "<th scope='col'>"; echo "Book Serial"; echo "</th>";
                  echo "<th scope='col'>"; echo "Issue Date"; echo "</th>";
                echo "</thead>";

              while($row = mysqli_fetch_array($result)){
                  echo "<tr>";
                    echo "<th scope='row'>"; echo $row["id"]; echo "</th>";
                    echo "<td>"; echo $row["Student_id"]; echo "</td>";
                    echo "<td>"; echo $row["Book_Name"]; echo "</td>";
                    echo "<td>"; echo $row["Book_Serial"]; echo "</td>";
                    echo "<td>"; echo $row["Issue_Date"]; echo "</td>";  
                  echo "</tr>";
              }
              echo "</table>";
            echo "</div>";
        ?>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>