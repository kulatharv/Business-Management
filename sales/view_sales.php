<?php
include('db_connection.php'); // Ensure this file contains your DB connection

// Query to get sales data
$sql = "SELECT * FROM sales";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sales - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #004080; height: 100px;">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - View Sales</a>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="text-center">Sales Records</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Contact Number</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sale Date</th>
                    <th>Actions</th>
                    <th>Generate Bill</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row['customer_name'] . "</td>
                                <td>" . $row['contact_number'] . "</td>
                                <td>" . $row['product_name'] . "</td>
                                <td>" . $row['quantity'] . "</td>
                                <td>" . $row['price'] . "</td>
                                <td>" . $row['sale_date'] . "</td>
                                <td>
                                    <a href='edit_sale.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_sale.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a>
                                </td>
                                <td>
                                    <a href='generate_bill.php?sale_id=" . $row['id'] . "' class='btn btn-primary btn-sm' target='_blank'>Generate Bill</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No sales found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
