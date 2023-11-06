<?php
session_start();
REQUIRE 'header.php';
REQUIRE 'dbconnect.php';
dbConnect ();
?>
<head><title>Movie Discovery</title><link href="StyleSheet.css" rel="stylesheet"></head>

<?php

// if (isset($_SESSION['user_id'])){
// 	$commentDisplay = "SELECT comments.commentContent, comments.dateAdded
// 	FROM comments 
// 	JOIN friends ON comments.user_id = friends.user2_id
// 	WHERE friends.user_id = :user_id
// 	ORDER BY comments.dateAdded DESC
// 	LIMIT 10";
// 	$stmt = $pdo->prepare($commentDisplay);
// 	$userID = $_SESSION['user_id'];
// 	$stmt ->bindParam(':user_id',$userID);	
// 	$stmt -> execute();
// }

// while ($commentDisplay = $stmt->fetch()){
// 	$commentUserID =$commentDisplay['user_id'];
// 	$commentContent =$commentDisplay['commentContent'];
// //fetch user
// 	$sql ='SELECT * FROM users WHERE user_id = :user_id';
// 	$stmt2 = $pdo->prepare($sql);
// 	$stmt2->bindParam(':user_id',$commentUserID);
// 	$stmt2->execute();
// 	$userNameFetch =$stmt2->fetch();
// 	$commentOwner = $userNameFetch['userName'];
// 	$commentTime = $commentFetch['dateAdded'];

// 	echo "<br/><p class =\"comments\">{$commentOwner}: ";
// 	echo htmlentities($commentContent,ENT_QUOTES);
// 	echo "$commentTime";
// }


$movieDisplay ='SELECT *
FROM movies
ORDER BY dateAdded DESC
LIMIT 6';

$stmt = $pdo->prepare($movieDisplay);
$stmt -> execute();

//SHOW SOME MOVIES AT THE HOMEPAGE
while ($movieCheck = $stmt -> fetch()){
	$movieId = $movieCheck['movies_id'];	
	$filepath = "uploads/{$movieId}_thumbnail.jpeg";
	if(file_exists($filepath)){	
		//echo "<img src='{$filepath}'/><br/>";
		echo "<br/><img src='".$filepath."'/><br/>";
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