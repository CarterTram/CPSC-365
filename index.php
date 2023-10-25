<?php
session_start();
REQUIRE 'header.php';
REQUIRE 'dbconnect.php';
dbConnect ();
?>
<html>
<head><title>User Authentication</title><link href="StyleSheet.css" rel="stylesheet"></head>


<br/><h1 class="title"> Movie Discovery </h1>


<?php
$movieDisplay ='SELECT *
FROM movies
ORDER BY dateAdded DESC
LIMIT 5';
//$movieDisplay = 'SELECT * 
//FROM movies 
//LIMIT 5';
$stmt = $pdo->prepare($movieDisplay);
$stmt -> execute();

//SHOW SOME MOVIES AT THE HOMEPAGE
while ($movieCheck = $stmt -> fetch()){
	$movieId = $movieCheck['movies_id'];	
	$filepath = "uploads/{$movieId}_thumbnail.jpeg";
	if(file_exists($filepath)){	
		//echo "<img src='{$filepath}'/><br/>";
		echo "<img src='".$filepath."'/><br/>";
	}
	
	$url = "moviePage.php?id={$movieId}";
	$linkurl = "<h1><a href='{$url}'>{$movieCheck['movieName']}</a></h1>";
	echo $linkurl;
	echo "<br/><p class =\"description\">{$movieCheck['description']}</p>";
	echo "<br/><p class =\"description\">Directed By: {$movieCheck['director']}</p>";
	
}
?>
</body>
</html>