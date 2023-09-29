<html>
<head><title>Login Page</title></head>
<body>
<h1> User Login </h1>
<form action="Login.php" method ="POST">
	<input type="hidden" name="hiddenvalue" value="foo">
		Username <input type="text" name="username"><br>
		Password <input type="password" name= "password"><br>
	<input type ="submit" name ="Login">
</form>
<form action="index.php" method="POST">
<input type="submit" value ="Create New Account">
</form>
</body>
</html>
