<?php
require 'dbConnect.php'; // Ensure this file has the correct database connection logic

// Start session to persist data
session_start();

// Fetch form data and validate input
$role = $_POST['role'] ?? null;
$email = $_POST['email'] ?? null;
$password = $_POST['password'] ?? null;
$_SESSION['email'] = $email;
if (empty($email) || empty($password) || empty($role)) {
    die("Please fill all fields!");
}

try {
    // Check if the connection is successful
    if (!$conn) {
        die("Failed to connect to the database.");
    }

    // Determine the table based on the role
    $table = 'Users';

    // Prepare the SQL query to check if the email exists in the appropriate table
    $stmt = $conn->prepare("SELECT * FROM $table WHERE email = :email LIMIT 1");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Fetch the result
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Role-specific logic for redirection or error messages
    if ($user) {
        // Check if the password matches the stored hash
        if (password_verify($password, $user['password'])) {
            // Correct password, set session variables and redirect
            $_SESSION['email'] = $user['email']; // Store email in session
            $_SESSION['role'] = $role; // Store role in session

            // Redirect based on role
            if ($role === 'admin') {
                header("Location: adminDashboard.php");
            } else {
                header("Location: userDashboard.php");
            }
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password. Please try again.";
        }
    } else {
        // No user found with that email
        echo "No account found with the provided email. Please check your email or sign up.";
    }

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
