<?php
session_start();
if(!isset($_SESSION['username'])) {
header( "refresh:0.5;url=login.php" );
die( "Not logged in; redirecting.");
}
$userName = $_SESSION['username'];

$value=$_SERVER['QUERY_STRING'];
//$image = imagecreatetruecolor(400,200);
//$path="images/users/".$value."/"."1/1.jpg";
$path=$value;

if ((strpos($path, '/'.$userName.'/')!=null)){
 

$image = imagecreatefromstring(file_get_contents($path));
// process image

if ($image==0){
        header('HTTP/1.1 500 Internal Server Error');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
}

// rendering image
header("Content-type: image/jpeg");
imagejpeg($image);

}

?>