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

// Fetch requests with status 'processing' ordered by requestID (ascending)
$sql = "SELECT R.requestID, R.requestAmount, R.reason, R.status, R.userID
        FROM Request R
        WHERE R.status = 'processing'
        ORDER BY R.requestID ASC";  // Ascending order of requestID

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Requests</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #0099cc;
            color: white;
        }
        .check-btn {
            width: 20px;
            height: 20px;
            cursor: pointer;
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

<div class="header">Admin - View Requests</div>

<div class="container">
    <h2>Pending Requests (Processing)</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>User ID</th>
                <th>Amount</th>
                <th>Reason</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>{$row['requestID']}</td>
                        <td>{$row['userID']}</td>
                        <td>{$row['requestAmount']}</td>
                        <td>{$row['reason']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <input type='checkbox' class='check-btn' data-id='{$row['requestID']}' data-action='approve'> ✔ 
                            <input type='checkbox' class='check-btn' data-id='{$row['requestID']}' data-action='reject'> ✘
                        </td>
                    </tr>
                    ";
                }
            } else {
                echo "<tr><td colspan='6'>No requests in processing.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="adminDashboard.php" class="back-btn">Back to Dashboard</a>
</div>

<script>
    document.querySelectorAll('.check-btn').forEach(button => {
        button.addEventListener('change', function () {
            const requestId = this.getAttribute('data-id');
            const action = this.getAttribute('data-action');

            // Send request to backend to update the status
            fetch('process_request_update.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `requestID=${requestId}&action=${action}`
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Show success message
                location.reload(); // Reload the page to update the table
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>

</body>
</html>
