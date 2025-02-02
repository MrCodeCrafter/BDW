<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>

<?php
session_start();
$is_logged_in = isset($_SESSION['donor_id']) || isset($_SESSION['staff_id']);
?>

<header>
        <div class="navbar">
            <div class="container nav-container">
                <input class="checkbox" type="checkbox" name="" id="" />
                <div class="hamburger-lines">
                    <span class="line line1"></span>
                    <span class="line line2"></span>
                    <span class="line line3"></span>
                </div>
                <div class="nav-right">
                    <img src="../public/images/logo.png" Logo" class="logo">
                    <!-- Your logo here -->
                </div>
                <div class="menu-items">
                    <li><a href="../public/index.html" class="active">Home</a></li>
                    
                <?php if ($is_logged_in): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="../public/login.html">Login</a></li>
                <?php endif; ?>
                    <li><a href="../public/register.html" class="btn">Register as Donor</a></li>
                    <!-- Search Bar in Nav Bar -->
                    <div>
                    
                        <form action="search.php" method="GET">
    <label for="blood_type">Select Blood Type:</label>
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
    <button type="submit">Search</button>
</form>

                    </div>
                </div>

            </div>
        </div>
    </header>

    <section class="hero">
        <div class="hero-text">
            <h1>Donate Blood, Save Lives</h1>
            <p>Join our community of life-saving blood donors and help those in need. Become a donor today!</p>
            <a href="../public/register.html" class="btn">Register as Donor</a>
            <a href="../public/staff.html" class="btn">Register as Staff</a>
        </div>
    </section>

    <section class="importance">
        <div class="container">
            <h2>Why Blood Donation Matters</h2>
            <div class="content-boxes">
                <div class="box">
                    <h3>Help Save Lives</h3>
                    <p>Each blood donation can save up to three lives. Your donation could help accident victims, cancer
                        patients, and more.</p>
                </div>
                <div class="box">
                    <h3>Boost Your Health</h3>
                    <p>Donating blood can improve your health by balancing your iron levels and reducing the risk of
                        heart disease.</p>
                </div>
                <div class="box">
                    <h3>Make an Impact</h3>
                    <p>Your contribution helps hospitals maintain a healthy blood supply, ensuring they are prepared for
                        emergencies.</p>
                </div>
            </div>
        </div>
    </section>

    <div class="background-wrapper">
        <section class="upcoming-drives">
            <div class="container">
                <h2>Upcoming Blood Donation Drives</h2>
                <ul>
                    <li>Date: November 10, 2024 | Location: Community Center</li>
                    <li>Date: December 5, 2024 | Location: City Hospital</li>
                    <li>Date: January 15, 2025 | Location: University Campus</li>
                </ul>
            </div>
        </section>

        <section class="feedback">
            <div class="container">
                <h2>Feedback</h2>
                <form id="feedback-form">
                    <input type="text" id="name" placeholder="Your Name" required>
                    <input type="email" id="email" placeholder="Your Email" required>
                    <textarea id="message" placeholder="Your Feedback" required></textarea>
                    <button type="submit">Submit Feedback</button>
                </form>
            </div>
        </section>
    </div>


    <footer>
        <div class="container">
            <p>&copy; 2024 Blood Donation. All Rights Reserved.</p>
        </div>
    </footer>

</body>

</html>
