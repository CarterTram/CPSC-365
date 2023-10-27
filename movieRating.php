<html>
<head><title>Ratings</title><link href=".\stylesheet.css" rel="stylesheet"></head>
<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();
$rating =$_POST['rating'];
$ratingNum = (int)$rating;
$movieID = $_POST['movieID'];
$userID = $_SESSION['user_id'];
echo $ratingNum;
$sql = 'INSERT INTO ratings(ratingValue,movies_id,user_id) VALUES (:rating,:mID,:userID)';
$stmt=$pdo->prepare($sql);
$stmt->bindParam(':rating',$ratingNum);
$stmt->bindParam(':mID',$movieID);
$stmt->bindParam(':userID',$userID);
$stmt->execute();
header("Location:index.php");
?>
    




</html>
