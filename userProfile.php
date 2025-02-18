<?php
// Include database connection
include('dbConnect.php');

// Start the session
session_start();

// Check if user is logged in
if (!isset($_SESSION['email'])) { // Use email to check login status
    echo "You must be logged in to view this page.";
    exit();
}

$email = $_SESSION['email']; // Get email from session

try {
    // Fetch user details from the database using email with PDO
    $query = "SELECT * FROM `FB`.`Users` WHERE email = :email";
    $stmt = $conn->prepare($query);
    
    // Bind the email parameter using PDO
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    
    // Execute the statement
    $stmt->execute();
    
    // Fetch user details
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Check if user data is available
    if (!$user) {
        echo "No user found with the given email.";
        exit();
    }

    // Extract user details
    $username = htmlspecialchars($user['userName']);
    $usertype = htmlspecialchars($user['userType']);
    $userAccountnumber = htmlspecialchars($user['userAccountNumber']);
    $createdFrom = htmlspecialchars($user['createdFrom']);
} catch (PDOException $e) {
    // Handle potential PDO errors
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Details</title>
    <style>
    	/* General styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
}

/* Container styles */
.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

h1 {
    color: #333;
    text-align: center;
    font-size: 2rem;
}

/* Account details styles */
.account-details {
    margin-top: 20px;
    font-size: 1.2rem;
}

.account-details p {
    background-color: #e2f7f1;
    padding: 10px;
    margin: 5px 0;
    border-radius: 5px;
    color: #333;
}

.account-details p strong {
    color: #00695c;
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Your Account Details</h1>
        <div class="account-details">
            <p><strong>Username:</strong> <?php echo $username; ?></p>
            <p><strong>User Type:</strong> <?php echo $usertype; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>User Account Number:</strong> <?php echo $userAccountnumber; ?></p>
            <p><strong>Created in:</strong> <?php echo $createdFrom; ?></p>
        </div>
    </div>
</body>
</html>
