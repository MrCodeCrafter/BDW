<?php
// Start session and check if the user is logged in
session_start();
if (!isset($_SESSION['donor_id'])) {
    // Redirect to login if not logged in
    header("Location: ../public/donor_login.html");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "blood_donation";

$conn = new mysqli($servername, $username, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch donor data based on session donor_id
$donor_id = $_SESSION['donor_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $donor_id);
$stmt->execute();
$result = $stmt->get_result();
$donor = $result->fetch_assoc();

// Fetch donation statistics (Total Donations and Last Donation Date)
$sql_donations = "SELECT SUM(quantity) AS total_donations, MAX(donation_date) AS last_donation_date FROM donations WHERE user_id = ?";
$stmt_donations = $conn->prepare($sql_donations);
$stmt_donations->bind_param("i", $donor_id);
$stmt_donations->execute();
$result_donations = $stmt_donations->get_result();
$donation_stats = $result_donations->fetch_assoc();

$total_donations = $donation_stats['total_donations'] ?? 0;
$last_donation_date = $donation_stats['last_donation_date'] ?? 'No donations yet';

// Check if a location search has been submitted
$search_results = [];
if (isset($_POST['search_location'])) {
    $location = $_POST['location'];
    $sql_hospitals = "SELECT * FROM hospitals WHERE location LIKE ?";
    $stmt_hospitals = $conn->prepare($sql_hospitals);
    $search_param = "%" . $location . "%";
    $stmt_hospitals->bind_param("s", $search_param);
    $stmt_hospitals->execute();
    $result_hospitals = $stmt_hospitals->get_result();
    $search_results = $result_hospitals->fetch_all(MYSQLI_ASSOC);
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Dashboard</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <header>
<<<<<<< HEAD
        
        <nav>
        <ul>
		<li><a href="index.php" class="active">Home</a></li>
            	<li><a href="logout.php">Login Out</a></li>
        </ul>
    </nav>
=======
        <h1>Welcome <?php echo htmlspecialchars($donor['name']); ?>!</h1>
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7

 
    </header>

    <section class="dashboard">
        <div class="profile-box">
<<<<<<< HEAD
         <h2>Your Profile</h2><br>
        <b><font size="10">Welcome <?php echo htmlspecialchars($donor['name']); ?>!</font></b><br><br>
           
=======
            <h2>Your Profile</h2>
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7

            <div class="donation-stats">
                <p><strong>Name:</strong> <?php echo htmlspecialchars($donor['name']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($donor['location']); ?></p>
                <p><strong>Blood Type:</strong> <?php echo htmlspecialchars($donor['blood_type']); ?></p>
                <p><strong>Total Donations:</strong> <?php echo $total_donations; ?></p>
                <p><strong>Last Donation Date:</strong> <?php echo $last_donation_date; ?></p>
            </div>

            <!-- Add Location Search Form -->
            <h2>Search Hospitals</h2>
            <form method="POST" action="">
                <label for="location">Enter Location:</label>
                <input type="text" id="location" name="location" required>
                <button type="submit" name="search_location">Search</button>
            </form>

            <!-- Display Search Results -->
            <?php if (!empty($search_results)) : ?>
                <h3>Available Hospitals</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Hospital Name</th>
                            <th>Location</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($search_results as $hospital) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($hospital['hospital_name']); ?></td>
                                <td><?php echo htmlspecialchars($hospital['location']); ?></td>
                                <td><?php echo htmlspecialchars($hospital['email']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php elseif (isset($_POST['search_location'])): ?>
                <p>No hospitals found in this location.</p>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Blood Donation. All rights reserved.</p>
    </footer>
</body>
</html>

