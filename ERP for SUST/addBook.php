<?php 
    require 'config/db.php';
    include 'header.php'
?>

<html lang="en">

<head>
    <title>Add Book</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/index.css">
    <!-- <link rel="stylesheet" href="StyleSheets/addBook.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <?php
          ini_set('upload_max_filesize', '10M');
          ini_set('post_max_size', '10M');
          ini_set('max_input_time', 300);
          ini_set('max_execution_time', 300);

          // Create database connection
        //   require 'config/db.php';
          
          if(!$conn)
          echo "<font color='#FF0000'>"."Error Connection: ".mysqli_connect_error()."</font>";

          if(isset($_POST['submit'])){          
            $Book_name=$_POST['bookName'];
            $Author_name=$_POST['authorName'];
            $Number_of_books=$_POST['booksNumber'];
            
            //$name = htmlspecialchars($_FILES['files']['name']);

            $sql="INSERT INTO addbook (Book_Name, Author_Name, Number_Of_Books)
            VALUES('$Book_name', '$Author_name', '$Number_of_books')";

            $result = mysqli_query($conn, $sql);

            $data = mysqli_query($conn, "SELECT MAX(id) FROM addbook");
            $inc = mysqli_fetch_row($data);
            //    $id = $inc[0] + 1;

            //    $file = "(".$id.")_".$name;
            //    $target = "Data/books/".basename($file);

            if(!$result)
              echo "<font color='#FF0000'>There is an error while quering</font>";

            // if(move_uploaded_file($_FILES['files']['tmp_name'], $target))
              // $msg = "File uploaded successfully";
            else
              $msg = "Book uploaded successfully";

              echo '<script language="javascript">';
              echo 'alert("'.$msg.'")';
              echo '</script>';

              $URL="addBook.php";
              echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
              echo '<META HTTP-EQUIV="refresh" content="0;URL='.$URL.'">';

              // header("refresh: 0.5; url = addBook.php");
          }
      ?>

        <h2>Add Books</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 card card-body bg-light">
                    <label for="bookName" class="mt-2"><b>Book Name</b></label>
                    <input type="text" placeholder="Book name" name="bookName" class="form-control" required>

                    <label for="authorName" class="mt-2"><b>Author Name</b></label>
                    <input type="text" placeholder="Author name" name="authorName" class="form-control" required>

                    <label for="booksNumber" class="mt-2"><b>Number of Books</b></label>
                    <input type="number" min="0" placeholder="Number of books" name="booksNumber" class="form-control"
                        required>

                    <button type="submit" name="submit" class="btn btn-primary mt-4">Add</button>
                </div>
                <div class="col-md-3"></div>
            </div>
        </form>
    </div>

    <div class="fixed-bottom">
        <?php include 'footer.php'; ?>
    </div>
</body>

</html>