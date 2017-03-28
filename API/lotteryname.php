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
    $realname = $_SESSION['name'];

    try {
        $DBH = new PDO("mysql:host=$db_host;dbname=$db_database;", $db_user, $db_password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOExveption $e) {
        print('{"result":"Database Fatal"}');
        die();
    }

    if ($_SERVER['REQUEST_METHOD']=="GET") {
        foreach($DBH->query("SELECT username, realname, lotteryname FROM award ", PDO::FETCH_NAMED) as $result) {
            print(json_encode($result, JSON_UNESCAPED_UNICODE));
        }
        die();
    }

?>