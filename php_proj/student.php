<?php
include 'database.php';

$books = [];
$student_name = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = $_POST['student_name'];

    $stmt = $conn->prepare("SELECT book_title, assign_date FROM assigned_books WHERE username = ?");
    $stmt->bind_param("s", $student_name);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Assigned Books</title>
    <p>Back to <a href="login.html">Login</a></p>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 10px;
        }
        th {
            background-color: #f0f0f0;
        }
        input[type="text"], input[type="submit"] {
            padding: 8px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <h1>View My Assigned Books</h1>
    <form method="POST" action="">
        <label for="student_name">Enter your name:</label><br>
        <input type="text" name="student_name" value="<?= htmlspecialchars($student_name) ?>" required>
        <input type="submit" value="Check Books">
    </form>

    <?php if (!empty($books)): ?>
        <h2>Books assigned to <?= htmlspecialchars($student_name) ?>:</h2>
        <table>
            <tr>
                <th>Book Title</th>
                <th>Assigned Date</th>
            </tr>
            <?php foreach ($books as $book): ?>
                <tr>
                    <td><?= htmlspecialchars($book['book_title']) ?></td>
                    <td><?= htmlspecialchars($book['assign_date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p>No books assigned to <?= htmlspecialchars($student_name) ?>.</p>
    <?php endif; ?>
</body>
</html>

<?php $conn->close(); ?>
