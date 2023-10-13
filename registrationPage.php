<html>
<head><title>Register</title><link href="StyleSheet.css" rel="stylesheet"></head>
<body>
<h1> Registration </h1>
<?php REQUIRE 'header.php'; ?>
<form action="doform.php" method="POST">  
	<input type="hidden" name="hiddenvalue" value="foo">
		Username <input type="text" name="username"><br>
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