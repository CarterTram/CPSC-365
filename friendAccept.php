<?php
    session_start();
    REQUIRE 'dbconnect.php';
    dbConnect ();
    if (isset($_POST['friend1'])){
        $sender = $_POST['friend1'];
        //accept the friend request
        $stmt = $pdo->prepare('INSERT INTO friends(user_id,user2_id,DateAdded) 
        VALUES (:user,:user2,NOW())');
        $stmt->bindParam(':user',$sender);
        $stmt->bindParam(':user2',$_POST['friend2']);
        $stmt->execute();


        //delete the friend request
        $stmtUpdateRequest = $pdo->prepare('UPDATE Friend_Requests 
        SET Pending_Status = FALSE, 
            Accept_Status = TRUE 
        WHERE user_id = :id1 AND user2_id = :id2');
        $stmtUpdateRequest->bindParam(':id1', $sender);
        $stmtUpdateRequest->bindParam(':id2', $_POST['friend2']);
        $stmtUpdateRequest->execute();

        $response= array("message"=> "Friend accepted successfully.");
        echo json_encode($response);



    }
    else {
        $response= array("message"=> "something went wrong.");
        echo json_encode($response);
    }
?>