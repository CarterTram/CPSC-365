<html> 
<head><title>Processing Form</title></head>
<body>
<?php
REQUIRE 'dbconnect.php';
dbconnect();
echo 'Username: '.$_POST['username'].'<br>';
echo 'Password: '.$_POST['password'].'<br>';
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

else if (password_verify ($password, $encryptedPass)){
		
	session_start ();
	session_regenerate_id (true);
		$_SESSION['user_id'] = $usernameCheck['user_id'];
			echo 'Login Successful';
			header ("Location: mainProfile.php");
			exit();

}

else {
	
	echo 'Such account does not exist';
	header("Location: mainProfile.php");
	exit();
	
	
}






?>
</body>
</html>


