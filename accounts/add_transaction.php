<?php
include 'db_connection.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from the form
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    // Prepare an insert statement
    $sql = "INSERT INTO expenses (date, category, amount, description) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $date, $category, $amount, $description);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        echo "Expense added successfully.";
        // Redirect back to the index page (optional)
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
