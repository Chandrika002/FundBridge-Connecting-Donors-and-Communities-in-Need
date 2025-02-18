<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: signin.php");
    exit();
}

require 'dbConnect.php'; // Database connection

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all valid requests
$sql = "SELECT R.requestID, R.reason, R.requestAmount, R.userID, C.storedFund 
        FROM Request R 
        JOIN CentralStorage C ON R.csID = C.csID 
        WHERE R.status = 'valid' 
        ORDER BY R.requestID ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliver Fund</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            padding: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        .deliver-btn {
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .green-btn {
            background-color: #28a745;
            color: white;
        }
        .gray-btn {
            background-color: #ccc;
            color: white;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <h2>Deliver Fund</h2>
    <table>
        <tr>
            <th>Request ID</th>
            <th>Reason</th>
            <th>Requested Amount</th>
            <th>User ID</th>
            <th>Stored Fund</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['requestID']; ?></td>
                <td><?php echo $row['reason']; ?></td>
                <td><?php echo $row['requestAmount']; ?></td>
                <td><?php echo $row['userID']; ?></td>
                <td><?php echo $row['storedFund']; ?></td>
                <td>
                    <form method="POST" action="process_deliver_fund.php">
                        <input type="hidden" name="requestID" value="<?php echo $row['requestID']; ?>">
                        <input type="hidden" name="requestAmount" value="<?php echo $row['requestAmount']; ?>">
                        <button type="submit" 
                            class="deliver-btn <?php echo ($row['storedFund'] >= $row['requestAmount']) ? 'green-btn' : 'gray-btn'; ?>" 
                            <?php echo ($row['storedFund'] < $row['requestAmount']) ? 'disabled' : ''; ?>>
                            Deliver Fund
                        </button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
