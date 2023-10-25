<head><title>User Authentication</title><link href="stylesheet.css" rel="stylesheet"></head>
<header>

</header>
<body>
<div class="header-background">
<?php
echo'
<form action="index.php" method="POST">
<input type="submit" class = "headbutton" value= "Home">	
</form>';

if (isset($_SESSION['admin']) && $_SESSION['admin']){
	echo '
	<form action="AdminPage.php" method="POST">
		<input type="submit" class = "headbutton" value= "Admin Home Page">	
	</form>';
}
if (isset($_SESSION['user_id'])) {
echo'<form action="logout.php" method ="POST">
<input type="submit" class = "headbutton" value= "Logout">
</form>';
	
}
else {

echo'	
	<form action="registrationPage.php" method="POST">
	<input type="submit" class ="headbutton" value= "Create New Account">	
	</form>
	<form action="loginPage.php" method="POST">
	<input type="submit" class ="headbutton" value= "Login">
	</form>';
}


//<form action="registrationPage.php" method="POST">
//	<input type="submit" value= "Create New Account">	
//</form>
//<form action="loginPage.php" method="POST">
//	<input type="submit" value= "Login">
//</form>
?>
</div>
