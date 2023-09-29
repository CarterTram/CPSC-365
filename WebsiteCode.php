<html>
<head>
<title>My Page</title>
</head>
<body>
<h1>This is my page</h1>
<?php

if (isset($_POST['userid']))
{
//process the form
}
	
else 
{
?>

<form method="POST">  
User Id: <input type="text" name ="userid"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
<?php
}
?>

</form>
</body>
</html>