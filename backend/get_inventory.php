<?php
// Start the session
session_start();

// Check if blood type is provided as input
if (!isset($_GET['blood_type']) || empty($_GET['blood_type'])) {
    echo "<p>Blood type is required.</p>";
    exit();
}

// Get the blood type from the GET request
$blood_type = $_GET['blood_type'];

// Database connection settings
$host = 'localhost';
$dbname = 'blood_donation';
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    // Connect to the database using PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get the current date
    $current_date = date('Y-m-d');

    // Query to get blood inventory for a specific blood type and where the expiry date is valid
    $stmt = $conn->prepare("SELECT blood_type, hospital_id, quantity, expirydate 
                            FROM bloodinventory 
                            WHERE blood_type = :blood_type 
                            AND expirydate >= :current_date");
    
    // Bind the blood type and current date to the query
    $stmt->bindParam(':blood_type', $blood_type);
    $stmt->bindParam(':current_date', $current_date);
    $stmt->execute();

    // Fetch data as associative array
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Display the results in an HTML table
    if ($inventory) {
 
        echo "<h2>Blood Inventory for Blood Type: " . htmlspecialchars($blood_type) . "</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Blood Type</th><th>Hospital ID</th><th>Quantity</th><th>Expiry Date</th></tr>";
        
        // Loop through the inventory and display each row
        foreach ($inventory as $item) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($item['blood_type']) . "</td>";
            echo "<td>" . htmlspecialchars($item['hospital_id']) . "</td>";
            echo "<td>" . htmlspecialchars($item['quantity']) . "</td>";
            echo "<td>" . htmlspecialchars($item['expirydate']) . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "<p>No matching blood inventory found.</p>";
    }
    
} catch (PDOException $e) {
    // Display error message in case of an exception
    echo "<p>Error: " . $e->getMessage() . "</p>";
}

// Close connection
$conn = null;
?>

