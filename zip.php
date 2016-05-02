<?php
try {
	$username = $_POST["username"];
	$coll = $_POST["coll"];
	echo $username;
	$file = "./images/users/".$username."/".$coll."/collection.zip";
    	$a = new PharData($file);

     	$i = 0;
     	$target_dir = "images/users/".$username."/".$coll."/";

	$i=1;

	while(file_exists($target_dir.$i.".jpg") == 1){
	    	$a->addFile("./images/users/".$username."/".$coll."/".$i.".jpg", $i.".jpg");
  		$i++;
	}
    	readfile($file);
} catch (Exception $e) {
    // handle errors here
}
?>