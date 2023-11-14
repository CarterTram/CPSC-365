<html>
<head><title></title></head>
<body>
<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();
if (isset($_POST['commentID'])){
    $stmt = $pdo->prepare('DELETE FROM comments WHERE comments_id = :commentID;');
    $stmt->bindParam(':commentID',$_POST['commentID']);
    $stmt->execute();
    echo "comment deleted successfully.";

}
else {
    echo " comment ID is missing.";
}



?>
</body>
</html>