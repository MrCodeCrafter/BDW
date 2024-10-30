<?php
<<<<<<< HEAD
error_reporting(E_ALL);
ini_set('display_errors', 1);

=======
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7
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

<<<<<<< HEAD
// If the form was submitted to request blood
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the hospital ID, blood type, and quantity from the form submission
    $hospital_id = $_POST['hospital_id'] ?? null;
    $blood_type = $_POST['blood_type'] ?? null;
    $quantity = $_POST['quantity'] ?? 1;  // Set default quantity to 1 if not provided

    if ($hospital_id && $blood_type) {
        // Default values for other columns
        $request_date = date('Y-m-d');  // Current date
        $status = 'Pending';  // Default status

        // Prepare SQL to insert request
        $insert_sql = "INSERT INTO requests (blood_type, quantity, request_date, status, hospital_id) 
                        VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("sisss", $blood_type, $quantity, $request_date, $status, $hospital_id);

        if ($stmt->execute()) {
            echo "<p>Request submitted successfully!</p>";
        } else {
            echo "<p>Error submitting request: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Invalid request data.</p>";
    }
}

// Get the search type, blood type, and location from the GET request
$search_type = $_GET['search_type'] ?? '';
$blood_type = $_GET['blood_type'] ?? '';
$location = $_GET['location'] ?? '';
=======
// Get the search type, blood type, and location from the GET request
$search_type = $_GET['search_type'];
$blood_type = $_GET['blood_type'];
$location = $_GET['location'];
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7

if ($search_type == "donor") {
    // Query to search for donors by blood type and location
    $sql = "SELECT name, email, blood_type, location FROM users WHERE blood_type = ? AND location = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $blood_type, $location);
<<<<<<< HEAD
} else if ($search_type == "hospital") {
    // Query to search for hospitals by location (no blood type filter)
    $sql = "SELECT hosp_id, hospital_name AS name, email, location FROM hospitals WHERE location = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $location);
} else {
    echo "Invalid search type.";
    exit();
=======
} else {
    // Query to search for hospitals by location (no blood type filter)
    $sql = "SELECT hospital_name AS name, email, location FROM hospitals WHERE location = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $location);
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    include('search.php');  // Include the search page header and form

<<<<<<< HEAD
=======
    // Display results in a table
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7
    echo "<section class='results-section'>";
    echo "<h2>Search Results</h2>";
    echo "<table>";

<<<<<<< HEAD
=======
    // Dynamically generate table headers and data based on search type
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7
    if ($search_type == "donor") {
        echo "<tr><th>Donor Name</th><th>Email</th><th>Blood Type</th><th>Location</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
<<<<<<< HEAD
            echo "<td>" . htmlspecialchars($row['name'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['email'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['blood_type'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['location'] ?? 'N/A') . "</td>";
=======
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['blood_type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['location']) . "</td>";
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7
            echo "</tr>";
        }
    } else {
        echo "<tr><th>Hospital Name</th><th>Email</th><th>Location</th><th>Request Blood</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
<<<<<<< HEAD
            echo "<td>" . htmlspecialchars($row['name'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['email'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['location'] ?? 'N/A') . "</td>";
            echo "<td>
                    <form action='' method='POST'>
                        <input type='hidden' name='hospital_id' value='" . htmlspecialchars($row['hosp_id'] ?? '') . "'>
                        <input type='hidden' name='blood_type' value='" . htmlspecialchars($blood_type) . "'>
                        <label for='quantity'>Quantity:</label>
                        <input type='number' name='quantity' id='quantity' min='1' value='1'>
                        <button type='submit'>Request</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    }

=======
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
    
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7
    echo "</table>";
    echo "</section>";
} else {
    echo "No results found for the selected search type and location.";
}

$stmt->close();
$conn->close();
?>

