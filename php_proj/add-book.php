<?php 
    $conn = mysqli_connect("localhost", "root", "", "user_login");    

    $book_title = $_POST["title"];
    $date_added = $_POST["date"];

    if($book_title != "" && $book_description != ""){
        $query = "INSERT INTO `add-books` (title, description, cover_image) VALUES ('$book_title', '$book_description', '$book_cover')";

        try{
            mysqli_query($conn, $query);
        }catch(Exception $e){
            echo $e;
        }
    }

    header("Location: teacher.html");
?>