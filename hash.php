
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo password_hash('your_chosen_password', PASSWORD_DEFAULT);
?>