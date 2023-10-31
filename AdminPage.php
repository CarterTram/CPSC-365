<html>
<head><title> Admin Page </title><link href="stylesheet.css" rel="stylesheet"></head>

<?php
session_start();
REQUIRE 'header.php';
REQUIRE 'dbconnect.php';
dbConnect();
if (!((isset($_SESSION['admin']))|| $_SESSION['admin'])){
		header("Location:index.php");
		exit();
}
//class genreMenu {
	//function printmenu(){
	//echo '<form action="AdminPageDoform.php method ="POST"><label for="genres">Choose a genre:</label>
    //<select name="genre" id="genre">
	//<option value="Action">Action</option>
	//<option value="Adventure">Adventure</option>
    //<option value="Animation">Animation</option>
	//<option value="Comedy">Comedy</option>
	//<option value="Crime">Crime</option>
	//<option value="History">History</option>
//<option value="Horror">Horror</option>
	//<option value="Romance">Romance</option>
	//<option value="SciFi">Science Fiction</option>
	//</select></form>'; 
//}}
//$menuGenerator = new genreMenu();

?>
<div id="bodycontent">
<form action ="AdminPageDoform.php" method ="POST" enctype="multipart/form-data">
	Movie<br> <input type="text" name="inputmovieName" required><br>
	Director<br> <input type="text" name="inputdirector" required><br>
	Year<br> <input type="text" name="inputyearReleased" required><br>
	Actor<br> <input type="text" name="inputactor1"required><br>
	Actor<br> <input type="text" name="inputactor2"><br>
	Actor<br> <input type="text" name="inputactor3"><br>
	Description<br>
	<textarea name = "Description" rows="10" cols = "50" required></textarea><br>
	<input type="file" name="upload" accept="image/*">

	<label for="genres">Choose a genre:</label>
    <select name="genre" id="genres" required>
	<option value="Select a genre"></option>
	<option value="Action">Action</option>
	<option value="Adventure">Adventure</option>
    <option value="Animation">Animation</option>
	<option value="Comedy">Comedy</option>
	<option value="Crime">Crime</option>
	<option value="Fantasy">Fantasy</option>
	<option value="History">History</option>
    <option value="Horror">Horror</option>
	<option value="Romance">Romance</option>
	<option value="SciFi">Science Fiction</option>
	</select>
	
	
	<label for="genres">Choose a genre:</label>
    <select name="genre1" id="genres">
	<option value="Select a genre"></option>
	<option value="Action">Action</option>
	<option value="Adventure">Adventure</option>
    <option value="Animation">Animation</option>
	<option value="Comedy">Comedy</option>
	<option value="Crime">Crime</option>
	<option value="History">History</option>
    <option value="Horror">Horror</option>
	<option value="Romance">Romance</option>
	<option value="SciFi">Science Fiction</option>
	</select>
	
	
	<label for="genres">Choose a genre:</label>
    <select name="genre2" id="genres">
	<option value="Select a genre"></option>
	<option value="Action">Action</option>
	<option value="Adventure">Adventure</option>
    <option value="Animation">Animation</option>
	<option value="Comedy">Comedy</option>
	<option value="Crime">Crime</option>
	<option value="History">History</option>
    <option value="Horror">Horror</option>
	<option value="Romance">Romance</option>
	<option value="SciFi">Science Fiction</option>
	</select>
	<input type="submit" value="Add Movie">
<!-- image upload-->


</form>
</div>














</body>