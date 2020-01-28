<html lang="en">
 <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <title>View Books</title>

       <link rel="stylesheet" href="StyleSheets/displaybook.css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>

<h2 class="mx-auto" style="height: 170px;">View Books</h2>

  
  <div class="container">

  <div class="form">
  <form name="form1" action="" method="post">
      <input type="text" name="t1" class="form-control" placeholder="Enter book name">
      <input type="submit" name="submit1" value="search books" class="bbtn btn-secondary">

   </form>
</div>
            <?php
         
             // Create database connection
                 $conn=mysqli_connect("localhost", "root", "");
             
             if(!$conn)
                  echo ("Error Connection: ".mysqli_connect_error());
              if(!mysqli_select_db($conn, "erp_datas"))
                  echo "Failed to load the database";
            
            ?>
  </div>

    <div class="mx-auto" style="width: 1200px;">

    <?php
        
        if(isset($_POST["submit1"]))
        {
            $result=mysqli_query($conn, "select * from addbook where Book_Name like('$_POST[t1]')");
            echo "<table class='table table-striped table-dark'>";
            echo "<th>"; echo "Books Name"; echo "</th>";
            echo "<th>"; echo "Author Name"; echo "</th>";
            echo "<th>"; echo "Number Of Books"; echo "</th>";
     
            while($row=mysqli_fetch_array($result)){
               echo "<tr>";
             echo "<td>"; echo $row["Book_Name"]; echo "</td>";
             echo "<td>"; echo $row["Author_Name"]; echo "</td>";
             echo "<td>"; echo $row["Number_Of_Books"]; echo "</td>"; 
             echo "</tr>";
            }
            echo "</table>";
        }
        else{
            $result=mysqli_query($conn, "select * from addbook");
        echo "<table class='table table-striped table-dark'>";
        echo "<th>"; echo "Books Name"; echo "</th>";
        echo "<th>"; echo "Author Name"; echo "</th>";
        echo "<th>"; echo "Number Of Books"; echo "</th>";

       while($row=mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>"; echo $row["Book_Name"]; echo "</td>";
        echo "<td>"; echo $row["Author_Name"]; echo "</td>";
        echo "<td>"; echo $row["Number_Of_Books"]; echo "</td>"; 
        echo "</tr>";
       }
       echo "</table>";
        }
       
    ?>

    </div>

</body>

</html>