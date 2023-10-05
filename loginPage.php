<html>
<head><title>Login Page</title></head>
<body>
<?php REQUIRE 'header.php'; ?>
<h1 style="font-size: 24px; text-align: center; margin-top: 10px;"> User Login </h1>
<form action="Login.php" method ="POST"style ="background-color: #7FFFD4; color:black; border: none; position: absolute; top:50%; left:45%">
	<input type="hidden" name="hiddenvalue" value="foo">
		Username <input type="text" name="username"><br>
		Password <input type="password" name= "password"style=" position: absolute;left: 28%"><br>
	<input type ="submit" name ="Login"style="background-color: skyblue; color: black; border: none; padding: 10px 20px; position: absolute;top : 110%; left: 66.5%	">

</body>
</html>
