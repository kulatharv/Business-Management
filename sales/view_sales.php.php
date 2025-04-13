<?php
// Include database connection file
include 'db_connection.php'; // Replace with your actual database connection file

// Fetch sales data from the database
$query = "SELECT * FROM sales";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sales - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .navbar {
            background-color: #8B4513; /* Brown color */
        }
        .navbar-brand {
            color: white;
        }
        .container {
            padding: 50px 0;
        }
        .table {
            background-color: #ffffff; /* White background for table */
        }
        .btn-danger {
            background-color: #dc3545; /* Danger color */
            border-color: #dc3545; /* Button border color */
        }
        .btn-danger:hover {
            background-color: #c82333; /* Darker red on hover */
            border-color: #bd2130; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - View Sales</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Sales Records</h1>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Contact Number</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo $row['contact_number']; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['sale_date']; ?></td>
                            <td>
                                <a href="edit_sale.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="delete_sale.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this sale?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No sales records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="text-center">
            <a href="add_sale.php" class="btn btn-primary">Add New Sale</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
