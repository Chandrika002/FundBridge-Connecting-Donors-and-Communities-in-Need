<?php
require 'dbConnect.php'; // Include database connection

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch top 10 donors
$sql = "SELECT U.userName, SUM(D.donateAmount) AS totalDonated 
        FROM Donate D
        JOIN Users U ON D.userID = U.userID
        GROUP BY D.userID
        ORDER BY totalDonated DESC
        LIMIT 10";

$result = $conn->query($sql);
$donors = [];

while ($row = $result->fetch_assoc()) {
    $donors[] = $row;
}

echo json_encode($donors);
$conn->close();
?>
