<?php
// Include the database connection file
include('db_connection.php');

// Check if the ID is provided
if (isset($_GET['id'])) {
    $sale_id = $_GET['id'];

    // Delete the sale from the database
    $delete_sql = "DELETE FROM sales WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $sale_id);

    if ($stmt->execute()) {
        // Redirect to view_sales.php after deletion
        header("Location: view_sales.php");
        exit;
    } else {
        echo "Error deleting sale: " . $conn->error;
    }
} else {
    echo "No sale ID provided.";
    exit;
}
?>
