<html>
<head><title> Admin Page </title></head>
<body>
<?php
REQUIRE 'header.php';
if (!(isset($_SESSION['admin']))|| S_SESSION['admin']){
		header("Location:index.php");
		exit();
}
class genreMenu {
	
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


	</select>
  <input type="submit" value="Submit">';
}
$menuGenerator = new genreMenu();
?>

<form>
	Movie <input type="text" name="inputmovieName"><br>
	Director <input type="text" name="inputdirector"><br>
	Year <input type="text" name="inputyearReleased"><br>
	Producer <input type="text" name="inputproducer"><br>
	Description <input type="text" name="inputdescription"><br>
	<?php genreMenu ?>
	<label for="genres">Choose a genre:</label>
    
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

	</select>
  <input type="submit" value="Submit">
	
	
</form>














</body>