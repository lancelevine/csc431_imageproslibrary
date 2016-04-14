<?php
session_start();
$username = $_SESSION['username'];
$collection = $_SESSION['coll']; //the collection to upload to; carried over from index.php?
$target_dir = "images/users/".$username."/".$collection."/";

$i=1;

while(file_exists($target_dir.$i.".jpg") == 1){
  $i++;
}

header( "refresh:2; url=index.php" );

$target_file = $target_dir . $i . ".jpg";// . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        print "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        print "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    print "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    print "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    print "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    print "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        print "The file has been uploaded to ".$target_file.".";
    } else {
        print "Sorry, there was an error uploading your file.";
    }
}
?>