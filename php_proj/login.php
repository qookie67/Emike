<?php
include __DIR__ . "/database.php"; // database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to get user
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    // If user is found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            echo "✅ Login successful! Welcome, " . $user['fullname'];
            // You can redirect to a dashboard page like this:
            // header("Location: dashboard.php");
            // exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Email not found!";
    }

    $stmt->close();
    $conn->close();
}
?>
