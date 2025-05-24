<?php
$servername = "localhost";
$username = "root"; // Default username in XAMPP
$password = "";     // Default no password
$database = "user_management"; // Your database name

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
