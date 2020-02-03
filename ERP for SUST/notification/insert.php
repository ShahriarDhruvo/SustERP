<?php
//insert.php
    if(isset($_POST["subject"]))
    {
        
    $connect = mysqli_connect("localhost" , "root", "", "erp_datas");
    $subject = mysqli_real_escape_string($connect, $_POST["subject"]);
    $comment = mysqli_real_escape_string($connect, $_POST["comment"]);

    echo $subject ." ". $comment ;

    $query = "INSERT INTO comments (`comments_subject`, `comments_text`,`comments_status`)
    VALUES ('$subject', '$comment','0')";
    $result = mysqli_query($connect, $query);

    if(!$result) echo mysqli_error($connect);
}
?>