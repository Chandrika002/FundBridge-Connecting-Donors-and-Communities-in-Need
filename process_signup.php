<?php
require 'dbConnect.php'; // Ensure this file contains a valid database connection

// Retrieve form data
$userName = $_POST['userName'];
$password = $_POST['password'];
$email = $_POST['email'];
$userAccountNumber = $_POST['userAccountNumber'];
$userType = $_POST['userType']; // Retrieve userType 

// Hash the password for security
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

try {
    $conn = new PDO("mysql:host=localhost;dbname=FB", "root", ""); // Update with your database credentials
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insert data into the Users table
    $query = $conn->prepare("
        INSERT INTO Users (userName, password, email, userAccountNumber, userType) 
        VALUES (:userName, :password, :email, :userAccountNumber, :userType)
    ");

    // Bind parameters to the query
    $query->bindParam(':userName', $userName);
    $query->bindParam(':password', $hashedPassword);
    $query->bindParam(':email', $email);
    $query->bindParam(':userAccountNumber', $userAccountNumber);
    $query->bindParam(':userType', $userType); // Bind userType

    // Execute the query
    if ($query->execute()) {
        echo "Account successfully created! Redirecting to Sign In page...";
        header("refresh:3;url=signin.php");
        exit();
    } else {
        echo "Failed to create account. Please try again.";
        header("refresh:3;url=signup.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
