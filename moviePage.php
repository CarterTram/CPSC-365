<html>
<head><title>Movie Page</title><link href=".\stylesheet.css" rel="stylesheet"></head>
<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();
?>


<body>
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
    </p>
    <h2><?php echo $movie['movieName']; ?></h2>
    <p><?php echo $movie['description']; ?></p>
    </div>


</body>
</html>