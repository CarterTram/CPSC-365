<html>
<head><title>Register</title><link href="StyleSheet.css" rel="stylesheet"></head>
<body>
<h1> Registration </h1><br/>
<?php REQUIRE 'header.php'; ?>
<?php
if (isset($_GET["error"])) {
    $error = $_GET["error"];
    echo "<p class='error'>$error</p>";
}
?>
<form action="doform.php" method="POST">  
	<input type="hidden" name="hiddenvalue" value="foo">
	<br/><br/>Username <input type="text" name="username"><br>
		 Password <input type="password" name= "password"><br>
	<input type="submit" value="Register">
</form>
Already have an account?
<form action="loginPage.php" method="POST">
	<input type="submit"class="test" value= "Login">
</form>
<form action="index.php" method="POST">
	<input type="submit" value= "Home">
</form>
</body>
</html>