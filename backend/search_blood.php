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

// Get the search type, blood type, and location from the GET request
$search_type = $_GET['search_type'];
$blood_type = $_GET['blood_type'];
$location = $_GET['location'];

if ($search_type == "donor") {
    // Query to search for donors by blood type and location
    $sql = "SELECT name, email, blood_type, location FROM users WHERE blood_type = ? AND location = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $blood_type, $location);
} else {
    // Query to search for hospitals by location (no blood type filter)
    $sql = "SELECT hospital_name AS name, email, location FROM hospitals WHERE location = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $location);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    include('search.php');  // Include the search page header and form

    // Display results in a table
    echo "<section class='results-section'>";
    echo "<h2>Search Results</h2>";
    echo "<table>";

    // Dynamically generate table headers and data based on search type
    if ($search_type == "donor") {
        echo "<tr><th>Donor Name</th><th>Email</th><th>Blood Type</th><th>Location</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['blood_type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['location']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><th>Hospital Name</th><th>Email</th><th>Location</th><th>Request Blood</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['location']) . "</td>";
            echo "<td><form action='fetch_requests.php' method='POST'>";
            echo "<input type='hidden' name='hospital_email' value='" . htmlspecialchars($row['email']) . "'>";
            echo "<input type='hidden' name='blood_type' value='" . htmlspecialchars($blood_type) . "'>";
            echo "<button type='submit'>Request</button>";
            echo "</form></td>";
            echo "</tr>";
        }
    }
    
    echo "</table>";
    echo "</section>";
} else {
    echo "No results found for the selected search type and location.";
}

$stmt->close();
$conn->close();
?>
