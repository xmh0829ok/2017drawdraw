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

    try {
        $DBH = new PDO("mysql:host=$db_host;dbname=$db_database;", $db_user, $db_password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOExveption $e) {
        print('{"result":"Database Fatal"}');
        die();
    }

    if ($_SERVER['REQUEST_METHOD']=="GET") {

        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(isset($_GET['userName'])){
            $creator = $_GET['userName'];
        }else{
            $creator = $_SESSION['usrid'];
        }
        

        $stmt = $DBH->prepare("SELECT state, realname, lotteryname, type1, award1, type2, award2, type3, award3, type4, award4, type5, award5, type6, award6, type7, award7, type8, award8, type9, award9, type10, award10 FROM award WHERE username = ? ;");
        $stmt->execute([$creator]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        print(json_encode($result, JSON_UNESCAPED_UNICODE));

        die();
    }

?>