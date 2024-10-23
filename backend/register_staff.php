<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Start session if needed
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "blood_donation";

$conn = new mysqli($servername, $username, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input data and sanitize
    $name = trim($_POST['name']);
    $hospital_id = trim($_POST['hospital_id']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate required fields
    if (empty($name) || empty($hospital_id) || empty($email) || empty($password)) {
        header("Location: ../public/staff.html?error=empty_fields");
        exit();
    }

    // Check if email already exists
    $sql_check = "SELECT * FROM hospitalstaffs WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        header("Location: ../public/staff.html?error=email_exists");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql_insert = "INSERT INTO hospitalstaffs (name, hospital_id, email, password) VALUES (?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ssss", $name, $hospital_id, $email, $hashed_password);

    if ($stmt_insert->execute()) {
        // Redirect to success page or login
        header("Location: ../public/hospital_login.html?success=registered");
    } else {
        // Handle SQL execution error
        header("Location: ../public/staff.html?error=registration_failed");
    }
    
    // Close statement
    $stmt_insert->close();
}

// Close database connection
$conn->close();
?>

