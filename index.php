<?php
session_start();
REQUIRE 'header.php';
REQUIRE 'dbconnect.php';
dbConnect ();
?>
<html>
<head><title>User Authentication</title><link href="StyleSheet.css" rel="stylesheet"></head>

<body>
<h1> Movie Discovery </h1>


<?php
$movieDisplay = 'SELECT * FROM movies LIMIT 5';
$stmt = $pdo->prepare($movieDisplay);
$stmt -> execute();

//SHOW SOME MOVIES AT THE HOMEPAGE
while ($movieCheck = $stmt -> fetch()){
	$movieId = $movieCheck['movies_id'];
	echo 'MOVIE ID IS'.$movieId;
	$filepath = "uploads/{$movieId}_thumbnail.jpeg";
		$filepath = "uploads/9_thumbnail.jpeg";
	if(file_exists($filepath)){	
		//echo "<img src='{$filepath}'/><br/>";
		echo "<img src='".$filepath."'/><br/>";
		echo" loop is running";
	}
	
	$url = "moviePage.php?movies_id ={$movieId}";
	$linkurl = "<h1><a href='{$url}'>{$movieCheck['movieName']}</a></h1>";
	echo $linkurl;
	echo "<br/><p>{$movieCheck['description']}</p>";
	echo "<br/><p>Directed By: {$movieCheck['director']}</p>";
	
}
?>
</body>
</html>