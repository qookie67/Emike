<?php
// No spaces or echo before this block

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $date = $_POST['date'];

    $sql = "INSERT INTO `add-books` (title, date) VALUES ('$title', '$date')";

    if ($conn->query($sql) === TRUE) {
        header("Location: teacher.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
