<?php
session_start();

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// Database connection details
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "blood_donation";

// Establish the connection
$conn = new mysqli($servername, $username, $password_db, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user exists
$sql = "SELECT * FROM hospitalstaffs WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    // Set session and redirect to dashboard
    $_SESSION['staff_id'] = $user['id'];
    $_SESSION['staff_name'] = $user['name'];
    header("Location: ../public/inventory.html");
} else {
    // Redirect back with error message
    header("Location: ../public/hospital_login.html?error=invalid_credentials");
    exit();
}

// Close the connection
$conn->close();
?>

