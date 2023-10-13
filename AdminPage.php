<html>
<head><title> Admin Page </title><link href="StyleSheet.css" rel="stylesheet"></head>
<body>
<?php
session_start();
REQUIRE 'header.php';
REQUIRE 'dbconnect.php';
dbConnect();
if (!((isset($_SESSION['admin']))|| $_SESSION['admin'])){
		header("Location:index.php");
		exit();
}
class genreMenu {
	function printmenu(){
	echo '<label for="genres">Choose a genre:</label>
    <select name="genre" id="genre">
	<option value="Action">Action</option>
	<option value="Adventure">Adventure</option>
    <option value="Animation">Animation</option>
	<option value="Comedy">Comedy</option>
	<option value="Crime">Crime</option>
	<option value="History">History</option>
    <option value="Horror">Horror</option>
	<option value="Romance">Romance</option>
	<option value="SciFi">Science Fiction</option>


	</select>'; 
}}
$menuGenerator = new genreMenu();

?>
<div id="bodycontent">
<form action ="AdminPageDoform.php" method ="POST">
	Movie<br> <input type="text" name="inputmovieName"><br>
	Director<br> <input type="text" name="inputdirector"><br>
	Year<br> <input type="text" name="inputyearReleased"><br>
	Producer<br> <input type="text" name="inputproducer"><br>	
	Actor<br> <input type="text" name="inputactor"><br>
	Actor<br> <input type="text" name="inputactor"><br>
	Actor<br> <input type="text" name="inputactor"><br>
	Description<br>
	<textarea name = "Description" rows="10" cols = "50"></textarea><br>

	<?php $menuGenerator ->printmenu();
	$menuGenerator ->printmenu();
	$menuGenerator ->printmenu();	?>
  <input type="submit" value="Submit">

</form>
</div>














</body>