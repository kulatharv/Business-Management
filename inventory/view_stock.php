<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Stock - Gensys Laser</title>
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
            <a class="navbar-brand" href="index.php">Gensys Laser - Material Stock Module</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Current Material Stock</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Material Name</th>
                    <th>Quantity</th>
                    <th>Supplier Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Define database connection variables
                $servername = "localhost";
                $username = "root"; // Your MySQL username
                $password = ""; // Your MySQL password (leave empty if not set)
                $dbname = "gensys_laser_db"; // Your database name

                // Database connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data from the stock table
                $result = $conn->query("SELECT * FROM stock");

                // Display data in the table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['material_name']}</td>
                        <td>{$row['quantity']}</td>
                        <td>{$row['supplier']}</td>
                    </tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
