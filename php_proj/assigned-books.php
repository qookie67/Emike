<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_login";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT book_title, username, assign_date FROM assigned_books";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigned Books</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Assigned Books</h1>
    <table>
        <thead>
            <tr>
                <th>Book Title</th>
                <th>Username</th>
                <th>Assign Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo"<tr>
                            <td>" . htmlspecialchars($row["book_title"]) . "</td>
                            <td>" . htmlspecialchars($row["username"]) . "</td>
                            <td>" . htmlspecialchars($row["assign_date"]) . "</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No assigned books found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <p>Back to <a href="teacher.php">Login</a></p>
</body>
</html>
<?php
$conn->close();
?>