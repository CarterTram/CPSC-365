<html>
<head><title>Processing Form</title></head>
<body>
<?php
REQUIRE 'dbconnect.php';
dbConnect ();

echo 'Username: '.$_POST['username'].'<br>';
echo 'Password: '.$_POST['password'].'<br>';
$username= $_POST['username'];
$password= $_POST['password'];
$sql = "SELECT * FROM users WHERE userName = :username";
$stmt1 = $pdo->prepare($sql);
$stmt1->bindParam (':username', $username);
$stmt1->execute ();	
$row = $stmt1->fetch();
if ($row){
	
	echo 'Username already exists';

}

else {
	
	$sql = 'INSERT INTO users (userName, password) VALUES (:username, :password)';
	$stmt = $pdo->prepare ($sql);
	$username= $_POST['username'];
	$password= $_POST['password'];
	$encryptedPass = password_hash ($password, PASSWORD_BCRYPT);
	$stmt->bindParam (':username', $username);
	$stmt->bindParam (':password', $encryptedPass);
	$stmt->execute ();
	echo 'Registration Successful'.'<br>';
	header("Location:loginPage.php");

}

?>
</body>