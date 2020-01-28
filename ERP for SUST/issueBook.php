<html lang="en">
 <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <title>Issue Book</title>

        <link rel="stylesheet" href="StyleSheets/issueBook.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>

<h2>Issue Book</h2>

  
  <div class="container">

    <?php 
    ini_set('upload_max_filesize', '10M');
    ini_set('post_max_size', '10M');
    ini_set('max_input_time', 300);
    ini_set('max_execution_time', 300);

    // Create database connection
    $conn=mysqli_connect("localhost", "root", "", "erp_datas");
    if(!$conn)
         echo ("Error Connection: ".mysqli_connect_error());

    if(isset($_POST['submit'])){
     if(!mysqli_select_db($conn, "erp_datas"))
         echo "Failed to load the database";

         $Student_Id=$_POST['studentId'];
         $Book_name=$_POST['bookName'];
         $Serial_Number=$_POST['bookSerial'];
         $Issue_date=$_POST['date'];
         

          $sql="INSERT INTO issuebook (Student_id,Book_Name, Book_Serial, Issue_Date)
          VALUES('$Student_Id', '$Book_name', '$Serial_Number', $Issue_date)";


        $result = mysqli_query($conn, $sql);
        mysqli_query($conn, "update addbook set Number_Of_Books = Number_Of_Books-1 where Book_Name='$Book_name'");
        

         if(!$result)
					echo "There is an error while quering.";

				else
					$msg = "Book Issued Successfully.";

					echo '<script language="javascript">';
					echo 'alert("'.$msg.'")';
				echo '</script>';

            header("refresh: 0.5; url = issueBook.php");
    }


  ?>
  </div>


<form class="mx-auto" style="width: 800px;" action="" method="post" enctype="multipart/form-data">

    <label for="studentId"><b>Student_ID</b></label>
    <input type="text" placeholder="Add Student Id" name="studentId" required>

    <label for="bookName"><b>Book Name</b></label>
    <input type="text" placeholder="Add Book Name" name="bookName" required>

    <label for="bookSerial"><b>Serial Number</b></label>
    <input type="text" placeholder="Add Serial Number" name="bookSerial" required>

    <label for="date"><b>Issue Date</b></label>
    <input type="text" placeholder="Date Here" name="date" required>

        
    <button type="submit" name="submit">Submit</button>
</form>

<div class="mx-auto" style="height: 170px;">
<h2>Issued Books</h2>
</div>

<div class="mx-auto" style="width: 1200px;">
 <?php
      
      $result = mysqli_query($conn, "SELECT * FROM issuebook");

      echo "<table class='table table-striped table-dark'>";
      echo "<th>"; echo "Student ID"; echo "</th>";
      echo "<th>"; echo "Book Name"; echo "</th>";
      echo "<th>"; echo "Book Serial"; echo "</th>";
      echo "<th>"; echo "Issue Date"; echo "</th>";

     while($row=mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>"; echo $row["Student_id"]; echo "</td>";
      echo "<td>"; echo $row["Book_Name"]; echo "</td>";
      echo "<td>"; echo $row["Book_Serial"]; echo "</td>";
      echo "<td>"; echo $row["Issue_Date"]; echo "</td>";  
      echo "</tr>";
     }
     echo "</table>";
  
?> 
</div>
</body>

</html>