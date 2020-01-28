<html lang="en">
 <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <title>Add Book</title>

        <link rel="stylesheet" href="StyleSheets/addBook.css">
</head>
<body>

<h2>Add Book</h2>

  
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
         $Number_of_books=$_POST['booksNumber'];
         
        //  $name = htmlspecialchars($_FILES['files']['name']);

         $sql="INSERT INTO addbook (Book_Name, Author_Name, Number_Of_Books)
         VALUES('$Book_name', '$Author_name', '$Number_of_books')";

        $result = mysqli_query($conn, $sql);

         $data = mysqli_query($conn, "SELECT MAX(id) FROM addbook");
         $inc = mysqli_fetch_row($data);
        //  $id = $inc[0] + 1;

        //  $file = "(".$id.")_".$name;
        //  $target = "Data/books/".basename($file);

         if(!$result)
					echo "There is an error while quering.";

				// if(move_uploaded_file($_FILES['files']['tmp_name'], $target))
					// $msg = "File uploaded successfully";
				else
					$msg = "Book uploaded successfully";

					echo '<script language="javascript">';
					echo 'alert("'.$msg.'")';
				echo '</script>';

            header("refresh: 0.5; url = addBook.php");
    }

?>
  </div>

<form class="Form" action="" method="post" enctype="multipart/form-data">
    <label for="bookName"><b>Book Name</b></label>
    <input type="text" placeholder="Add Book Name" name="bookName" required>

    <label for="authorName"><b>Author Name</b></label>
    <input type="text" placeholder="Add Author Name" name="authorName" required>

    <label for="booksNumber"><b>Number of Books</b></label>
    <input type="text" placeholder="How Many" name="booksNumber" required>

        
    <button type="submit" name="submit">Add</button>
</form>
</body>

</html>