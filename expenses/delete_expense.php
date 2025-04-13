<?php
// delete_expense.php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gensys_laser_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM expenses WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Expense deleted successfully!";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
header('Location: view_expense.php'); // Redirect to view_expense.php
exit;
?>
