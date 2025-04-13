<?php
// Include the database connection file
include('db_connection.php');

// Fetch all inquiries from the database
$query = "SELECT * FROM inquiries ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Inquiries - Gensys Laser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f9;
        }
        .navbar {
            background-color: #8B4513;
        }
        .navbar-brand {
            color: white;
        }
        table {
            width: 100%;
            margin-top: 20px;
            background-color: #ffffff;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #8B4513;
        }
        th {
            background-color: #8B4513;
            color: white;
        }
        .btn-primary {
            background-color: #8B4513;
            border-color: #8B4513;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">Gensys Laser - Inquiries</a>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mt-4 mb-4">Inquiry List</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Inquiry Type</th>
                    <th>Contact Information</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['customer_name']; ?></td>
                            <td><?php echo $row['inquiry_type']; ?></td>
                            <td><?php echo $row['contact_info']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <a href="edit_inquiry.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                <a href="delete_inquiry.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this inquiry?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No inquiries found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
