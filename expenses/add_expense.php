<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gensys_laser_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    // Insert into database
    $sql = "INSERT INTO expenses (date, category, amount, description) VALUES ('$date', '$category', '$amount', '$description')";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the index page after successful insertion
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
