<?php
// db_connection.php
$host = 'localhost';
$db = 'gensys_laser_db';
$user = 'root'; // Your database username
$pass = ''; // Your database password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all inquiries
$query = "SELECT * FROM inquiries";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiries - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .navbar {
            background-color: #004080; /* Brown color */
            font-size: 24px;
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
            border-color:rgb(50, 132, 219); /* Button border color */
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
            <a class="navbar-brand" href="../index.php">Gensys Laser - Inquiries Module</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Manage Inquiries</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add New Inquiry</h5>
                        <p class="card-text">Click below to add a new inquiry.</p>
                        <a href="add_inquiry.php" class="btn btn-primary">Add Inquiry</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View All Inquiries</h5>
                        <p class="card-text">Click below to view all inquiries.</p>
                        <a href="view_inquiries.php" class="btn btn-primary">View Inquiries</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inquiry List</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Inquiry Type</th>
                                    <th>Contact Information</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>
                                                <td>{$row['customer_name']}</td>
                                                <td>{$row['inquiry_type']}</td>
                                                <td>{$row['contact_info']}</td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='text-center'>No inquiries found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inquiry Follow-ups</h5>
                        <p class="card-text">Track follow-ups on customer inquiries.</p>
                        <a href="follow_up_inquiries.php" class="btn btn-primary">Track Follow-ups</a>
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
