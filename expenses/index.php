<?php
// db_connection.php - Make sure this file contains the database connection code
$servername = "localhost";
$username = "root";  // Adjust based on your setup
$password = "";      // Adjust based on your setup
$dbname = "gensys_laser_db";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted, insert the data into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    $sql = "INSERT INTO expenses (date, category, amount, description) VALUES ('$date', '$category', '$amount', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Expense added successfully!</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch existing expense records
$sql = "SELECT * FROM expenses ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Expenses - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .card {
            margin: 20px;
            background-color: #ffffff; /* White background for cards */
            border: 1px solid #0d47a1; /* Brown border */
        }
        .dashboard-container {
            padding: 50px 0;
        }
        .navbar {
            background-color: #0d47a1; /* Brown background for navbar */
            height: 100px;
        }
        .navbar-brand {
            color: white;
        }
        .card-title {
            color: #0d47a1; /* Brown color for card titles */
        }
        .btn-primary {
            background-color: #0d47a1; /* Button color */
            border-color: #0d47a1;
        }
        .btn-primary:hover {
            background-color: #0d47a1; /* Lighter brown hover */
            border-color: #a0522d;
        }
        table {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Daily Expenses</a>
        </div>
    </nav>

    <!-- Daily Expenses Dashboard -->
    <div class="container dashboard-container">
        <div class="row text-center">
            <!-- Add New Expense Form -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Expense</h5>
                        <form action="index.php" method="POST"> <!-- Ensure the action points to index.php -->
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" required>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Expense</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Display Expense Records -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Expense Records</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                            <td>{$row['id']}</td>
                                            <td>{$row['date']}</td>
                                            <td>{$row['category']}</td>
                                            <td>{$row['amount']}</td>
                                            <td>{$row['description']}</td>
                                        </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5' class='text-center'>No expenses recorded</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
