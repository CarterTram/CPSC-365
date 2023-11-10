    <?php
    session_start();
    REQUIRE 'dbconnect.php';
    dbConnect ();

        if (isset($_POST['receiver'])) {
             $receiver =  $_POST['receiver'];
             $stmt=$pdo->prepare("INSERT INTO Friend_Requests(user_id,user2_id,Pending_Status,Accept_Status,Reject_Status,DateAdded) 
             VALUES(:user1,:user2,:pending,:accept,:reject,NOW())");
             $p = 1;
             $a = 0;
             $r = 0;
             $stmt->bindParam(':user1',$_SESSION['user_id']);
             $stmt->bindParam(':user2',$receiver);
             $stmt->bindParam(':pending',$p);
             $stmt->bindParam(':accept',$a);
             $stmt->bindParam(':reject',$r);
             $stmt->execute();
        $response= array("message"=> "Friend request sent successfully.");
            echo json_encode($response);
        } else {
            $response = array("message"=> "An error has occured.");
            echo json_encode($response);    
        }
    ?>
