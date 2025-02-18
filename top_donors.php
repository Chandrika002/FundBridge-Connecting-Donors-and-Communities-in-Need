<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: signin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Donors - FundBridge</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #0099cc, #33cc99);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }
        h2 {
            color: #006666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #0099cc;
            color: white;
        }
        .back-btn {
            background: #777;
            text-decoration: none;
            padding: 10px 15px;
            display: inline-block;
            margin-top: 10px;
            border-radius: 5px;
            color: white;
        }
        .back-btn:hover {
            background: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Top Donors</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Donor Name</th>
                <th>Donated Amount</th>
            </tr>
        </thead>
        <tbody id="donorsList">
            <!-- Data will be loaded here using fetch_top_donors.php -->
        </tbody>
    </table>
    <a href="userDashboard.php" class="back-btn">Back to Dashboard</a>
</div>

<script>
    // Fetch and display top donors
    fetch('fetch_top_donors.php')
    .then(response => response.json())
    .then(data => {
        let tbody = document.getElementById('donorsList');
        tbody.innerHTML = ""; // Clear previous data
        data.forEach((donor, index) => {
            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${donor.userName}</td>
                    <td>${donor.totalDonated}</td>
                </tr>
            `;
        });
    })
    .catch(error => console.error('Error fetching donors:', error));
</script>

</body>
</html>
