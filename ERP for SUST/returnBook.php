<html lang="en">
 <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <title>Return Book</title>

        <link rel="stylesheet" href="StyleSheets/returnBook.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>
<body>

<h2>Return Book</h2>

  
  <div class="container">
    <?php 
    $date=date("Y-m-d");
    ini_set('upload_max_filesize', '10M');
    ini_set('post_max_size', '10M');
    ini_set('max_input_time', 300);
    ini_set('max_execution_time', 300);

    // Create database connection

    if(isset($_POST['submit'])){
        $conn=mysqli_connect("localhost", "root", "");
    
    if(!$conn)
         echo ("Error Connection: ".mysqli_connect_error());
     if(!mysqli_select_db($conn, "erp_datas"))
         echo "Failed to load the database";

         $Student_Id=$_POST['studentId'];
         $Book_name=$_POST['bookName'];
         $Serial_Number=$_POST['bookSerial'];
         $Return_date=$_POST['date'];
         

         $sql="INSERT INTO returnbook (Student_id,Book_Name, Book_Serial, Return_Date)
         VALUES('$Student_Id', '$Book_name', '$Serial_Number', $Return_date)";

        $result = mysqli_query($conn, $sql);
        mysqli_query($conn, "update addbook set Number_Of_Books = Number_Of_Books+1 where Book_Name='$Book_name'");

         if(!$result)
					echo "There is an error while quering.";

				else
					$msg = "Book Returned Successfully.";

					echo '<script language="javascript">';
					echo 'alert("'.$msg.'")';
				echo '</script>';

            header("refresh: 0.5; url = returnBook.php");
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

    <label for="date"><b>Return Date</b></label>
    <input type="date" max="3000-12-31" min="1000-01-01" value="<?php echo $date; ?>" placeholder="Date Here" name="date" class="form-control mb-2 mr-sm-2" required>

        
    <button type="submit" name="submit">Return</button>
</form>
</body>

</html>