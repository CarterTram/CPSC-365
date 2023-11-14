<html>
<head><title>Register</title><link href="StyleSheet.css" rel="stylesheet"></head>
<?php REQUIRE 'header.php'; ?>
<?php
if (isset($_GET["error"])) {
    $error = $_GET["error"];
    echo "<p class='error'>$error</p>";
}
if (isset($_GET["error1"])) {
    $error = $_GET["error1"];
    echo "<p class='error'>$error</p>";
}
?>
<form action="doform.php" method="POST" onsubmit="return validateForm()">
        <input type="hidden" name="hiddenvalue" value="foo">
        <br/><br/>
        <label for="username">Username</label>
        <input type="text" name="username" id="username"><br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password"><br>

        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" id="confirmPassword"><br>

        <input type="submit" value="Register">
    </form>

Already have an account?
<form action="loginPage.php" method="POST">
	<input type="submit"class="test" value= "Login">
</form>
<form action="index.php" method="POST">
	<input type="submit" value= "Home">
</form>
<script>
        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }

            return true;
        }
</script>	
	    <style>
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="password"] {
            margin-bottom: 10px;
        }
        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</body>
</html>