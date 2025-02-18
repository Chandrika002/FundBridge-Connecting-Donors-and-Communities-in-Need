<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: signin.php"); // Redirect if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Fund - FundBridge</title>
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
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #006666;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #0099cc;
            border-radius: 5px;
        }
        button {
            background: #0099cc;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background: #0077aa;
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
    <h2>Request Fund</h2>
    <form action="process_request.php" method="POST">
        <input type="number" name="amount" placeholder="Enter Amount" required>
        <textarea name="reason" placeholder="Enter Reason for Request" required></textarea>
        <button type="submit">Submit Request</button>
    </form>
    <a href="userDashboard.php" class="back-btn">Back to Dashboard</a>
</div>

</body>
</html>
