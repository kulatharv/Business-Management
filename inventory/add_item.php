<?php
// Include database connection
include('../db_connection.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO inventory (item_name, quantity, price, description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sids", $item_name, $quantity, $price, $description);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "Item added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>
