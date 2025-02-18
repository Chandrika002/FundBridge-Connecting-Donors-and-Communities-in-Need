<?php
require 'dbConnect.php';
session_start();
 // Ensure this file connects to the database

$email = isset($_SESSION['email']) ? $_SESSION['email'] : ''; // Retrieve email from session
//echo $email;
//var_dump($_SESSION);
$donateAmount = isset($_POST['donateAmount']) ? intval($_POST['donateAmount']) : 0;


//die(); // Stop execution to inspect the output
//$donateAmount = intval($_POST['donateAmount']);  
$donateAmount = isset($_POST['donateAmount']) ? intval(trim($_POST['donateAmount'])) : 0;
if ($donateAmount <= 0) {  
    die("Donate amount is not greater than 0");  
} else {  
    echo "Valid donate amount\n";  
}
//$donateAmount = intval(trim($_POST['donateAmount']));
  $table = 'Users';

if ($donateAmount > 0) {
    echo $_SESSION['email'];
    // Retrieve userID using email
    $stmt = $conn->prepare("SELECT * FROM $table WHERE email = :email LIMIT 1");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $row = $result;
        $userID = $row['userID'];
        $stmt = $conn->prepare("SELECT csID FROM CentralStorage LIMIT 1");

    $stmt->execute();
    $csRow = $stmt->fetch(PDO::FETCH_ASSOC);
    $csID = $csRow['csID'];
    $query = $conn->prepare("INSERT INTO Donate (donateAmount, userID, csID) VALUES (:donateAmount, :userID, :csID)");

    $query->bindParam(':donateAmount', $donateAmount);
    $query->bindParam(':userID', $userID);
    $query->bindParam(':csID', $csID);
   
    $stmt = $conn->prepare("SELECT csID, storedFund FROM CentralStorage LIMIT 1");
    $stmt->execute();
    $csRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($query->execute()) {
            //cs
            $storedFund = $csRow['storedFund'];
            $newStoredFund = $storedFund + $donateAmount;
            $updateQuery = $conn->prepare("UPDATE CentralStorage SET storedFund = :newStoredFund WHERE csID = :csID");
            $updateQuery->bindParam(':newStoredFund', $newStoredFund, PDO::PARAM_INT);
            $updateQuery->bindParam(':csID', $csID, PDO::PARAM_INT);

            if ($updateQuery->execute()) {
                echo "<script>alert('Donation successful!'); window.location.href='userDashboard.php';</script>";
            } else {
                $errorInfo = $updateQuery->errorInfo();
                die("Error updating CentralStorage: " . $errorInfo[2]);
            }
                
        } else {
                echo "<script>alert('Error processing donation. Try again.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Invalid donation amount.'); window.history.back();</script>";
}

    
    // Commit the transaction
    // $conn->commit();

    // echo "<script>alert('Donation successful!'); window.location.href='userDashboard.php';</script>";

?>


