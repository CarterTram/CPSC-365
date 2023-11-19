<?php
session_start();
REQUIRE 'dbconnect.php';
dbConnect ();
if (isset($_FILES['uploadPFP'])){
		var_dump($_FILES['uploadPFP']);
	if ($_FILES['uploadPFP']['error']!= UPLOAD_ERR_OK) {
		echo 'upload error';
		exit();
	}
	$finfo = new finfo (FILEINFO_MIME_TYPE);
	$filetype = $finfo->file($_FILES['uploadPFP']['tmp_name']);
	if ($filetype !="image/jpeg")
	{
		echo 'not the right image type';
		exit();
	}
	else {
		$upload_location ='uploads/';
		$filename = $upload_location.$_SESSION['user_id'].'_originalPFP.jpeg';
		if (move_uploaded_file($_FILES['uploadPFP']['tmp_name'], $filename)) {
			echo 'Image moved to destination successful';
		}
		else {
			echo 'Error moving image to folder';
			exit();
		}
	}
	$image = imagecreatefromjpeg ($filename);
	$width = imagesx ($image);
	$height = imagesx ($image);
	$thumbHeight = 175;
	$thumbWidth = floor ($width * ($thumbHeight/$height));
	$thumbnail = imagecreatetruecolor ($thumbWidth, $thumbHeight);
	imagecopyresampled ($thumbnail, $image, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width,
	$height);
	$thumbnailName = $upload_location.$_SESSION['user_id'].'_pfp.jpeg';
	imagejpeg ($thumbnail, $thumbnailName );


}		
?>