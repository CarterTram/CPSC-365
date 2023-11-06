<html>
<head><title></title></head>
<body>
<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();
$sql = 'DELETE FROM movies WHERE movieName = :movieName';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':movieName',$_POST['movieName']);
$stmt->execute();

echo 'Movie Successfully Deleted';
echo '<meta http-equiv="refresh" content ="5;URL=\'http://localhost/CPSC-365/index.php\'">';



?>
</body>
</html>