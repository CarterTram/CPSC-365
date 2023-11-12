<?php
session_start();
require 'dbconnect.php';
dbConnect();

if (isset($_POST['friend1'])) {
    $sender = $_POST['friend1'];

    // Update the friend request status to rejected
    $stmtRejectRequest = $pdo->prepare('UPDATE Friend_Requests 
                                       SET Reject_Status = TRUE, 
                                           Pending_Status = FALSE 
                                       WHERE user_id = :id1 AND user2_id = :id2');
    $stmtRejectRequest->bindParam(':id1', $sender);
    $stmtRejectRequest->bindParam(':id2', $_POST['friend2']);
    $stmtRejectRequest->execute();

    $response = array("message" => "Friend request rejected successfully.");
    echo json_encode($response);
} else {
    $response = array("message" => "Something went wrong.");
    echo json_encode($response);
}
?>