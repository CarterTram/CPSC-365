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
//declare to make global
$movieId = 0;
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
	$movieId = $pdo->lastInsertId();
	echo 'Movie added successfully';
}
if (isset($_POST['genre'])){
	
// adding the first genre to the database
$stmt2 = $pdo->prepare("SELECT * FROM genres WHERE genreName=:genres");	
$stmt2 ->bindParam(':genres', $_POST['genre']);
$stmt2 -> execute();
$fetchgenreRow =$stmt2->fetch(PDO::FETCH_ASSOC);

$inputGenreId = $fetchgenreRow['genre_id'];

$sql= 'INSERT INTO genresMovies (movies_id, genre_id)
VALUES(:movieId, :inputGenreId)';
$insertGenre = $pdo->prepare($sql);
$insertGenre->bindParam(':movieId',$movieId);
$insertGenre->bindParam(':inputGenreId', $inputGenreId);
$insertGenre ->execute();
	//adding genres into the database

}
else {
	echo 'Error adding the first genre';
}
if (isset($_POST['genre1'])){
	
// adding the second genre to the database
$stmt3 = $pdo->prepare("SELECT * FROM genres WHERE genreName=:genres");	
$stmt3 ->bindParam(':genres', $_POST['genre1']);
$stmt3 -> execute();
$fetchgenreRow1 =$stmt3->fetch(PDO::FETCH_ASSOC);

$inputGenreId1 = $fetchgenreRow1['genre_id'];

$sql= 'INSERT INTO genresMovies (movies_id, genre_id)
VALUES(:movieId, :inputGenreId)';
$insertGenre1 = $pdo->prepare($sql);
$insertGenre1->bindParam(':movieId',$movieId);
$insertGenre1->bindParam(':inputGenreId', $inputGenreId1);
$insertGenre1 ->execute();

	//adding genres into the database

}
else {
	echo 'Error adding the second genre';
}
if (isset($_POST['genre2'])){
	
// adding the third genre to the database
$stmt3 = $pdo->prepare("SELECT * FROM genres WHERE genreName=:genres");	
$stmt3 ->bindParam(':genres', $_POST['genre2']);
$stmt3 -> execute();
$fetchgenreRow2 =$stmt3->fetch(PDO::FETCH_ASSOC);

$inputGenreId2 = $fetchgenreRow2['genre_id'];

$sql= 'INSERT INTO genresMovies (movies_id, genre_id)
VALUES(:movieId, :inputGenreId)';
$insertGenre2 = $pdo->prepare($sql);
$insertGenre2->bindParam(':movieId',$movieId);
$insertGenre2->bindParam(':inputGenreId', $inputGenreId2);
$insertGenre2 ->execute();

	//adding genres into the database

}
else {
	echo 'Error adding the third genre';
}
//**
//to-do list, allow for nothing to be selected under genre.
//**
//**

//if there is an actor already existing in the database,then it's similar to genre, if not we need to add the actor, then do the relationship
for ($i = 1; $i<=3; $i++) {
	if (isset($_POST['inputactor'.$i])){
	$stmt = $pdo->prepare("SELECT * FROM actors WHERE actorName=:actorName");
	$stmt ->bindParam(':actorName',$_POST['inputactor'.$i]);
	$stmt ->execute();
	$actorCheck = $stmt->fetch(PDO::FETCH_ASSOC);
		//if the actor does already exist
		if ($actorCheck){
			$addActor = $pdo->prepare('INSERT INTO actor_movies(movies_id, actor_id)
			VALUES (:movieId, :actor_id)');
			$addActor ->bindParam(':movieId', $movieId);
			$addActor ->bindParam(':actor_id', $actor1Check['actor_id']);
			$addActor -> execute();
			
		}
		//if the actor does not already exist
		else {
			$newActor = $pdo->prepare('INSERT INTO actors(actorName)
			VALUES (:actorName)');
			$newActor->bindParam (':actorName',$_POST['inputactor'.$i]);
			$newActor->execute();
			$newActorId = $pdo->lastInsertId();
			//after adding the new actor into the database, now we add the actor into actor_movies
			
			$addActor = $pdo->prepare('INSERT INTO actor_movies(movies_id, actor_id)
			VALUES (:movieId, :actor_id)');
			$addActor ->bindParam(':movieId', $movieId);
			$addActor ->bindParam(':actor_id', $newActorId);
			$addActor -> execute();	
		
		}

}}
		header("Location: AdminPage.php");

?>
</body>
</html>