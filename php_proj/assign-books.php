<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $book_title = $_POST['book_title'];  
    $student_name = $_POST['username'];  
    $assign_date = date("Y-m-d");        

    
    $stmt = $conn->prepare("INSERT INTO `assigned_books` (book_title, username, assign_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $book_title, $student_name, $assign_date);

    if ($stmt->execute()) {
        
        header('Location: teacher.php');  
        exit();
    } else {
        echo "Error: " . $stmt->error; 
    }

    $stmt->close();
}

$conn->close();
?>
