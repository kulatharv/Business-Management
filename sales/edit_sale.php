<?php
// Include the database connection file
include('db_connection.php');

// Check if the ID is provided
if (isset($_GET['id'])) {
    $sale_id = $_GET['id'];

    // Fetch the sale details from the database
    $sql = "SELECT * FROM sales WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $sale_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the sale exists
    if ($result->num_rows > 0) {
        $sale = $result->fetch_assoc();
    } else {
        echo "Sale not found.";
        exit;
    }
} else {
    echo "No sale ID provided.";
    exit;
}

// Update the sale details if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'];
    $contact_number = $_POST['contact_number'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $sale_date = $_POST['sale_date'];

    $update_sql = "UPDATE sales SET customer_name=?, contact_number=?, product_name=?, quantity=?, price=?, sale_date=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssiiisi", $customer_name, $contact_number, $product_name, $quantity, $price, $sale_date, $sale_id);
    if ($update_stmt->execute()) {
        header("Location: view_sales.php"); // Redirect to the sales view page
        exit;
    } else {
        echo "Error updating sale: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sale - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#004080; height: 100px;">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - Edit Sale</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Edit Sale</h1>
        <div class="card shadow p-4">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="customerName" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="customerName" name="customer_name" value="<?php echo $sale['customer_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="contactNumber" class="form-label">Contact Number</label>
                    <input type="text" class="form-control" id="contactNumber" name="contact_number" value="<?php echo $sale['contact_number']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="product_name" value="<?php echo $sale['product_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $sale['quantity']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo $sale['price']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="saleDate" class="form-label">Date of Sale</label>
                    <input type="date" class="form-control" id="saleDate" name="sale_date" value="<?php echo $sale['sale_date']; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Sale</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
