<?php
// Start session (if needed)
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #e2f7f1;
            margin: 0;
            padding: 0;
        }

        /* Navbar styles */
        .navbar {
            background: linear-gradient(45deg, #00695c, #009688);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            margin: 0 15px;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #e2f7f1;
            text-decoration: underline;
        }

        /* Main content */
        .dashboard-container {
            width: 80%;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h1 {
            color: #00695c;
        }

        .dashboard-content {
            font-size: 1.2rem;
            color: #333;
            margin-top: 10px;
        }

    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <div class="navbar">
        <div>
            <a href="userProfile.php">Your Profile</a>
            <a href="donate.php">Donate Now</a>
            <a href="request.php">Request Now</a>
            <a href="notifications.php">Notification</a>
            <a href="top_donors.php">Top Donors</a>
        </div>
        <div>
            <a href="index.php" style="color: #ffeb3b;">Log Out</a>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="dashboard-container">
        <h1>Welcome to Your Dashboard</h1>
        <p class="dashboard-content">Manage your profile, donations, and requests easily.</p>
    </div>

</body>
</html>

