<?php
// Include database connection
include('../db_connection.php');

// Fetch transactions including the transaction date
$sql = "SELECT transaction_id, name, transaction_type, amount, description, transaction_date FROM transactions ORDER BY transaction_id DESC";
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report - Gensys Laser</title>
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
        .card {
            margin: 20px 0;
            background-color: #ffffff; /* White background for cards */
            border: 1px solid #0d47a1; /* Brown border for cards */
        }
        .card-title {
            font-size: 1.5rem;
            color: #0d47a1; /* Brown color for titles */
        }
        .btn-primary {
            background-color: #0d47a1; /* Button color */
            border-color: #0d47a1; /* Button border color */
        }
        .btn-primary:hover {
            background-color: #0d47a1; /* Lighter brown on hover */
            border-color: #a0522d; /* Lighter brown on hover */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - Transaction Report</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Transaction Report</h1>
        
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">All Transactions</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Transaction ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Date</th> <!-- Added date column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Displaying the transactions
                        $index = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $index++ . '</td>';
                            echo '<td>' . htmlspecialchars($row['transaction_id']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                            echo '<td>' . ucfirst($row['transaction_type']) . '</td>';
                            echo '<td>' . number_format($row['amount'], 2) . '</td>';
                            echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                            echo '<td>' . date("Y-m-d H:i:s", strtotime($row['transaction_date'])) . '</td>'; // Format date
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
