<?php
// db_connection.php
$servername = "localhost";
$username = "root";  // Default username for XAMPP
$password = "";      // Leave blank for XAMPP
$dbname = "gensys_laser_db";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
