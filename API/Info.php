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
    $creator = $_SESSION['usrid'];//当前管理员
    $tablename = "yiban".$creator;

    try {
        $DBH = new PDO("mysql:host=$db_host;dbname=$db_database;", $db_user, $db_password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOExveption $e) {
        print('{"result":"Database Fatal"}');
        die();
    }

    if ($_SERVER['REQUEST_METHOD']=="GET") {
        $results = array();
        foreach($DBH->query("SELECT student, stuentyibanID, type, award, if_wx FROM {$tablename} ", PDO::FETCH_ASSOC) as $result) {
            $results[] = $result;
        }
        print(json_encode($results, JSON_UNESCAPED_UNICODE));
        die();
    }else if ($_SERVER['REQUEST_METHOD']=="POST") {
        $creator = $_POST['userName'];
        $tablename = "yiban".$creator;
        $results = array();
        foreach($DBH->query("SELECT student, type, award FROM {$tablename} ", PDO::FETCH_ASSOC) as $result) {
            $results[] = $result;
        }
        print(json_encode($results, JSON_UNESCAPED_UNICODE));
        die();
    }

    //if_wx表示网薪是否已经发放

?>