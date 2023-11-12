<html> 
<head><title>Processing Form</title></head>
<body>
<?php
session_start ();
REQUIRE 'header.php';
REQUIRE 'dbconnect.php';
dbConnect();
$username= $_POST['username'];
$password= $_POST['password'];
$sql = "SELECT * FROM users WHERE userName = :username";
$loginStmt = $pdo->prepare($sql);
$loginStmt->bindParam (':username', $username);
$loginStmt->execute ();	
//$usernameCheck = $loginStmt->fetch();
$usernameCheck =$loginStmt->fetch(PDO::FETCH_ASSOC);
if (!$usernameCheck){
	echo 'The user does not exist';
}

else  {
	$encryptedPass = $usernameCheck['password'];
	if (password_verify ($password, $encryptedPass)){

	session_regenerate_id (true);
		$_SESSION['user_id'] = $usernameCheck['user_id'];
		$_SESSION['admin'] = $usernameCheck['admin'];
			echo 'Login Successful';
			header ("Location: index.php");
			exit();

}

	else {
		
		echo 'Such account does not exist';
		header("Location: index.php");
		exit();
	
	
}}






?>
</body>
</html>


