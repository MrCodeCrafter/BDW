
<?php

// Start session and check if the user is logged in
session_start();
if (!isset($_SESSION['donor_id'])) {
    // Redirect to login if not logged in
    header("Location: ../public/donor_login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo">
        </div>
        <nav>
            <ul>
<<<<<<< HEAD
                <li><a href="../public/index.html">Home</a></li>
=======
                 <li><a href="../public/index.html">Home</a></li>
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7
                <li><a href="../public/search.html">Search Blood Inventory</a></li>
                <li><a href="../public/admin_dashboard.html">Admin Dashboard</a></li>
                <li><a href="../public/donor_dashboard.html">Donor Dashboard</a></li>
                <li><a href="../public/recipient_dashboard.html">Recipient Dashboard</a></li>
                <li><a href="../public/login.html" class="btn">Login</a></li>
            </ul>
        </nav>
    </header>

    <section class="inventory container">
        <h2>Blood Inventory</h2>
        <table>
            <tr>
                <th>Blood Type</th>
                <th>Quantity Available</th>
                <th>Last Donated</th>
            </tr>
            <!-- Blood inventory will be dynamically inserted here -->
        </table>
    </section>

    <section class="verify-section container">
        <h2>Verify Blood Donation</h2>
        <form action="backend/verify_blood.php" method="POST">
            <label for="donor_id">Donor ID:</label>
            <input type="text" id="donor_id" name="donor_id" required>

            <label for="blood_type">Blood Type:</label>
            <select id="blood_type" name="blood_type" required>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
            </select>

            <button type="submit">Verify</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2024 Blood Donation. All rights reserved.</p>
    </footer>
</body>
</html>
