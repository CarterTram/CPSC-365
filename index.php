<?php
session_start();
REQUIRE 'header.php';
?>
<html>
<head><title>User Authentication</title></head>

<body>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
    </style>
<h1> Movie Discovery </h1>
<style>
		.button {
		  background-color: #4CAF50;
		  border: none;
		  color: white;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 4px 2px;
		  cursor: pointer;
		}
</style>
<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']){
	echo '
	<form action="AdminPage.php" method="POST">
		<input type="submit" value= "Admin Home Page">	
	</form> 
	';
}

if (isset($_SESSION['user_id'])){
	echo'<form action="logout.php" method="POST" style="text-align: center;">
    <input type="submit" value="Logout" style="background-color: #ff0000; color: #fff; padding: 15px 20px; border: none; cursor: pointer;">
	</form>';
}
else {
	echo'
	<form action="registrationPage.php" method="POST">
	<input type="submit" class = button value= "Create New Account">	
	</form>
	<form action="loginPage.php" method="POST">
	<input type="submit" class ="button" value= "Login">
	</form>';
}


//<form action="registrationPage.php" method="POST">
//	<input type="submit" value= "Create New Account">	
//</form>
//<form action="loginPage.php" method="POST">
//	<input type="submit" value= "Login">
//</form>
?>

</body>
</html>