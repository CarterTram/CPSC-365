<html>
<head>
<title> Home Page of Profile</title><link href=".\stylesheet.css" rel="stylesheet">
</head>
<?php
session_start();
REQUIRE 'dbconnect.php';
REQUIRE 'header.php';
dbConnect ();
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
    //fetch ratings
        $stmt = $pdo->prepare('SELECT ratings.ratingValue, ratings.movies_id, users.userName AS userName, movies.movieName 
        FROM ratings 
        JOIN users ON ratings.user_id = users.user_id 
        JOIN movies ON ratings.movies_id = movies.movies_id 
        WHERE ratings.user_id = :user_id 
        ORDER BY ratings.dateAdded DESC');
        $stmt->bindParam(':user_id', $pageID);
        $stmt->execute();
        $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($ratings as $rating) {
        echo "User: {$rating['userName']} rated '{$rating['movieName']}' with a rating of {$rating['ratingValue']} <br>";
        }
    ?>
	</div>
    <div class="recommendations">
    <?php 

        $stmt = $pdo->prepare('SELECT movies.movieName, AVG(ratings.ratingValue) AS avg_rating 
        FROM ratings 
        JOIN movies ON ratings.movies_id = movies.movies_id 
        WHERE ratings.user_id IN (
            SELECT user2_id FROM friends WHERE user_id = :userID
        )
        GROUP BY movies.movieName 
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
            echo '<li>' . htmlspecialchars($movie['movieName']) . ' (Average Rating: ' . number_format($movie['avg_rating'], 1) . ')</li>';
        }
        ?>
    </ul>
</div>

<body>


</body>
</html>
