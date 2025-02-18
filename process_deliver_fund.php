<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: signin.php");
    exit();
}

require 'dbConnect.php';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$requestID = $_POST['requestID'];
$requestAmount = $_POST['requestAmount'];
$requiredAmount = $requestAmount;

$conn->begin_transaction();

try {
    // Get Central Storage details
    $sql = "SELECT storedFund, csID FROM CentralStorage WHERE csID = (SELECT csID FROM Request WHERE requestID = ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $requestID);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $storedFund = $row['storedFund'];
    $csID = $row['csID'];
    if ($storedFund < $requiredAmount) {
        throw new Exception("Insufficient funds.");
    }

    // Deduct stored fund
    $newStoredFund = $storedFund - $requiredAmount;
    $sql_update_cs = "UPDATE CentralStorage SET storedFund = ? WHERE csID = ?";
    $stmt_update_cs = $conn->prepare($sql_update_cs);
    $stmt_update_cs->bind_param("di", $newStoredFund, $csID);
    $stmt_update_cs->execute();
    
    // Fetch donations where remainAmount > 0
    $sql_donates = "SELECT donateID, remainAmount FROM Donate WHERE remainAmount > 0 ORDER BY donateID ASC";
    $stmt_donates = $conn->prepare($sql_donates);
    $stmt_donates->execute();
    $donates_result = $stmt_donates->get_result();
    
    // Process donations
    while ($row_donate = $donates_result->fetch_assoc()) {
        $donateID = $row_donate['donateID'];
        $remainAmount = $row_donate['remainAmount'];

        if ($requiredAmount <= 0) break;

        if ($remainAmount <= $requiredAmount) {
            
            $deliverAmount = $remainAmount;
            $newRemainAmount = 0; // Set remainAmount to 0
            //$delivered = 'yes';
        } else {
            $deliverAmount = $requiredAmount;
            $newRemainAmount = $remainAmount - $requiredAmount; // Reduce remainAmount
            //$delivered = 'slightly';
        }
        
        $requiredAmount -= $deliverAmount;
        $percentage = ($deliverAmount / $requestAmount) * 100;
       
        // Insert into Deliver table
        $sql_insert_deliver = "INSERT INTO Deliver (donateID, deliverAmount, requestID, csID, percentage) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert_deliver = $conn->prepare($sql_insert_deliver);
        $stmt_insert_deliver->bind_param("iiiii", $donateID, $deliverAmount, $requestID, $csID, $percentage);
        $stmt_insert_deliver->execute();
        
        // Update Donate table (remainAmount & delivered status)
        $sql_update_donate = "UPDATE Donate SET remainAmount = ? WHERE donateID = ?";
        $stmt_update_donate = $conn->prepare($sql_update_donate);
        
        $stmt_update_donate->bind_param("ii", $newRemainAmount, $donateID);
        $stmt_update_donate->execute();
        
    }

    // Update Request status
    if ($requiredAmount <= 0) {
        echo "6t\n";
        $sql_update_request = "UPDATE Request SET status = 'sent' WHERE requestID = ?";
        $stmt_update_request = $conn->prepare($sql_update_request);
        $stmt_update_request->bind_param("i", $requestID);
        $stmt_update_request->execute();
    }
    echo "7t\n";
    $conn->commit();
    header("Location: deliver_fund.php");
} catch (Exception $e) {
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
