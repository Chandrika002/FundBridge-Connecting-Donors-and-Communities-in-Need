<?php
include 'dbConnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userID"]) && isset($_POST["message"])) {
    $recipientID = intval($_POST["userID"]);
    $message = trim($_POST["message"]);

    if ($message === "") {
        die("Error: Message cannot be empty.");
    }

    // Assuming admin (sender) has userID = 1 (or fetch dynamically)
    $senderID = 1;

    $stmt = $conn->prepare("INSERT INTO Messages (recipientID, senderID, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $recipientID, $senderID, $message);
    
    if ($stmt->execute()) {
        echo "Emergency request sent successfully.";
    } else {
        echo "Error sending request.";
    }
    
    $stmt->close();
}
?>
