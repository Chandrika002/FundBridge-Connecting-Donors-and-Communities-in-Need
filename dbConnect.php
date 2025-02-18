<?php
// Database connection parameters
$host = "localhost"; 
$dbname = "FB"; 
$username = "root"; 
$password = ""; 

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}
?>

