<?php
session_start();
REQUIRE 'header.php';
REQUIRE 'dbconnect.php';
dbConnect ();
?>
<head><title>Movie Discovery</title><link href="StyleSheet.css" rel="stylesheet"></head>

<?php

//fetch friend requests
$stmt =$pdo->prepare('SELECT * FROM Friend_Requests WHERE user2_id =:userID AND Pending_Status = 1');
$stmt->bindParam('userID',$_SESSION['user_id']);
$stmt->execute();
while($friendRequestDisplay = $stmt->fetch()){
	if ($friendRequestDisplay['user_id']!=$_SESSION['user_id']){
	$friend2 = $friendRequestDisplay['user_id'];
	$stmt1 = $pdo->prepare('SELECT userName FROM users WHERE user_id =:userID ');
	$stmt1->bindParam(':userID',$friendRequestDisplay['user_id']);
	$stmt1->execute();
	$UserFriendRequest = $stmt1->fetch();


	?><div id="buttons">
	<br/>Friend Request From: <?php echo $UserFriendRequest['userName']; ?>
	<button id="friendAccept" class="action_btn"
	data-sender= "<?php echo $_SESSION['user_id'];?>"
	data-friend2= "<?php echo $friend2;?>">
	Accept</button>
	
	<button id="friendReject" class="action_btn"
	data-sender= "<?php echo $_SESSION['user_id'];?>"
	data-friend2= "<?php echo $friend2;?>">
	Reject</button>

	</div><br/>
	<div id="response"></div>
	
	<?php 
}}
?>

<form class = "search-bar-container" method="get" action="index.php">
    <label for="search">Search Movies:</label>
    <input class = "search-input" type="text" id="search" name="search" placeholder="Enter movie name">
    <input class = "search-button"type="submit" value="Search">
</form>

<?php


// Fetch 10 most recent comments from friends
$stmt = $pdo->prepare('SELECT comments.commentContent, comments.dateAdded, users.userName
                      FROM comments 
                      JOIN friends  ON (comments.user_id = friends.user2_id AND friends.user_id = :userID)
                      JOIN users  ON comments.user_id = users.user_id
                      ORDER BY comments.dateAdded DESC
                      LIMIT 10');
$stmt->bindParam(':userID', $_SESSION['user_id']);
$stmt->execute();

// Display the comments
while ($comment = $stmt->fetch()) {
    ?>
    <div class="friend-comment">
        <p><?php echo $comment['userName']; ?> said:</p>
        <p><?php echo $comment['commentContent']; ?></p>
        <p class="comment-date"><?php echo $comment['dateAdded']; ?></p>
    </div>
    <?php
}?>


<?php
// Search movies
	if (isset($_GET['search'])) {
		$searchQuery = '%' . $_GET['search'] . '%';
		$movieDisplay = "SELECT *
						FROM movies
						WHERE movieName LIKE :searchQuery
						ORDER BY dateAdded DESC
						LIMIT 6";

		$stmt = $pdo->prepare($movieDisplay);
		$stmt->bindParam(':searchQuery',$searchQuery);
	}


	else{
	//fetch movies
	$movieDisplay ='SELECT *
	FROM movies
	ORDER BY dateAdded DESC
	LIMIT 6';

	$stmt = $pdo->prepare($movieDisplay);
	}
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
	<script type="text/javascript" src="jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="friendRequest.js"></script>

	</body>
	</html>