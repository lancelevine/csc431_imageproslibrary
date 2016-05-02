<?php
session_start();
$_SESSION['coll'] = 1;
if(!isset($_SESSION['username'])) {
header( "refresh:2;url=login.php" );
die( "Not logged in; redirecting.");
}
$userName=$_SESSION['username'];
echo $userName." \n";

$path=$_SESSION['imPath'];

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
  
  
 $result = mysql_query("UPDATE Images SET name='".$name."', dateTaken='".$dateTaken."', photographer='".$photographer."', locationTaken='".$locationTaken."', peopleInPhoto='".$peopleInPhoto."', sharing='".$sharing."', tags='".$tags."'  WHERE `url` = '".$path."' AND username='".$userName."'")
  or die("UPDATE Images SET name='".$name."', dateTaken='".$dateTaken."', photographer='".$photographer."', locationTaken='".$locationTaken."', peopleInPhoto='".$peopleInPhoto."', sharing='".$sharing."', tags='".$tags."'  WHERE `url` = '".$path."' AND , username='".$userName."'");
  
?>