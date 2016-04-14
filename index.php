<!doctype html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title>Image Processing Library</title>
<div id="logo">
<h1>Image Processing Library</h1>
<div id="links"></div>
</div>
<link rel="stylesheet" type="text/css" href="style/style.css" />
<link rel="stylesheet" type="text/css" href="style/colour.css" />
<link rel="stylesheet" type="text/css" href="style/image_viewer.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="script.js" type="text/javascript"></script>
</head>
<body>

<div id ="phpContent">

<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header( "refresh:2;url=login.php" );
        die( "Not logged in; redirecting.");
    }
    
    ?>
</div>


<div id="menu">
<ul>
<!--<li><a class="selected" href="#">Home</a></li>
<li><a href="about.php">Search</a></li>
<li><a href="contact.php">Uploaded Images</a></li>-->
</ul>
<div id="colours"></div>
</div>
<div id="site_content">
<div id="side_menu">
<div class="side_menu_item"> <a class="selected" href="#"><img src="style/series_one.jpg" alt="" width="142" height="50" /></a> <span class="info">Collection One</span> </div>
<div class="side_menu_item"> <a href="#"><img src="style/series_two.jpg" alt="" width="142" height="50" /></a> <span class="info">Collection Two</span> </div>
<div class="side_menu_item"> <a href="#"><img src="style/series_three.jpg" alt="" width="142" height="50" /></a> <span class="info">Collection Three</span> </div>
<div class="side_menu_item"> <a href="#"><img src="style/series_four.jpg" alt="" width="142" height="50" /></a> <span class="info">Collection Four</span> </div>
<div class="side_menu_item"> <a href="#"><img src="style/series_five.jpg" alt="" width="142" height="50" /></a> <span class="info">Collection Five</span> </div>
</div>
<div id="content">
<h1>Collection One Photographs<span class="sub">[click on thumbnails to view]</span></h1>
<form action="upload.php" method="post" enctype="multipart/form-data">
Select image to upload:
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Upload Image" name="submit">
</form>
<div id="gallery"> <img id="mainimg"/> <em id="thumbs"> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> <a class="thumbnail"><img alt="" /></a> </em> </div>
<a value="download" id="downloadbutton" download><button>Download</button></a>
</div>
</div>

<!--Testing Share-->
<form action="share.php" method="post" enctype="multipart/form-data">
Select user with which to share the active collection:
<input type="user" name="recvUser" id="recvUser">
<input type="submit" value="Share Collection" name="submit">
</form>
<!--/Testing Share-->

<table>
<form action="logout.php" method="POST">
<div class="marg">
<tr><td><input class="buttonstyle" type="submit" name="logout" value="logout" /></td></tr>
</div>

</form>
</table>

</body>
</html>