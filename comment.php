<html>
<head><title>Comments</title><link href=".\stylesheet.css" rel="stylesheet"></head>
<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();
$comment =$_POST['comment'];
$movieID = $_POST['movieID'];
$userID = $_SESSION['user_id'];
$sql = 'INSERT INTO comments(commentContent,movies_id,user_id) VALUES (:comment,:mID,:userID)';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':comment',$comment);
$stmt->bindParam(':mID',$movieID);
$stmt->bindParam(':userID',$userID);
$stmt->execute();

$commentID = $pdo->lastInsertId();   
$dateAdded = "UPDATE comments SET dateAdded= NOW() WHERE comments_id =:comments_id";
$stmt1 = $pdo->prepare($dateAdded);
$stmt1 -> bindParam(':comments_id',$commentID);
$stmt1->execute();
echo 'date added';
header("Location:index.php");
?>
    




</html>
