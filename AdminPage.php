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
<br/>

<div id="bodycontent">
<p class="title"> Add a movie</p>
<form action ="AdminPageDoform.php" method ="POST" enctype="multipart/form-data">
	Movie<br> <input type="text" name="inputmovieName" required><br>
	Director<br> <input type="text" name="inputdirector" required><br>
	Year<br> <input type="text" name="inputyearReleased" required><br>
	
	<!--try to javascript actor-->
	<span id="actorList">Actor<br><input type="text" id="actorsAdd" name ="actor[]"><br/>

</span>
	
	<input type="button" id="addActorButton" value="More Actors"><br/>


<!--old code
	Actor<br> <input type="text" id="actor1" name="inputactor1"><br>
	Actor<br> <input type="text" id="actor2" name="inputactor2"><br>
	Actor<br> <input type="text" id="actor3" name="inputactor3"><br>

	-->
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
	<option value="Drama">Drama</option>
	<option value="Fantasy">Fantasy</option>
	<option value="History">History</option>
    <option value="Horror">Horror</option>
	<option value="Romance">Romance</option>
	<option value="SciFi">Science Fiction</option>
	<option value="Thriller">Thriller</option>
	</select>
	
	
	<label for="genres">Choose a genre:</label>
    <select name="genre1" id="genres">
	<option value="Select a genre"></option>
	<option value="Action">Action</option>
	<option value="Adventure">Adventure</option>
    <option value="Animation">Animation</option>
	<option value="Comedy">Comedy</option>
	<option value="Crime">Crime</option>
	<option value="Drama">Drama</option>
	<option value="Fantasy">Fantasy</option>
	<option value="History">History</option>
    <option value="Horror">Horror</option>
	<option value="Romance">Romance</option>
	<option value="SciFi">Science Fiction</option>
	<option value="Thriller">Thriller</option>
	</select>
	
	
	<label for="genres">Choose a genre:</label>
    <select name="genre2" id="genres">
	<option value="Select a genre"></option>
	<option value="Action">Action</option>
	<option value="Adventure">Adventure</option>
    <option value="Animation">Animation</option>
	<option value="Comedy">Comedy</option>
	<option value="Crime">Crime</option>
	<option value="Drama">Drama</option>
	<option value="Fantasy">Fantasy</option>
	<option value="History">History</option>
    <option value="Horror">Horror</option>
	<option value="Romance">Romance</option>
	<option value="SciFi">Science Fiction</option>
	<option value="Thriller">Thriller</option>
	</select><br/>
	<input type="submit" value="Add Movie">
	</form>
<br/>
<p class ="title" >Enter in the Movie Name you would like to delete</p>
<br/>
<form action="deleteMovie.php" method ="POST">
Movie Name:<br><input type="text" name ="movieName" required><br/>
<input type="submit" value="Delete Movie">
</form>

<!-- <p class="title">Enter in the Comment you would like to delete</p>
<form action="deleteMovie.php" method ="POST">
Comment User:<br><input type="text" name ="commentName" required><br/>
Movie Name:<br><input type="text" name="movieName" required><br/>
<input type="submit" value="Delete Comment">
</form> -->
	
<!-- image upload-->


</div>









<!--javascript-->

<script type="text/javascript" src="jquery-3.7.1.min.js"></script>
<script type="text/javascript" src="adminJS.js"></script>
</body>