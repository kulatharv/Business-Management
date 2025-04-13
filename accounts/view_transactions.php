<?php
// db_connection.php (Make sure this file exists and contains valid database connection code)
include('../db_connection.php');

// Fetch all transactions from the database
$sql = "SELECT * FROM transactions"; // Removed ORDER BY clause
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Transactions - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .navbar {
            background-color: #0d47a1; /* Brown color */
        }
        .navbar-brand {
            color: white;
        }
        .container {
            padding: 50px 0;
        }
        .table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Gensys Laser - View Transactions</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Transactions List</h1>

        <?php if ($result->num_rows > 0): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Transaction ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['transaction_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo ucfirst($row['transaction_type']); ?></td>
                            <td><?php echo number_format($row['amount'], 2); ?></td>
                            <td><?php echo $row['description']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-center">No transactions found.</p>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-primary">Back to Accounts</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
