<!doctype html>

<html>
<!--Edits start here*-->
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/colour_blue.css" />
<link rel="stylesheet" type="text/css" href="style/image_viewer.css" />

<div id="logo">
<h1>Image Processing Library</h1>
</div>
<div id ="phpContent">

<meta http-equiv="refresh" content="5; url=login.php">
<!--Edits end here-->

<?php
session_start();
unset($_SESSION['username']);
header( "refresh:2; url=login.php" );

die("you have successfully logged out.");

?>
</div>
</html>
