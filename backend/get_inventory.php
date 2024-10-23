<?php
// Database connection settings
$host = 'localhost';
$dbname = 'blood_donation';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get blood inventory data
    $stmt = $conn->prepare("SELECT blood_type, quantity, expirydate FROM bloodinventory");
    $stmt->execute();

    // Fetch data as associative array
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the data as JSON
    echo json_encode($inventory);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close connection
$conn = null;
?>
