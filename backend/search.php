<!-- search.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Blood Donors or Hospitals</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="../public/images/logo.png" alt="Blood Donation Logo">
        </div>
        <nav>
            <ul>
                <li><a href="../public/index.html">Home</a></li>
<<<<<<< HEAD
                <li><a href="../public/login.html">Login</a></li>
=======
                <li><a href="../public/inventory.html">Blood Inventory</a></li>
                <li><a href="../public/donor_dashboard.html">Donor</a></li>
                <li><a href="../public/hospital_dashboard.html">Hospital</a></li>
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7
                <li><a href="../public/register.html" class="btn">Register</a></li>
            </ul>
        </nav>
    </header>

    <section class="form-section">
        <h1>Search for Blood Donors or Hospitals</h1>

        <!-- Form to search for either donors or hospitals -->
        <form action="search_blood.php" method="GET">
            <label for="search_type">Search Type</label>
            <select id="search_type" name="search_type" required>
                <option value="donor">Donor</option>
                <option value="hospital">Hospital</option>
            </select>

            <label for="blood_type">Blood Type</label>
<<<<<<< HEAD
<select id="blood_type" name="blood_type" required>
    <option value="" disabled <?php echo empty($_GET['blood_type']) ? 'selected' : ''; ?>>Select Blood Type</option>
    <option value="A+" <?php echo ($_GET['blood_type'] == 'A+') ? 'selected' : ''; ?>>A+</option>
    <option value="A-" <?php echo ($_GET['blood_type'] == 'A-') ? 'selected' : ''; ?>>A-</option>
    <option value="B+" <?php echo ($_GET['blood_type'] == 'B+') ? 'selected' : ''; ?>>B+</option>
    <option value="B-" <?php echo ($_GET['blood_type'] == 'B-') ? 'selected' : ''; ?>>B-</option>
    <option value="O+" <?php echo ($_GET['blood_type'] == 'O+') ? 'selected' : ''; ?>>O+</option>
    <option value="O-" <?php echo ($_GET['blood_type'] == 'O-') ? 'selected' : ''; ?>>O-</option>
    <option value="AB+" <?php echo ($_GET['blood_type'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
    <option value="AB-" <?php echo ($_GET['blood_type'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
</select>

=======
            <input type="text" id="blood_type" name="blood_type" value="<?php echo $_GET['blood_type']; ?>" required>
>>>>>>> 60618cd3bb892c608b7a5139251492f7fc01f2f7

            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Enter location" required>
            
            <button type="submit">Search</button>
        </form>
    </section>

</body>
</html>

