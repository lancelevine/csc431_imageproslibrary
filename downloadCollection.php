<?php
try {session_start();
$userName = $_SESSION['username'];
	$file=$_SERVER['QUERY_STRING'];

if ((strpos($file, '/'.$userName.'/')!=null)){
    if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_end_clean();
    readfile($file);
    exit;
}
}


} catch (Exception $e) {
    // handle errors here
}
?>

