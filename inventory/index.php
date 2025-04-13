<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Material Stock - Gensys Laser</title>
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
            border-color: #a0522d; /* Lighter brown on hover */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - Material Stock Module</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Manage Material Stock</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Stock</h5>
                        <form action="add_stock.php" method="POST">
                            <div class="mb-3">
                                <label for="materialName" class="form-label">Material Name</label>
                                <input type="text" class="form-control" id="materialName" name="material_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                            <div class="mb-3">
                                <label for="supplier" class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" id="supplier" name="supplier" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Stock</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Current Stock</h5>
                        <p class="card-text">Click below to view the current stock levels.</p>
                        <a href="view_stock.php" class="btn btn-primary">View Stock</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Reorder Stock</h5>
                        <p class="card-text">Manage stock reorder levels.</p>
                        <a href="reorder_stock.php" class="btn btn-primary">Reorder Stock</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
