<?php
include 'dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['requestID'])) {
    $requestID = $_POST['requestID'];

    // Update the status to 'delivered' after funds are processed
    $query = "UPDATE Request SET status = 'delivered' WHERE requestID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $requestID);

    if ($stmt->execute()) {
        echo "Request marked as delivered.";
    } else {
        echo "Error updating status: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>
