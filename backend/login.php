<?php
session_start();
$email = $_POST['email'];
$password = $_POST['password'];

// Database connection
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "blood_donation";

$conn = new mysqli($servername, $username, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user exists
$sql = "SELECT * FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    // Set session and redirect to dashboard
    $_SESSION['donor_id'] = $user['id'];
    header("Location: donor_dashboard.php");
} else {
    // Redirect back with error message
    header("Location: ../public/donor_login.html?error=invalid_credentials");
    exit();
}
?>

