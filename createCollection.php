<!doctype html>

<html>

<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/colour_blue.css" />
<link rel="stylesheet" type="text/css" href="style/image_viewer.css" />

<div id="logo">
<h1>Image Processing Library</h1>
</div>
<div id ="phpContent">


<?php
session_start();
header( "refresh:2; url=index.php" );

//Info for the new directory
$currUser = $_SESSION['username'];
$newColl;


//Get next available collection
$counter=1;

while(file_exists('./images/users/'.$currUser.'/'.$counter)){
  $counter++;
}
$newColl = $counter; 

//New Collection Directory
$newPath = './images/users/'.$currUser.'/'.$newColl;

mkdir($newPath, 0700, true);

?>
</div>
</html>