<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();

$movieId= $_GET[$movieId];
$sql = "SELECT * FROM movies WHERE movies_id =:movieId";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':movieId',$movieId);
$stmt->execute();
$movie = $stmt ->fetch(PDO::FETCH_ASSOC);

?>

<h2><?php echo $movie['movieName']; ?></h2>
<p><?php echo $movie['description']; ?></p>