<?php
// Show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html><html><head><title>Login Debug</title></head><body>";
echo "<h1>Login Debug Page</h1>";

session_start();

echo "<p>Session started...</p>";

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<p>Form was submitted via POST</p>";
    
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        echo "<p>Username received: " . htmlspecialchars($username) . "</p>";
        echo "<p>Password received: " . (strlen($password) > 0 ? "Yes (" . strlen($password) . " chars)" : "No") . "</p>";
        
        // Database connection
        $servername = "localhost:8889";
        $db_username = "root";
        $db_password = "root";
        $dbname = "nextgen_university";
        
        echo "<p>Attempting database connection...</p>";
        
        $conn = new mysqli($servername, $db_username, $db_password, $dbname);
        
        if ($conn->connect_error) {
            echo "<p style='color:red'>Database connection failed: " . $conn->connect_error . "</p>";
        } else {
            echo "<p style='color:green'>Database connected successfully!</p>";
            
            // Simple query to check user
            $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
            echo "<p>Running query: " . $sql . "</p>";
            
            $result = $conn->query($sql);
            
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<p style='color:green'>User found: " . $row['username'] . "</p>";
                
                // For testing, let's try both plain text and hashed password
                if ($password === 'password123' || password_verify($password, $row['password'])) {
                    echo "<p style='color:green'>Password correct! Setting session...</p>";
                    
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['userid'] = $row['id'];
                    
                    echo "<p>Session variables set. Attempting redirect...</p>";
                    echo "<script>setTimeout(function(){ window.location.href = 'home.html'; }, 2000);</script>";
                    echo "<p><a href='home.html'>Click here if not redirected automatically</a></p>";
                } else {
                    echo "<p style='color:red'>Password incorrect!</p>";
                    echo "<p>Entered: '$password'</p>";
                    echo "<p>Expected: 'password123' or hash verification</p>";
                }
            } else {
                echo "<p style='color:red'>No user found with username: $username</p>";
            }
            
            $conn->close();
        }
    } else {
        echo "<p style='color:red'>Username or password not received!</p>";
    }
} else {
    echo "<p>No POST data received. Request method: " . $_SERVER["REQUEST_METHOD"] . "</p>";
    echo "<p><a href='signin.html'>Go back to sign in</a></p>";
}

echo "</body></html>";
?>