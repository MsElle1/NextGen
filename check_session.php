<?php
session_start();

// Set content type to JSON
header('Content-Type: application/json');

// Check if user is logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo json_encode([
        'loggedIn' => true,
        'username' => $_SESSION['username'],
        'userid' => $_SESSION['userid']
    ]);
} else {
    echo json_encode([
        'loggedIn' => false
    ]);
}
?>
