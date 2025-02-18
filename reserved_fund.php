<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: signin.php");
    exit();
}

require 'dbConnect.php'; // Include database connection

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total stored fund from CentralStorage
$sql = "SELECT SUM(storedFund) AS totalReservedFund FROM CentralStorage";
$result = $conn->query($sql);
$totalFund = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalFund = $row['totalReservedFund'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reserved Fund</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .header {
            background: #0099cc;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 24px;
        }
        .container {
            padding: 20px;
            text-align: center;
        }
        .fund-amount {
            font-size: 30px;
            color: #0099cc;
            margin-top: 20px;
        }
        .back-btn {
            background: #777;
            text-decoration: none;
            padding: 10px 15px;
            display: inline-block;
            margin-top: 20px;
            border-radius: 5px;
            color: white;
        }
        .back-btn:hover {
            background: #555;
        }
    </style>
</head>
<body>

<div class="header">Admin - Reserved Fund</div>

<div class="container">
    <h2>Total Reserved Fund in Central Storage</h2>
    <p class="fund-amount">
        <?php
        echo "Total Reserved Fund: $totalFund";
        ?>
    </p>

    <a href="adminDashboard.php" class="back-btn">Back to Dashboard</a>
</div>

</body>
</html>

<?php
$conn->close();
?>
