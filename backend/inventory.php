

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// Restrict access to staff only
if (!isset($_SESSION['staff_id'])) {
    header("Location: ../public/hospital_login.html"); // Redirect if not logged in as staff
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donation";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get hospital_id based on logged-in staff
$staff_id = $_SESSION['staff_id'];
$hospital_id = null;

$stmt = $conn->prepare("SELECT hospital_id FROM hospitalstaffs WHERE id = ?");
$stmt->bind_param("i", $staff_id);
$stmt->execute();
$stmt->bind_result($hospital_id);
$stmt->fetch();
$stmt->close();

// Handle the addition of new donations to inventory
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_inventory'])) {
    $blood_type = $_POST['blood_type'];
    $quantity = (int)$_POST['quantity'];

    $add_stmt = $conn->prepare("INSERT INTO bloodinventory (blood_type, quantity, hospital_id) VALUES (?, ?, ?)");
    $add_stmt->bind_param("sii", $blood_type, $quantity, $hospital_id);
    if ($add_stmt->execute()) {
        $success_message = "New donation added to inventory successfully.";
    } else {
        $error_message = "Error adding donation to inventory.";
    }
    $add_stmt->close();
}

// Fetch inventory data for display if blood_type is set in GET request
$inventory_data = [];
if (isset($_GET['blood_type'])) {
    $selected_blood_type = $_GET['blood_type'];
    $inventory_stmt = $conn->prepare("SELECT blood_type, quantity, expirydate FROM bloodinventory WHERE hospital_id = ? AND blood_type = ?");
    $inventory_stmt->bind_param("is", $hospital_id, $selected_blood_type);
    $inventory_stmt->execute();
    $result = $inventory_stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $inventory_data[] = $row;
    }
    $inventory_stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank Inventory</title>
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
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
<p>&nbsp;</p>  <!-- Adds an empty paragraph -->
<p>&nbsp;</p>
<p>&nbsp;</p>
    <section class="inventory">
        <div class="container">
            

            <!-- Check Blood Inventory Form -->
            <section style="float: left;" class="verify-section">
                <h2>Check Blood Inventory by Blood Type</h2>
                <form method="GET" action="inventory.php">
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
                    <button type="submit">Check Inventory</button>
                </form>
            </section>
            <!-- Add New Donation Form -->
            <section style="float: right;" class="add-donation-section">
                <h2>Add New Donation to Inventory</h2>
                <form method="POST" action="inventory.php">
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

                    <label for="quantity">Quantity (units):</label>
                    <input type="number" id="quantity" name="quantity" min="1" required>

                    <button type="submit" name="add_inventory">Add Donation</button>
                </form>
            </section><br>
	<h1 style="margin-top: 300px;">Blood Bank Inventory</h1>
            <?php if (isset($selected_blood_type)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Blood Type</th>
                            <th>Units Available</th>
                            <th>Expiry Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($inventory_data)): ?>
                            <?php foreach ($inventory_data as $item): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($item['blood_type']); ?></td>
                                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($item['expirydate']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No data found for the selected blood type.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            


            <!-- Success/Error Message -->
            <?php if (isset($success_message)): ?>
                <p class="success-message"><?php echo $success_message; ?></p>
            <?php elseif (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Blood Donation. All rights reserved.</p>
    </footer>
</body>
</html>

