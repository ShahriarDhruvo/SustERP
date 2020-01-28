<html lang="en">
 <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <title>Request Book</title>

        <link rel="stylesheet" href="StyleSheets/requestBook.css">
</head>
<body>

<h2>Request Book</h2>

  
  <div class="container">
    <?php 
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

         $Book_name=$_POST['bookName'];
         $Author_name=$_POST['authorName'];
         $Books_Price=$_POST['price'];
         

         $sql="INSERT INTO requestbook (Book_Name, Author_Name, Book_Price)
         VALUES('$Book_name', '$Author_name', '$Books_Price')";

        $result = mysqli_query($conn, $sql);

         $data = mysqli_query($conn, "SELECT MAX(id) FROM requestbook");
         $inc = mysqli_fetch_row($data);

         if(!$result)
					echo "There is an error while quering.";

				else
					$msg = "Book Request Sent Successfully.";

					echo '<script language="javascript">';
					echo 'alert("'.$msg.'")';
				echo '</script>';

            header("refresh: 0.5; url = requestBook.php");
    }

?>
  </div>

<form class="Form" action="" method="post" enctype="multipart/form-data">
    <label for="bookName"><b>Book Name</b></label>
    <input type="text" placeholder="Add Book Name" name="bookName" required>

    <label for="authorName"><b></b>Author Name</label>
    <input type="text" placeholder="Add Author Name" name="authorName" required>

    <label for="price"><b></b>Estimated Price</label>
    <input type="text" placeholder="Price Here" name="price" required>

        
    <button type="submit" name="submit">Submit</button>
</form>
</body>

</html>