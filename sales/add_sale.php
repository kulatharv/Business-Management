<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'gensys_laser_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sale_id = null;
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $conn->real_escape_string($_POST['customer_name']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    $sale_date = $_POST['sale_date'];
    $products = $_POST['products'];
    
    $sql = "INSERT INTO sales (customer_name, contact_number, sale_date) VALUES ('$customer_name', '$contact_number', '$sale_date')";
    
    if ($conn->query($sql) === TRUE) {
        $sale_id = $conn->insert_id;
        foreach ($products as $product) {
            $product_name = $conn->real_escape_string($product['name']);
            $quantity = (int)$product['quantity'];
            $price = (float)$product['price'];
            $gst_percentage = (float)$product['gst_percentage'];
            $gst_amount = ($price * $gst_percentage) / 100;
            $total_amount = $price + $gst_amount;
            
            $sql_product = "INSERT INTO sale_items (sale_id, product_name, quantity, price, gst_percentage, gst_amount, total_amount) VALUES ('$sale_id', '$product_name', '$quantity', '$price', '$gst_percentage', '$gst_amount', '$total_amount')";
            $conn->query($sql_product);
        }
        $message = "New sale record created successfully!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Sale - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #eef2f3; }
        .navbar { background-color: #004080; }
        .navbar-brand { color: white; }
        .container { padding: 40px 0; }
        .card { border: none; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .card-title { font-size: 1.5rem; color: #004080; }
        .btn-primary { background-color: #004080; border-color: #004080;display: grid; grid-gap: 100px; }
        
        .btn-primary:hover { background-color: #0056b3; border-color: #0056b3; }
    </style>
    <script>
        function addProductField() {
            const container = document.getElementById("product-container");
            const div = document.createElement("div");
            div.classList.add("mb-3", "product-item");
            div.innerHTML = `
                <input type="text" class="form-control mb-2" name="products[][name]" placeholder="Product Name" required>
                <input type="number" class="form-control mb-2" name="products[][quantity]" placeholder="Quantity" required>
                <input type="number" class="form-control mb-2" name="products[][price]" placeholder="Price" step="0.01" required>
                <input type="number" class="form-control mb-2" name="products[][gst_percentage]" placeholder="GST (%)" step="0.01" required>
                <button type="button" class="btn btn-danger btn-sm" onclick="this.parentElement.remove()">Remove</button>
            `;
            container.appendChild(div);
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - Add Sale</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Add New Sale</h1>
        <?php if (!empty($message)) : ?>
            <div class="alert alert-info text-center"> <?php echo $message; ?> </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4">
                    <div class="card-body">
                        <form action="add_sale.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Customer Name</label>
                                <input type="text" class="form-control" name="customer_name" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contact Number</label>
                                <input type="text" class="form-control" name="contact_number" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date of Sale</label>
                                <input type="date" class="form-control" name="sale_date" required>
                            </div>
                            <div id="product-container"></div>
                            <button type="button" class="btn btn-secondary w-100 mb-2" onclick="addProductField()">Add Product</button>
                            <button type="submit" class="btn btn-primary w-100">Add Sale</button>
                            
                        </form>
                        <?php if ($sale_id) : ?>
                            <div class="mt-3 text-center">
                                <a href="generate_bill.php?sale_id=<?php echo $sale_id; ?>" target="_blank" class="btn btn-success w-100">Generate Bill</a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
