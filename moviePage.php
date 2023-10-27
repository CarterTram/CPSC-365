<html>
<head><title>Movie Page</title><link href=".\stylesheet.css" rel="stylesheet"></head>
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
            $filepath = "uploads/{$movieId}.jpeg";
            if(file_exists($filepath)){	
                //echo "<img src='{$filepath}'/><br/>";
                echo "<img src='".$filepath."'/><br/>";
            }
        ?>
    
    <?php
            $commentDisplay ='SELECT * FROM comments';
            $stmt =$pdo->prepare($commentDisplay);
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
                //fetch rating
                $sql ='SELECT * FROM ratings WHERE user_id =:user_id';
                $stmt3 = $pdo->prepare($sql);
                $stmt3->bindParam(':user_id',$commentUserID);
                $stmt3->execute();
                $ratingFetch =$stmt3->fetch();

    
                    if (isset($_SESSION['user_id'])) {
                        if ($_SESSION['user_id'] != $commentUserID){
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
                <p class ="description"><?php echo $movie['description']; ?></p><br/>
                <p>Directed By: <?php echo $movie['director'];?><br/>
                Year: <?php echo$movie['yearReleased'];?></p>
                <?php 
                    if (isset($_SESSION['user_id'])) {

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
                        //Display comments


                    
                            echo "<br/><p class =\"comments\">{$commentOwner} : $commentContent";
                            if (isset($_SESSION['user_id'])){

                                if ($commentUserID != $_SESSION['user_id']){
                                    echo'<form action="addFriend.php" method ="POST">
                                    <input type="submit" value ="Add Friend" class="None">
                                    </form><br/>';
                                }
        
                            }

                           echo'</p>';
               }
        
        ?>


    </div>



</body>
</html>