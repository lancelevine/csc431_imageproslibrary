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

//Info for directory to share
$currUser = $_SESSION['username'];
$currColl = $_SESSION['coll'];
//Info for target directory
$recvUser = $_POST['recvUser'];
$recvColl;


//Get next available collection
$counter=1;

while(file_exists('./images/users/'.$recvUser.'/'.$counter)){
  $counter++;
}
$recvColl = $counter; 

//Directory to be shared
$target = './images/users/'.$currUser.'/'.$currColl;
//Link location
$link = './images/users/'.$recvUser.'/'.$recvColl;

//print "Target = ".$target;
//print "Link = ".$link;

mkdir($link, 0700, true);

//Copy the directory
//copy($target,$link);


//Copy every file in the directory
$index = 1;
while(file_exists($target.'/'.$index.'.jpg')){
	copy($target.'/'.$index.'.jpg', $link.'/'.$index.'.jpg');
	//print "Target = ".$target.'/'.$index.'.jpg';
	//print “Dest = ".$link.'/'.$index.'.jpg';
	$index++;
}

//Trying with a symbolic link
//if(!symlink($target, $link)){
//die("Error! Could not share!");}

print "Collection ".$collection." shared with ".$recvUser."!";

?>
</div>
</html>