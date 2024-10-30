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

// Get data from POST request
$hospital_email = $_POST['hospital_email'];
$blood_type = $_POST['blood_type'];

// Optional: Fetch hospital_id from the hospitals table using the email
$sql = "SELECT id FROM hospitals WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hospital_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $hospital = $result->fetch_assoc();
    $hospital_id = $hospital['id'];

    // Insert a new request into the requests table
    $insert_sql = "INSERT INTO requests (hospital_id, blood_type, status) VALUES (?, ?, 'Pending')";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("is", $hospital_id, $blood_type);

    if ($insert_stmt->execute()) {
        // Redirect back to search_blood.php with a success message
        header("Location: search_blood.php?message=Request submitted successfully.");
        exit();
    } else {
        // Redirect back with an error message
        header("Location: search_blood.php?error=Error submitting request: " . $conn->error);
        exit();
    }

    $insert_stmt->close();
} else {
    // Redirect back if hospital not found
    header("Location: search_blood.php?error=Hospital not found.");
    exit();
}

$stmt->close();
$conn->close();
?>

