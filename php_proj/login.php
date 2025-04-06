<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);

    
    $stmt->execute();
    $stmt->store_result();

    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        
        if (password_verify($password, $hashed_password)) {
            
            session_start();
            $_SESSION['user_id'] = $id;

            
            if ($role == 'teacher') {
                header("Location: teacher.html");
            } else if ($role == 'student') {
                header("Location: student.html");
            } 
            exit();
        } else {
            
            echo "Invalid password.";
        }
    } else {
        
        echo "No account found with that email.";
    }

    $stmt->close();
}

$conn->close();
?>
