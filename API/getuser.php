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
    $creator = $_SESSION['usrid'];//当前抽奖人

    try {
        $DBH = new PDO("mysql:host=$db_host;dbname=$db_database;", $db_user, $db_password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOExveption $e) {
        print('{"result":"Database Fatal"');
        die();
    }

    if ($_SERVER['REQUEST_METHOD']=="GET") {
        foreach($dbh->query("SELECT student, type, award, if_wx FROM {$creator} ", PDO::FETCH_NAMED) as $result) {
            print(json_encode($result, JSON_UNESCAPED_UNICODE));
        }
        die();
    }

    //if_wx表示网薪是否已经发放

?>