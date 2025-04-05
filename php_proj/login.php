<?php
//di pa tapos
include __DIR__ . "/database.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        
        if (password_verify($password, $user['password'])) {
            echo "Login successful! Welcome, " . $user['fullname'];
            
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
