<?php
// Database configuration for MAMP
define('DB_HOST', 'localhost:8889');  // MAMP default port
define('DB_USER', 'root');            // MAMP default username
define('DB_PASS', 'root');            // MAMP default password
define('DB_NAME', 'nextgen_university');

// Create database connection
function getDBConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    return $conn;
}

// Function to close database connection
function closeDBConnection($conn) {
    if ($conn) {
        $conn->close();
    }
}
?>