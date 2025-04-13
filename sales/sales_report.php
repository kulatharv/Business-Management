<?php
// Include the database connection file
include('db_connection.php');

if (isset($_POST['generate_report'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Fetch inventory data for the specified date range
    $query = "SELECT * FROM inventory WHERE entry_date BETWEEN '$start_date' AND '$end_date'";
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Report - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .navbar {
            background-color: #004080; /* Brown color */
            font-size: 24px;
            height: 100px;
        }
        .navbar-brand {
            color: white;
        }
        @media print {
            .navbar, .btn, footer {
                display: none; /* Hide navbar, buttons, and footer on print */
            }
            h1, h2 {
                text-align: center;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - Inventory Report</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Generate Inventory Report</h1>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
            <button type="submit" name="generate_report" class="btn btn-primary">Generate Report</button>
        </form>

        <?php if (isset($result) && $result->num_rows > 0): ?>
            <h2 class="mt-4 text-center">Inventory Report from <?php echo $start_date; ?> to <?php echo $end_date; ?></h2>
            <h3 class="text-center">Gensys Laser</h3>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Supplier</th>
                        <th>Entry Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['item_name']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['supplier']; ?></td>
                            <td><?php echo $row['entry_date']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <button onclick="window.print();" class="btn btn-secondary">Print Report</button>
        <?php elseif (isset($result)): ?>
            <h4 class="mt-4">No inventory records found for the selected date range.</h4>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
