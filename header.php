
<header>
    <button onclick="window.location.href='index.php'" style="background-color: skyblue;
    color: white;
    border: none;
    padding: 10px 20px;
	position: ; 
	cursor:pointer;
	top: 0; 
	left: 0;">Home</button>
</header>
<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']){
	echo '
	<form action="AdminPage.php" method="POST">
		<input type="submit" value= "Admin Home Page">	
 #fff; padding: 15px 20px; border: none; cursor: pointer;">
	</form>';
}
else {
	echo'
	<form action="registrationPage.php" method="POST">
	<input type="submit" class = "button" value= "Create New Account">	
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
