<html>
<head><title>Movie Page</title><link href=".\stylesheet.css" rel="stylesheet"></head>
<h1></h1>
<?php
session_start();
REQUIRE 'dbconnect.php';
REQUIRE 'header.php';
dbConnect ();
?>



    <div class="centerDiv">
    <p>
        <?php
            $movieId= $_GET['id'];
            $sql = "SELECT * FROM movies WHERE movies_id =:movieId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':movieId',$movieId);
            $stmt->execute();
            $movie = $stmt ->fetch(PDO::FETCH_ASSOC);
         //display image
            $filepath = "uploads/{$movieId}_thumbnail.jpeg";
            if(file_exists($filepath)){	
         //echo "<img src='{$filepath}'/><br/>";
                echo "<img src='".$filepath."'/><br/>";
            }
            if (isset($movieId)){
        //fetch actors
                $stmt= $pdo->prepare("SELECT actors.actorName FROM actor_movies JOIN actors ON actor_movies.actor_id = actors.actor_id WHERE actor_movies.movies_id = :movieId");
                $stmt->bindParam(':movieId',$movieId);
                $stmt->execute();
                $actorsList = $stmt->fetchAll();
                foreach ($actorsList as $actor){
                    echo $actor['actorName']."<br/>";
                    
                }
            
         //fetch genres
                $stmt= $pdo->prepare("SELECT genres.genreName FROM genresMovies JOIN genres ON genresMovies.genre_id = genres.genre_id WHERE genresMovies.movies_id = :movieId");
                $stmt->bindParam(':movieId',$movieId);
                $stmt->execute();
                $genresList = $stmt->fetchAll();
                echo "<p class=\"genreFont\">";
                foreach ($genresList as $genre){
                    echo $genre['genreName']." ";
                    
                }
                echo "</p>";

    
            }
              
            if (isset($_SESSION['user_id'])) {
         //fetch rating
                $ratingUserID = $_SESSION['user_id'];
                $sql ='SELECT * FROM ratings WHERE (user_id =:user_id) AND (movies_id =:movieId)';
                $stmt3 = $pdo->prepare($sql);
                $stmt3->bindParam(':user_id',$ratingUserID);
                $stmt3->bindParam(':movieId',$movieId);
                $stmt3->execute();
                $ratingFetch =$stmt3->fetch();
                if ($ratingFetch!=NULL){
                $ratingOwnerID = $ratingFetch['user_id'];

                }
                else{
                    $ratingOwnerID = -1;
                }
                
                if ($_SESSION['user_id'] != $ratingOwnerID){
                    echo ' 
                    <form class="rating-form" action="movieRating.php" method="POST">
                        <p class="rating-label">Rate this movie:</p>
                        <label for="rating-5" class="rating-star">1★</label>
                        <input type="radio" name="rating" value="1" id="rating-1" class="rating-input">
                        <label for="rating-4" class="rating-star">2★</label>
                        <input type="radio" name="rating" value="2" id="rating-2" class="rating-input">
                        <label for="rating-3" class="rating-star">3★</label>
                        <input type="radio" name="rating" value="3" id="rating-3" class="rating-input">
                        <label for="rating-2" class="rating-star">4★</label>
                        <input type="radio" name="rating" value="4" id="rating-4" class="rating-input">
                        <label for="rating-1" class="rating-star">5★</label>
                        <input type="radio" name="rating" value="5" id="rating-5" class="rating-input">
                        <input type="submit" value="Submit Rating">
                        <input type="hidden" id="movieIDTransfer" name="movieID" value="'.$movieId.'">
                    </form>';
                }
            else {

                echo "Your rating for this movie is: {$ratingFetch['ratingValue']}";    
            }
        }
			?>
                 <p class="movieName"><?php echo $movie['movieName']; ?></p>
               <fieldset><legend>Description</legend> <p class ="description"><?php echo $movie['description']; ?></p></fieldset><br/>
                <p>Directed By: <?php echo $movie['director'];?><br/>
                Year: <?php echo$movie['yearReleased'];?></p>
			            
        
        </p>             
    <?php
