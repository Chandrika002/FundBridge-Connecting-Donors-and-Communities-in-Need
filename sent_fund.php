<?php
include 'dbConnect.php';

// Fetch sent fund requests
$query = "SELECT userID, requestAmount, reason FROM Request WHERE status = 'sent'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent Fund Requests</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        .back-btn {
            display: block;
            margin-top: 20px;
            background: #e74c3c;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            width: 150px;
            margin-left: auto;
            margin-right: auto;
        }
        .back-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Sent Fund Requests</h2>
    <table>
        <tr>
            <th>Serial</th>
            <th>User ID</th>
            <th>Request Amount</th>
            <th>Reason</th>
        </tr>
        <?php
        $serial = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$serial}</td>
                    <td>{$row['userID']}</td>
                    <td>{$row['requestAmount']}</td>
                    <td>{$row['reason']}</td>
                  </tr>";
            $serial++;
        }
        ?>
    </table>

    <a href="adminDashboard.php" class="back-btn">Back to Dashboard</a>
</div>

</body>
</html>
