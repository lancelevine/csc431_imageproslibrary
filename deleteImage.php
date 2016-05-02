<?php
session_start();
if(!isset($_SESSION['username'])) {
header( "refresh:2;url=login.php" );
die( "Not logged in; redirecting.");
}
$userName=$_SESSION['username'];

$path=$_POST['path'];


//$code='ysi';
//$account='ysi';

$username = "imagepr2_admin";
$password = "1234";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL");
  
$selected = mysql_select_db("imagepr2_mainDB",$dbhandle) 
  or die("Could not select examples");
  
  //echo $path."\n";

if ((strpos($path, '/'.$userName.'/')!=null)){
 
 mysql_query("DELETE FROM Images WHERE `url` = '".$path."' ")
  or die("Could not DELETE image");


$prefix= substr($path,0,strrpos($path ,'/')+1);

$index=(int) substr($path,strlen($prefix),strlen($path)-strlen($prefix)-strlen('.jpg'));
//echo $index.'\n';

unlink($path);

while (file_exists($prefix.(++$index).'.jpg')){
	$oldurl=$prefix.($index).'.jpg';
	$newurl=$prefix.(--$index).'.jpg';
	rename($oldurl, $newurl);

mysql_query("UPDATE Images SET `url`='".$newurl."' WHERE `url` = '".$oldurl."' ")
  or die("UPDATE FROM Images SET `url`='".$newurl."' WHERE `url` = '".$oldurl."' ");
	//echo $prefix.($index).'.jpg'."\n";
	++$index;
}}
?>