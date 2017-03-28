<?php
     /**
	 * 包含SDK
	 */
	require("../classes/yb-globals.inc.php");
    
    session_start();
    
    if(!isset($_SESSION['token'])){
        print('{"result":"Forbidden"}');
        die();
    }
    
    include_once "db_config.php";
    
    $username = $_SESSION['usrid'];

    try {
        $DBH = new PDO("mysql:host=$db_host;dbname=$db_database;", $db_user, $db_password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOExveption $e) {
        print('{"result":"Database Fatal"}');
        die();
    }

    try {
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $DBH->prepare("SELECT * from users WHERE username = ? ;");
        $stmt->execute([$_SESSION['usrid']]);

        if ($stmt->rowCount() > 0){
        	print('{"result":"1"}');
            die();
        }else{
            print('{"result":"0"}');
            die();
        }
        
    } catch (PDOException $e) {
        print('{"result":"Database Error"}');
        die();
    }    

?>