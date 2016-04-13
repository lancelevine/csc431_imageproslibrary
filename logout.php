<?php
session_start();
header("refresh:2;url=login.php");
?>

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

<!--Edits end here-->

<?php
//session_start();
//header( "refresh:2;url=login.php" );
unset($_SESSION['username']);

die("you have successfully logged out.");

?>
</div>
</html>
