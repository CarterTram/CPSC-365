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
        $stmt = $pdo->prepare('DELETE FROM Friend_Requests WHERE user_id = :id1 AND user2_id = :id2');
        $stmt->bindParam(':id1',$sender);
        $stmt->bindParam(':id2',$_POST['friend2']);
        $stmt->execute();

        $response= array("message"=> "Friend accepted successfully.");
        echo json_encode($response);



    }
    else {
        $response= array("message"=> "something went wrong.");
        echo json_encode($response);
    }
?>