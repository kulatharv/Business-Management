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
    <title>Track Inquiries - Gensys Laser</title>
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
            border-color: #0d47a1; /* Lighter brown on hover */
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - Inquiry Tracking</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Track Inquiry Follow-ups</h1>

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
                                    <th>Follow-up Actions</th>
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
                                                <td>
                                                    <a href='add_follow_up.php?id={$row['id']}' class='btn btn-primary'>Add Follow-up</a>
                                                    <a href='view_follow_up.php?id={$row['id']}' class='btn btn-primary'>View Follow-ups</a>
                                                </td>
                                            </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>No inquiries found</td></tr>";
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
