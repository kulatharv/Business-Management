<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change this if your MySQL username is different
$password = ""; // Change this if you have a password
$dbname = "gensys_laser_db"; // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO stock (material_name, quantity, supplier) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $material_name, $quantity, $supplier);

// Set parameters and execute
$material_name = $_POST['material_name'];
$quantity = $_POST['quantity'];
$supplier = $_POST['supplier'];

if ($stmt->execute()) {
    echo "New stock added successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
