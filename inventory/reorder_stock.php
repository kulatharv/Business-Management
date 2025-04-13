<?php
// Connect to the database
$servername = "localhost";
$username = "root";  // Change if you have a different username
$password = "";      // Change if you have a password set
$dbname = "gensys_laser_db";  // Your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted, process it
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $supplier = $_POST['supplier'];

    // Insert the reorder data into the database
    $sql = "INSERT INTO reorder_stock (product_name, quantity, supplier) 
            VALUES ('$product_name', '$quantity', '$supplier')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Stock reorder request has been successfully added!</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch current reorder list
$sql = "SELECT product_name, quantity, supplier FROM reorder_stock";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reorder Stock - Gensys Laser</title>
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
            border-color: #8B4513; /* Button border color */
        }
        .btn-primary:hover {
            background-color: #0d47a1; /* Lighter brown on hover */
            border-color: #0d47a1; /* Lighter brown on hover */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - Reorder Stock</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Reorder Stock</h1>

        <!-- Form to Add New Stock Reorder -->
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Reorder</h5>
                        <form action="reorder_stock.php" method="POST">
                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="product_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" id="supplier" name="supplier" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Reorder</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Display Reorder List -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reorder List</h5>
                        <?php if ($result->num_rows > 0): ?>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Supplier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo $row['product_name']; ?></td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td><?php echo $row['supplier']; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>No reorder items found.</p>
                        <?php endif; ?>
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
