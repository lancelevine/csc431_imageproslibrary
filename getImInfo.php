<?php
session_start();
if(!isset($_SESSION['username'])) {
header( "refresh:2;url=login.php" );
die( "Not logged in; redirecting.");
}
$userName=$_SESSION['username'];

$path=$_POST['path'];
$_SESSION['imPath']=$path;
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

 $result = mysql_query("SELECT name, dateTaken, photographer, locationTaken, peopleInPhoto, sharing, tags, username FROM Images WHERE `url` = '".$path."' ")
  or die("Could not select accountN");
//fetch tha data from the database

if ((strpos($path, '/'.$userName.'/')!=null)){
 

while ($row = mysql_fetch_array($result)) {
//echo $row{'name'}."\n";
$infos[0]=$row{'name'};
$infos[1]= $row{'dateTaken'};
$infos[2]= $row{'photographer'};
$infos[3]= $row{'locationTaken'};
$infos[4]= $row{'peopleInPhoto'};
$infos[5]= $row{'sharing'};
$infos[6]= $row{'tags'};

		}	
echo json_encode($infos); }
?>