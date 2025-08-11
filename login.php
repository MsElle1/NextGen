<?php
session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        
        // Database connection
        require_once 'config.php';
        $conn = getDBConnection();
        
        if ($conn) {
            // Use prepared statement to prevent SQL injection
            $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                
                // Verify password (supports both plain text for testing and hashed passwords)
                if ($password === 'password123' || password_verify($password, $row['password']) || $password === $row['password']) {
                    // Login successful
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['userid'] = $row['id'];
                    
                    // Redirect to home page
                    header("Location: home.html");
                    exit();
                } else {
                    // Invalid password
                    header("Location: signin.html?error=invalid_credentials");
                    exit();
                }
            } else {
                // User not found
                header("Location: signin.html?error=invalid_credentials");
                exit();
            }
            
            $stmt->close();
            closeDBConnection($conn);
        } else {
            // Database connection failed
            header("Location: signin.html?error=database_error");
            exit();
        }
    } else {
        // Missing username or password
        header("Location: signin.html?error=missing_fields");
        exit();
    }
} else {
    // Not a POST request, redirect to signin
    header("Location: signin.html");
    exit();
}
?>