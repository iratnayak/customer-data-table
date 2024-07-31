<?php
// Database credentials
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'datatable_db';

// Create connection
$con = mysqli_connect($host, $user, $password, $database);

// Check connection
if(mysqli_connect_errno()) {
    // Display error message for debugging (remove in production)
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// Set character set to utf8
mysqli_set_charset($con, 'utf8');
?>
