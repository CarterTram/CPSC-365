<html>
<head>
<title> Home Page of Profile</title><link href=".\stylesheet.css" rel="stylesheet">
</head>
<?php
session_start();
REQUIRE 'dbconnect.php';
REQUIRE 'header.php';
dbConnect ();

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
$stmt = $pdo->prepare('SELECT userName, favoriteMovie FROM users
						WHERE user_id = :userID');
if (isset($_GET['user_id'])) {
    $pageID = $_GET['user_id'];
}
else {
    $pageID = $_SESSION['user_id'];
}
$stmt->bindParam(':userID',$pageID);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$upload_location = 'uploads/';
$thumbnailName = $upload_location . $pageID . '_pfp.jpeg';
$friendsQuery = $pdo->prepare('SELECT users.userName FROM friends INNER JOIN users ON friends.user2_id = users.user_id WHERE friends.user_id = :userID');
$friendsQuery->bindParam(':userID', $pageID);
$friendsQuery->execute();
$friendsList = $friendsQuery->fetchAll(PDO::FETCH_COLUMN);

	if ($pageID ==$_SESSION['user_id']){
?>
		<p> Profile Picture
		<form action ="profilePicture.php"  method ="POST" enctype="multipart/form-data">
		<input type="file" name="uploadPFP" accept="image/*">
		<input type="submit" value="Upload Profile Picture">
</form>
</p>
<?php
	}
?>
<div class="profile">
    <div class="profile-picture">
        <?php
        if (file_exists($thumbnailName)) {
            echo '<img src="' . $thumbnailName . '" alt="Profile Picture">';
        } else {
            echo '<img src="uploads/default-profile-picture.jpg" alt="Default Profile Picture">';
        }
        ?>
    </div>

    <div class="user-info">
        <?php
        if ($row) {
            echo '<h2>' . htmlspecialchars($row['userName']) . '</h2>';
            // echo '<p>Favorite Movie: ' . htmlspecialchars($row['favoriteMovie']) . '</p>';
        }
        ?>
    </div>

    <div class="friends-list">
        <h3>Friends</h3>
        <?php
        foreach ($friendsList as $friend) {
            echo '<p>' . htmlspecialchars($friend) . '</p>';
        }

        ?>
    </div>
    <?php
    	if ($pageID ==$_SESSION['user_id']){
    //fetch ratings, //the select case will filter out the case of when
    //the friend request is found but the user_id could be the current user or vice versa, this 
    //elminates the double results and always make sure to get the friend_id.
        $stmt = $pdo->prepare('SELECT ratings.ratingValue, ratings.movies_id, users.userName AS userName, movies.movieName 
        FROM ratings
        JOIN users ON ratings.user_id = users.user_id
        JOIN movies ON ratings.movies_id = movies.movies_id 
        JOIN Friend_Requests ON (ratings.user_id = Friend_Requests.user_id OR ratings.user_id = Friend_Requests.user2_id)
        WHERE ratings.user_id IN (
            SELECT CASE 
                WHEN Friend_Requests.user_id = :userID THEN Friend_Requests.user2_id 
                ELSE Friend_Requests.user_id 
            END AS friend_id
            FROM Friend_Requests 
            WHERE (Friend_Requests.user_id = :userID OR Friend_Requests.user2_id = :userID) 
            AND Friend_Requests.Accept_Status = 1
        )
        ORDER BY ratings.dateAdded DESC 
        LIMIT 10');

        $stmt->bindParam(':userID', $pageID);
        $stmt->execute();
        $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($ratings as $rating) {
        echo "User: {$rating['userName']} rated '{$rating['movieName']}' with a rating of {$rating['ratingValue']} <br>";
        }
    ?>
	</div>
    <div class="recommendations">
    <?php 

        $stmt = $pdo->prepare('SELECT movies.movies_id, movies.movieName, AVG(ratings.ratingValue) AS avg_rating  
        FROM ratings
        JOIN movies ON ratings.movies_id = movies.movies_id
        JOIN Friend_Requests ON (ratings.user_id = Friend_Requests.user_id OR ratings.user_id = Friend_Requests.user2_id)
        WHERE ratings.user_id != :userID
          AND ratings.movies_id IN (
              SELECT movies.movies_id
              FROM Friend_Requests 
              WHERE (Friend_Requests.user_id = :userID OR Friend_Requests.user2_id = :userID) 
              AND Friend_Requests.Accept_Status = 1
          )
        GROUP BY movies.movies_id, movies.movieName
        ORDER BY avg_rating DESC    
        LIMIT 10');
        $stmt->bindParam(':userID', $pageID);
        $stmt->execute();
        $topMovies = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
    
    ?>
<div class="top-movies">
    <h3>Top 10 Movies Rated Highest by Friends</h3>
    <ul>
        <?php

        foreach ($topMovies as $movie) {
            $movieID = $movie['movies_id'];
            $filepath = "uploads/{$movieID}_thumbnail.jpeg";
            if(file_exists($filepath)){	
                //echo "<img src='{$filepath}'/><br/>";
                echo "<br/><img src='".$filepath."'/><br/>";
            }
            echo '<li><a href="moviePage.php?id=' . $movieID . '">'.($movie['movieName']) . '</a> (Average Rating: ' . number_format($movie['avg_rating'], 1) . ')</li>';
        }
    }
        ?>
    </ul>
</div>
</div>

<script type="text/javascript" src="jquery-3.7.1.min.js"></script>
	<script type="text/javascript" src="friendRequest.js"></script>

<body>


</body>
</html>
