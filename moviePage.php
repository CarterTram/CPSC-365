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
    if (isset($_SESSION['user_id'])) {
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
    
    
    ?>
    <p class="movieName"><?php echo $movie['movieName']; ?></p>
    <p class ="description"><?php echo $movie['description']; ?></p>
    <p>Comments:<br/><textarea name = "comment" rows="1" cols = "50"></textarea></p><br/>
    </div>



</body>
</html>