<!-- search.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Blood Donors</title>
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
                <li><a href="../public/inventory.html">Blood Inventory</a></li>
                <li><a href="../public/donor_dashboard.html">Donor</a></li>
                <li><a href="../public/hospital_dashboard.html">Hospital</a></li>
                <li><a href="../public/register.html" class="btn">Register</a></li>
            </ul>
        </nav>
    </header>

    <section class="form-section">
        <h1>Search for Blood Donors</h1>

        <!-- Make sure to properly capture the blood type from the URL -->
        <form action="search_blood.php" method="GET">
            <input type="hidden" id="blood_type" name="blood_type" value="<?php echo $_GET['blood_type']; ?>" />
            <label for="location">Location</label>
            <input type="text" id="location" name="location" placeholder="Enter location" required>
            <button type="submit">Search</button>
        </form>
    </section>

</body>
</html>

