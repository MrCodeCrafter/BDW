<?php
// Set header to return JSON response
header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "blood_donation";

$conn = new mysqli($servername, $username, $password_db, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

// Check if the request form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get hospital_id from the form (submitted from search_blood.php)
    $hospital_id = $_POST['hospital_id']; // Hospital ID from search_blood.php form
    $blood_type = $_POST['blood_type']; // Blood type from the form

    // Set default values
    $quantity = 0; // Default quantity
    $request_date = date('Y-m-d'); // Current date
    $status = 'Pending'; // Default status

    // Prepare SQL statement to insert the request
    $sql = "INSERT INTO requests (hospital_id, blood_type, quantity, request_date, status) 
            VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $hospital_id, $blood_type, $quantity, $request_date, $status);

    if ($stmt->execute()) {
        // Return JSON success message
        echo json_encode(["success" => true, "message" => "Request added successfully!"]);
    } else {
        // Return JSON error message
        echo json_encode(["success" => false, "message" => "Error: " . $conn->error]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If request method is not POST, return an error
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

