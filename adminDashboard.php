<?php
session_start();
$_SESSION['admin'] = 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FundBridge</title>
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
        .nav-bar {
            display: flex;
            justify-content: space-around;
            background: #006666;
            padding: 10px;
        }
        .nav-bar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: 0.3s;
        }
        .nav-bar a:hover {
            background: #004d4d;
        }
        .container {
            padding: 20px;
            text-align: center;
        }
        .section {
            display: none; /* Initially hide all sections */
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }
        .active {
            display: block; /* Show the active section */
        }
    </style>
</head>
<body>

<div class="header">Admin Dashboard - FundBridge</div>

<div class="nav-bar">
    <a href="admin_requests.php" onclick="showSection('requests')">Requests</a>
    <a href="deliver_fund.php" onclick="showSection('deliver_fund')">Deliver Fund</a>
    <a href="emergency_request.php" onclick="showSection('emergency_request')">Make Emergency Request</a>
    <!-- <a href="reserved_fund.php" onclick="showSection('reserved_fund')">Reserved Fund</a> -->
    <a href="sent_fund.php" onclick="showSection('sent_fund')">Sent Fund Table</a>
    <a href="top_donors.php" onclick="showSection('donors_table')">Donors Table</a>
    <a href="messages.php" onclick="showSection('messages')">Message to Deliver</a>
</div>

<div class="container">
    <div id="requests" class="section active">
        <h2>Requests</h2>
        <p>View and manage fund requests.</p>
        <!-- Add backend logic here -->
    </div>

    <div id="deliver_fund" class="section">
        <h2>Deliver Fund</h2>
        <p>Allocate and deliver funds.</p>
        <!-- Add backend logic here -->
    </div>

    <div id="emergency_request" class="section">
        <h2>Make Emergency Request</h2>
        <p>Request emergency funds.</p>
        <!-- Add backend logic here -->
    </div>

    <div id="reserved_fund" class="section">
        <h2>Reserved Fund</h2>
        <p>Manage reserved funds.</p>
        <!-- Add backend logic here -->
    </div>

    <div id="sent_fund" class="section">
        <h2>Sent Fund Table</h2>
        <p>View sent fund records.</p>
        <!-- Add backend logic here -->
    </div>

    <div id="donors_table" class="section">
        <h2>Donors Table</h2>
        <p>View donor contributions.</p>
        <!-- Add backend logic here -->
    </div>

    <div id="messages" class="section">
        <h2>Message to Deliver</h2>
        <p>Send important messages.</p>
        <!-- Add backend logic here -->
    </div>
</div>

<script>
    function showSection(sectionId) {
        let sections = document.querySelectorAll('.section');
        sections.forEach(section => section.classList.remove('active'));
        
        document.getElementById(sectionId).classList.add('active');
    }
</script>

</body>
</html>
