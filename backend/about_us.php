<?php
$content = "<h2>About Blood Bank Management System</h2>
<p>The Blood Bank Management System facilitates the seamless coordination between donors, hospitals, and staff.
It ensures an efficient blood donation process, monitors inventory levels, organizes donation drives,
and keeps track of donor records. This platform aims to meet urgent blood requirements by maintaining
a reliable and sustainable blood supply.</p>";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Blood Donation</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <div class="navbar">
            <div class="container nav-container">
                <a href="index.html" class="btn">Home</a>
                <h1>About Us</h1>
            </div>
        </div>
    </header>

    <section class="about-section">
        <div class="container">
            <?php echo $content; ?>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Blood Donation. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>

