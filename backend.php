<?php
    // do any authentication first, then add POST variable to session
    session_start();
    
    $_SESSION['coll'] = $_POST['coll'];
?>
