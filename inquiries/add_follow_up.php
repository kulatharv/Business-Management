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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inquiry_id = $_POST['inquiry_id'];
    $follow_up_date = $_POST['follow_up_date'];
    $notes = $_POST['notes'];

    // Insert follow-up details into the database
    $stmt = $conn->prepare("INSERT INTO follow_ups (inquiry_id, follow_up_date, notes) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $inquiry_id, $follow_up_date, $notes);

    if ($stmt->execute()) {
        echo "<script>alert('Follow-up added successfully!'); window.location.href='follow_up_inquiries.php';</script>";
    } else {
        echo "<script>alert('Error adding follow-up.');</script>";
    }

    $stmt->close();
}

// Get inquiry ID from URL
if (isset($_GET['id'])) {
    $inquiry_id = $_GET['id'];
    // Fetch inquiry details
    $query = "SELECT * FROM inquiries WHERE id = $inquiry_id";
    $result = $conn->query($query);
    $inquiry = $result->fetch_assoc();
} else {
    die("Invalid inquiry ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Follow-up - Gensys Laser</title>
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
            font-size: 24px;
            color: #0d47a1; /* Brown color for titles */
            
        }
        .btn-primary {
            background-color: #0d47a1; /* Button color */
            border-color: #0d47a1v; /* Button border color */
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
            <a class="navbar-brand" href="../index.php">Gensys Laser - Add Follow-up</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-4">Add Follow-up for Inquiry: <?php echo htmlspecialchars($inquiry['customer_name']); ?></h1>

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="POST">
                            <input type="hidden" name="inquiry_id" value="<?php echo htmlspecialchars($inquiry['id']); ?>">
                            <div class="mb-3">
                                <label for="follow_up_date" class="form-label">Follow-up Date</label>
                                <input type="date" class="form-control" id="follow_up_date" name="follow_up_date" required>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Follow-up</button>
                        </form>
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
