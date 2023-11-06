<html>
<head><title></title></head>
<body>
<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();
$stmt= $pdo->prepare('SELECT FROM movies WHERE movieName=:movieName');
$stmt->bindParam(':movieName',$_POST['movieName']);
$stmt->excute();
$fetchMovieID = $stmt->fetch(PDO::FETCH_ASSOC);



$sql = 'DELETE FROM comments WHERE movies_id = :movieID AND user_id = :userID';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':movieID',$fetchMovieID['movies_id']);
$stmt->bindParam(':movieName',$_POST['movieName']);
$stmt->execute();

echo 'Movie Successfully Deleted';
echo '<meta http-equiv="refresh" content ="5;URL=\'http://localhost/CPSC-365/index.php\'">';




?>
</body>
</html>