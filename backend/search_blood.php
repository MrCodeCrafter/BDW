<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the blood type and location from the GET request
$blood_type = $_GET['blood_type'];
$location = $_GET['location'];

// Query to search for donors by blood type and location, and select email as well
$sql = "SELECT name, email, blood_type, location FROM users WHERE blood_type = ? AND location = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $blood_type, $location);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Include the search page so that the results are shown in the table
    include('search.php');

    // Dynamically populate the results into the table
    echo "<section class='results-section'>";
    echo "<h2>Search Results</h2>";
    echo "<table>";
    echo "<tr><th>Donor Name</th><th>Email</th><th>Blood Type</th><th>Location</th></tr>";
    // Fetch each row and display it in the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['blood_type'] . "</td><td>" . $row['location'] . "</td></tr>";
    }
    echo "</table>";
    echo "</section>";
} else {
    echo "No donors found for the selected blood type and location.";
}

$stmt->close();
$conn->close();
?>

