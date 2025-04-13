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

// Add Inquiry Logic
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $inquiry_type = $_POST['inquiry_type'];
    $contact_info = $_POST['contact_info'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO inquiries (customer_name, inquiry_type, contact_info) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $customer_name, $inquiry_type, $contact_info);

    if ($stmt->execute()) {
        echo "<script>alert('Inquiry added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding inquiry: " . $stmt->error . "');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Inquiry - Gensys Laser</title>
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
            background-color:   #0d47a1; /* Button color */
            border-color:       #0d47a1; /* Button border color */
        }
        .btn-primary:hover {
            background-color:#0d47a1; /* Lighter brown on hover */
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
        <h1 class="text-center mb-4">Add New Inquiry</h1>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inquiry Form</h5>
                        <form action="add_inquiry.php" method="POST">
                            <div class="mb-3">
                                <label for="customerName" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" id="customerName" name="customer_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="inquiryType" class="form-label">Inquiry Type</label>
                                <input type="text" class="form-control" id="inquiryType" name="inquiry_type" required>
                            </div>
                            <div class="mb-3">
                                <label for="contactInfo" class="form-label">Contact Information</label>
                                <input type="text" class="form-control" id="contactInfo" name="contact_info" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Inquiry</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Inquiries</h5>
                        <p class="card-text">Click below to view all inquiries.</p>
                        <a href="view_inquiries.php" class="btn btn-primary">View Inquiries</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