if (isset($_SESSION['user_id'])){
    ?>
<p> Leave a comment:
<form action="comment.php" method ="POST">
<br/><textarea name = "comment" rows="1" cols = "50"></textarea><br/>
<input type="hidden" id="movieIDTransfer" name="movieID" value="<?php echo$movieId; ?>">
<input type="submit" value="Comment" >
</form>
</p>
<?php
}
          
        //fetch comments
            $commentDisplay ='SELECT * FROM comments WHERE movies_id =:movieId ORDER BY dateAdded DESC';
            $stmt =$pdo->prepare($commentDisplay);
            $stmt->bindParam(':movieId',$movieId);
            $stmt->execute();
            while ($commentFetch = $stmt->fetch()){
                $commentUserID =$commentFetch['user_id'];
                $commentContent =$commentFetch['commentContent'];
         //fetch user
                $sql ='SELECT * FROM users WHERE user_id = :user_id';
                $stmt2 = $pdo->prepare($sql);
                $stmt2->bindParam(':user_id',$commentUserID);
                $stmt2->execute();
                $userNameFetch =$stmt2->fetch();
                $commentOwner = $userNameFetch['userName'];
                $commentTime = $commentFetch['dateAdded'];
//check if friendship exist
                $checkFriendship = 'SELECT FR_ID FROM Friend_Requests 
                WHERE (user2_id = :user2_id AND user_id =:user_id AND Accept_Status = 1) 
                   OR (user_id = :user2_id AND user2_id = :user_id AND Accept_Status = 1)';
                $checkFriendshipStmt = $pdo->prepare($checkFriendship);
                $checkFriendshipStmt->bindParam(':user_id', $_SESSION['user_id']);
                $checkFriendshipStmt->bindParam(':user2_id', $commentUserID);
                $checkFriendshipStmt->execute();
                $areFriends = $checkFriendshipStmt->fetch();
                // $checkFriendship = 'SELECT user2_id FROM friends 
                //     WHERE (user_id = :user_id AND user2_id = :user2_id) 
                //        OR (user_id = :user2_id AND user2_id = :user_id)';
                // $checkFriendshipStmt = $pdo->prepare($checkFriendship);
                // $checkFriendshipStmt->bindParam(':user_id', $_SESSION['user_id']);
                // $checkFriendshipStmt->bindParam(':user2_id', $commentUserID);
                // $checkFriendshipStmt->execute();
                // $areFriends = $checkFriendshipStmt->fetch();
//check if the friend request exiists

    
                $checkFriendRequest = 'SELECT FR_ID FROM Friend_Requests 
                       WHERE (user2_id = :user2_id AND user_id =:user_id AND Pending_Status = 1) 
                          OR (user_id = :user2_id AND user2_id = :user_id AND Pending_Status = 1)';
                $friendRequestStmt = $pdo->prepare($checkFriendRequest);
                $friendRequestStmt->bindParam(':user2_id', $_SESSION['user_id']);
                $friendRequestStmt->bindParam(':user_id', $commentUserID); // Bind comment owner ID
                $friendRequestStmt->execute();
                $friendRequestExist = $friendRequestStmt->fetch();

    
                    
                ?></div>
                    <div class="friend-comment">
                        <p><?php echo $commentOwner; ?> said:</p>
                        <p><?php echo $commentContent; ?></p>
                        <p class="comment-date"><?php echo $commentTime; ?></p>
                    </div>

                <?php
                //if they aren't friend show friend request button
                    if ($commentUserID != $_SESSION['user_id'] && !$areFriends && !$friendRequestExist ){
                        $senderID =$_SESSION['user_id'];
                        ?> <button class="add-friend-button" id="fetch" 
                            data-sender= "<?php echo $senderID;?>" 
                            data-receiver= "<?php echo $commentUserID;?>"
                            data-status="Pending_Status">Send Friend Request</button>
                        <div id="response"></div>
                        <?php

                    
                            }  

                           echo'</p>';
               }

        
        ?>


    </div>


<script type="text/javascript" src="jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="friendRequest.js"></script>
</body>
</html>