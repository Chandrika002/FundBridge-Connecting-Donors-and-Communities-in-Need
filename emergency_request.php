<?php
include 'dbConnect.php';

// Fetch top 5 donors based on donation percentage
$query = "SELECT d.userID, SUM(d.donateAmount) AS totalDonation
                 -- (SUM(d.donateAmount) / (TIMESTAMPDIFF(DAY, u.createdFrom, NOW()))) AS donationPercentage
          FROM Donate d 
          JOIN Users u ON d.userID = u.userID
          GROUP BY d.userID 
          ORDER BY totalDonation DESC 
          LIMIT 5";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emergency Request</title>
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
        .message-box {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: none;
        }
        .send-btn {
            background: #2ecc71;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .send-btn:hover {
            background: #27ae60;
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
    <h2>Emergency Request - Top Donors</h2>
    <table>
        <tr>
            <th>Serial</th>
            <th>User ID</th>
            <th>Total Donation</th>
            <!-- <th>Donation Percentage</th> -->
            <th>Message</th>
            <th>Send</th>
        </tr>
        <?php
        $serial = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$serial}</td>
                    <td>{$row['userID']}</td>
                    <td>{$row['totalDonation']}</td>
                    
                    <td>
                        <textarea class='message-box' id='message_{$row['userID']}' placeholder='Enter message...'></textarea>
                    </td>
                    <td>
                        <button class='send-btn' onclick='sendMessage({$row['userID']})'>Send</button>
                    </td>
                  </tr>";
            $serial++;
        }
        ?>
    </table>

    <a href="adminDashboard.php" class="back-btn">Back to Dashboard</a>
</div>

<script>
function sendMessage(userID) {
    var message = document.getElementById("message_" + userID).value.trim();

    if (message === "") {
        alert("Please enter a message before sending.");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "process_emergency_request.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
        }
    };
    xhr.send("userID=" + userID + "&message=" + encodeURIComponent(message));
}
</script>

</body>
</html>
