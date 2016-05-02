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
<!--<script src="script.js" type="text/javascript"></script>-->
</head>
<body>

<div id ="phpContent">

<?php
session_start();
$_SESSION['coll'] = 1;
if(!isset($_SESSION['username'])) {
header( "refresh:2;url=login.php" );
die( "Not logged in; redirecting.");
}
$userName=$_SESSION['username'];
echo $userName." \n";


$name=$_POST['name'];
$dateTaken=$_POST['date'];
$photographer=$_POST['photographer'];
$locationTaken=$_POST['location'];
$peopleInPhoto=$_POST['people'];
$sharing=$_POST['sharing'];
$tags=$_POST['tag'];
//$code='ysi';
//$account='ysi';

$valid=0;

$username = "imagepr2_admin";
$password = "1234";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
  
$selected = mysql_select_db("imagepr2_mainDB",$dbhandle) 
  or die("Could not select examples");

  
   $result = mysql_query("SELECT name, dateTaken, photographer, locationTaken, peopleInPhoto, sharing, tags, url, username FROM Images")
  or die("Could not select accountN");
//fetch tha data from the database


$i=0;

while ($row = mysql_fetch_array($result)) {
	//echo $row{'username'}." ".$username." \n";
	if ($userName==$row{'username'}){
		if (($name==NULL||$name==$row{'name'})&&($dateTaken==NULL||$dateTaken==$row{'dateTaken'})&&($photographer==NULL||$photographer==$row{'photographer'})&&($locationTaken==NULL||$locationTaken==$row{'locationTaken'})&&($peopleInPhoto==NULL||$peopleInPhoto==$row{'peopleInPhoto'})&&($sharing==NULL||$sharing==$row{'sharing'})&&($tags==NULL||$tags==$row{'tags'})) {
			$results[$i]=$row{'url'};
			
			$i++;
		}}
}
		
		
json_encode($results); 
$_SESSION["results"] = $results;

 header( "refresh:0.9;url=index.php" );
  die("  find ".$i." results\n");
  
?>

</body>
</html>