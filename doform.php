<html>
<head><title>Registration Form</title></head>
<body>
<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();
$username= $_POST['username'];
$password= $_POST['password'];
$sql = "SELECT * FROM users WHERE userName = :username";
$stmt1 = $pdo->prepare($sql);
$stmt1->bindParam (':username', $username);
$stmt1->execute ();	
$row = $stmt1->fetch();
$pattern = '/^[a-zA-Z0-9]+$/';
if (strlen($password)<6){
	
	$error = "Password must be at least 6 characters long";
	header("Location: registrationPage.php?error=" . urlencode($error));
	exit();
}
else if (!preg_match($pattern,$password)){
	$error = "Password must contain only letters and numbers.";
	header("Location: registrationPage.php?error=" . urlencode($error));
	exit();
}
else{

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

}}

?>
</body>