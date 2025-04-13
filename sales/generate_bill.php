<?php
include('db_connection.php'); // Ensure this file contains your DB connection

// Get the sale ID from the URL
if (isset($_GET['sale_id'])) {
    $sale_id = $_GET['sale_id'];

    // Query to get the sale data
    $sql = "SELECT * FROM sales WHERE id = '$sale_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        die("Invalid sale ID.");
    }
} else {
    die("Sale ID not specified.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill for Sale - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bill-container {
            margin-top: 50px;
            padding: 30px;
            border: 1px solid #8B4513;
            border-radius: 10px;
            background-color: #fff;
        }
        .bill-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .company-info {
            text-align: center;
            margin-bottom: 30px;
        }
        .company-info img {
            max-width: 150px; /* Adjust logo size */
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <div class="container bill-container">
        <div class="company-info">
            <img src="path/to/your/logo.png" alt="Gensys Laser Logo"> <!-- Replace with your logo -->
            <h2>Gensys Laser</h2>
            <p>Address Line 1</p>
            <p>Address Line 2</p>
            <p>Phone: +91 1234567890</p>
            <p>Email: info@gensyslasers.co.in</p>
        </div>
        
        <h1 class="bill-header">Bill for Sale</h1>

        <table class="table table-bordered">
            <tr>
                <th>Customer Name</th>
                <td><?php echo $row['customer_name']; ?></td>
            </tr>
            <tr>
                <th>Contact Number</th>
                <td><?php echo $row['contact_number']; ?></td>
            </tr>
            <tr>
                <th>Product Name</th>
                <td><?php echo $row['product_name']; ?></td>
            </tr>
            <tr>
                <th>Quantity</th>
                <td><?php echo $row['quantity']; ?></td>
            </tr>
            <tr>
                <th>Price</th>
                <td><?php echo number_format($row['price'], 2); ?> ₹</td>
            </tr>
            <tr>
                <th>Total</th>
                <td class="total"><?php echo number_format($row['quantity'] * $row['price'], 2); ?> ₹</td>
            </tr>
            <tr>
                <th>Date of Sale</th>
                <td><?php echo $row['sale_date']; ?></td>
            </tr>
        </table>

        <div class="text-center">
            <button class="btn btn-primary" onclick="window.print()">Print Bill</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
