<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #e3f2fd;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #0d47a1;
            height: 100px;
            width: 100%;
        }
        .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: ;
            
        }
        .container {
            padding: 40px 0;
        }
        .card {
            margin: 20px;
            height: 180px;
            background-color: #ffffff;
            border: 1px solid #0d47a1;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: 0.3s;
            cursor: pointer;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-title {
            font-size: 1.5rem;
            color: #0d47a1;
        }
        .card-text {
            color: #555;
        }
        .footer {
            background-color: #0d47a1;
            color: white;
            
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 20px;
        }
        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>
<body>
    <!-- Back Button -->
    <button class="btn btn-secondary back-button" onclick="history.back()">
        <i class="fas fa-arrow-left"></i> Back
    </button>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php"><i class="fas fa-chart-line"></i> Gensys Laser - Sales Module</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Manage Sales</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card p-3" onclick="location.href='add_sale.php'">
                    <div class="card-body text-center">
                        <i class="fas fa-plus-circle fa-3x" style="color:#0d47a1;"></i>
                        <h5 class="card-title mt-3">Add New Sale</h5>
                        <p class="card-text">Click below to add a new sale record.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3" onclick="location.href='view_sales.php'">
                    <div class="card-body text-center">
                        <i class="fas fa-list-alt fa-3x" style="color:#0d47a1;"></i>
                        <h5 class="card-title mt-3">View Sales</h5>
                        <p class="card-text">Click below to view all sales reports.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card p-3" onclick="location.href='edit_sale.php'">
                    <div class="card-body text-center">
                        <i class="fas fa-edit fa-3x" style="color:#0d47a1;"></i>
                        <h5 class="card-title mt-3">Edit Sale</h5>
                        <p class="card-text">Modify an existing sale record.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card p-3" onclick="location.href='sales_report.php'">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-bar fa-3x" style="color:#0d47a1;"></i>
                        <h5 class="card-title mt-3">Sales Overview</h5>
                        <p class="card-text">Quick overview of sales metrics.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Gensys Laser. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
