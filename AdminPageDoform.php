<html>
<head><title>Registration Form</title></head>
<body>
<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();
//must check for if the movie is already there before adding
$stmt = $pdo->prepare("SELECT * FROM movies WHERE movieName=:inputmovieName AND yearReleased = :inputyearReleased");
$stmt-> bindParam(':inputmovieName',$_POST['inputmovieName']);
$stmt-> bindParam(':inputyearReleased', $_POST['inputyearReleased']);
$stmt-> execute();
$movieCheck = $stmt->fetch();
if ($movieCheck){
	echo 'Movie already exists';
	//header ("Location: AdminPage.php");
	exit();
}
else {
	$inputMovie = 'INSERT INTO movies (movieName, yearReleased,director,producer, description) 
	VALUES(:inputmovieName,:inputyearReleased,:inputdirector,:inputproducer,:Description)';
	$stmt = $pdo->prepare($inputMovie);
	$stmt->bindParam(':inputmovieName',$_POST['inputmovieName']);
	$stmt->bindParam(':inputyearReleased',$_POST['inputyearReleased']);
	$stmt->bindParam(':inputdirector',$_POST['inputdirector']);
	$stmt->bindParam(':inputproducer',$_POST['inputproducer']);
	$stmt->bindParam(':Description',$_POST['Description']);
	$stmt->execute();
	echo 'Movie added successfully';
}



?>
</body>
</html>