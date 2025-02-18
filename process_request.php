<?php
session_start();
require 'dbConnect.php'; // Database connection

if (!isset($_SESSION['email'])) {
    header("Location: userDashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $requestAmount = $_POST['amount'];
    $reason = $_POST['reason'];
    $csID = 1; // Default Central Storage ID

    // Validate input
    if (empty($requestAmount) || empty($reason)) {
        header("Location: request.php?error=Please fill all fields");
        exit();
    }

    $conn = new mysqli($host, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get userID from Users table
    $sql = "SELECT userID FROM Users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $userID = $row['userID'];

        // Insert request into Request table
        $sql = "INSERT INTO Request (userID, requestAmount, reason, status, csID) 
                VALUES (?, ?, ?, 'processing', ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisi", $userID, $requestAmount, $reason, $csID);

        if ($stmt->execute()) {
            echo "<script>alert('Request submitted successfully'); window.location.href='userDashboard.php';</script>";
            //header("Location: userDashboard.php?success=Request submitted successfully");
        } else {
            header("Location: request.php?error=Failed to submit request");
        }
    } else {
        header("Location: request.php?error=User not found");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: request.php");
    exit();
}
?>
