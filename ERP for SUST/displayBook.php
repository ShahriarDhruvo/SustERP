<!-- header -->
<?php include 'header.php'; ?>
<!-- header -->

<html lang="en">

<head>
    <title>View Books</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="StyleSheets/main.css">
    <!-- <link rel="stylesheet" href="StyleSheets/displaybook.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <form name="form1" action="" method="post" class="mb-5">
            <div class="card card-body bg-light">
                <div class="form-inline">
                    <input type="text" name="t1" class="form-control mr-4" placeholder="Search books"
                        style="width: 85.5%;">
                    <button type="submit" name="submit1" class="btn btn-primary" style="width: 12%;">Search</button>
                </div>
            </div>
        </form>

        <h2>Books</h2>

        <?php
            // Create database connection
            require 'config/db.php';
            // $conn = mysqli_connect("localhost", "root", "");
            
            // if(!$conn)
            //     echo ("Error Connection: ".mysqli_connect_error());
            // if(!mysqli_select_db($conn, "erp_datas"))
            //     echo "Failed to load the database";

            $sql = "SELECT * FROM addbook";
            $search_item = null;
            
            if(isset($_POST["submit1"])){
                $sql .= " WHERE Book_Name LIKE '%".$_POST['t1']."%'";
                $search_item = $_POST['t1'];
            }
                
            $result = mysqli_query($conn, $sql);
            echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered table-hover'>";
                    echo "<thead>";
                        echo "<th scope='col'>"; echo "#"; echo "</th>";
                        echo "<th scope='col'>"; echo "Books Name"; echo "</th>";
                        echo "<th scope='col'>"; echo "Author Name"; echo "</th>";
                        echo "<th scope='col'>"; echo "Number Of Books"; echo "</th>";
                    echo "</thead>";
                    
                    while($row=mysqli_fetch_array($result)){
                        echo "<tr>";
                            echo "<th scope='row'>"; echo $row["id"]; echo "</th>";
                            echo "<td>"; echo ucfirst($row["Book_Name"]); echo "</td>";
                            echo "<td>"; echo ucfirst($row["Author_Name"]); echo "</td>";
                            echo "<td>"; echo $row["Number_Of_Books"]; echo "</td>"; 
                        echo "</tr>";
                    }
                echo "</table>";
            echo "</div>";
        ?>
    </div>

    <?php include 'footer.php'; ?>
</body>

</html>