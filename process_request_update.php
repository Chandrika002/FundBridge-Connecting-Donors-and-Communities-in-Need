<?php
require 'dbConnect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['requestID']) && isset($_POST['action'])) {
        $requestID = $_POST['requestID'];
        $action = $_POST['action'];

        // Validate action and map it to status
        if ($action == 'approve') {
            $status = 'valid';
        } elseif ($action == 'reject') {
            $status = 'rejected';
        } else {
            echo "Invalid action.";
            exit();
        }

        $conn = new mysqli($host, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update the request status in the Request table
        $sql = "UPDATE Request SET status = ? WHERE requestID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $requestID);

        if ($stmt->execute()) {
            echo "Request status updated successfully.";
        } else {
            echo "Error updating request: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "Invalid request.";
    }
}
?>
