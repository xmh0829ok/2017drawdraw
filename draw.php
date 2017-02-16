<?php
require("classes/yb-globals.inc.php");
    
    session_start();
    
    if(!isset($_SESSION['token'])){
        exit('illegal access!');
     }
	 
?>
