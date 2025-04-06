<?php
include 'database.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $book_title = $_POST['book_title'];  // Correct variable for book title
    $student_name = $_POST['username'];  // Correct variable for student name
    $assign_date = date("Y-m-d");        // Today's date

    // Prepare SQL query to insert the assigned book into the database
    $stmt = $conn->prepare("INSERT INTO `assigned_books` (book_title, username, assign_date) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $book_title, $student_name, $assign_date);

    if ($stmt->execute()) {
        // Redirect to teacher dashboard after successful insertion
        header('Location: teacher-dashboard.php');  // Replace with the actual dashboard URL if needed
        exit();
    } else {
        echo "❌ Error: " . $stmt->error;  // Display an error message if insertion fails
    }

    $stmt->close();
}

$conn->close();
?>
