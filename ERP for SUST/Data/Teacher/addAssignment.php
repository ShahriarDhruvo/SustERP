<html>
    <head>
        <title>Assignments</title>
    </head>
    <body>
        <?php
            $dbh = new PDO("mysql:host=localhost; dbname=erp_datas", "root", "");
            if(isset($_POST['btn'])){
                $name = $_FILES['myfile']['name'];
                $type = $_FILES['myfile']['type'];
                $data = file_get_contents($_FILES['myfile']['tmp_name']);
                $stmt = $dbh->prepare("insert into assignments values('', ?, ?, ?)");
                $stmt->bindParam(1, $name);
                $stmt->bindParam(2, $type);
                $stmt->bindParam(3, $data);
                $stmt->execute();
            }
        ?>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="myfile">
            <button name="btn">Upload</button>
        </form>
        <p></p>
        <ol>
            <?php
                $stat = $dbh->prepare("select * from assignments");
                $stat->execute();
                while($row = $stat->fetch()){
                    echo "<li><a target='_blank' href='view.php?id=".$row['id']."'>".$row['name']."</a><br>
                    <embed src='data:".$row['type'].";base64,".base64_encode($row['data'])."' width='200'></li>";
                }
            ?>
        </ol>
    </body>
</html>