<?php
session_start();

$userID = isset($_SESSION['userID']) ? $_SESSION['userID'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donate Now</title>
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

        /* Donation container */
        .donation-container {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h1 {
            color: #00695c;
        }

        .donation-form {
            margin-top: 20px;
            padding: 20px;
            background-color: #e2f7f1;
            border-radius: 8px;
        }

        .donation-form label {
            font-size: 1.2rem;
            color: #00695c;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        .donation-form input {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 5px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 15px;
        }

        .donation-form button {
            background-color: #00695c;
            color: white;
            padding: 10px 15px;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin: 0 10px;
        }

        .donation-form button:hover {
            background-color: #004d40;
        }

        .back-button {
            background-color: #ff9800;
        }

        .back-button:hover {
            background-color: #e68900;
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
            <a href="logout.php" style="color: #ffeb3b;">Log Out</a>
        </div>
    </div>

    <!-- Donation Form -->
    <div class="donation-container">
        <h1>Make a Donation</h1>
        <p>Every contribution makes a difference!</p>

        <div class="donation-form">
            <form action="process_donate.php" method="POST">
                <!-- Donation Amount Input Field -->
                <label for="donateAmount">Enter Donation Amount:</label>
                <input type="number" name="donateAmount" id="donateAmount" min="1" required>

                <input type="hidden" name="userID" value="<?php echo $userID; ?>">

                <div class="button-container">
                    <button type="submit">Send</button>
                    <button type="button" class="back-button" onclick="window.location.href='userDashboard.php';">Back</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

