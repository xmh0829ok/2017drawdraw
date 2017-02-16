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

    //value值为1代表网薪，2代表自定义用品 ,name存放奖项内容
    $a = $_POST['a'];

    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->beginTransaction();

        $stmt = $DBH->prepare("SELECT * from users WHERE username = ? ;");
        $stmt->execute([$_SESSION['usrid']]);

        if ($stmt->rowCount() > 0){
            //建表操作
            $sql = "CREATE TABLE ".$username." (
                ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                student varchar(150),
                type int,
                award varchar(300)
            )";
            $DBH->exec($sql);
            //插入操作
            $stmt = $DBH->prepare('INSERT INTO `award` (`username`, `type1`, `award1`, `type2`, `award2`, `type3`, `award3`, `type4`, `award4`, `type5`, `award5`, 
            	`type6`, `award6`, `type7`, `award7`, `type8`, `award8`, `type9`, `award9`, `type10`, `award10`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$username, $a['value'][0], $a['name'][0], $a['value'][1], $a['name'][1], $a['value'][2], $a['name'][2], $a['value'][3], $a['name'][3],
                $a['value'][4], $a['name'][4],  $a['value'][5], $a['name'][5],  $a['value'][6], $a['name'][6],  $a['value'][7], $a['name'][7],
                $a['value'][8], $a['name'][8],  $a['value'][9], $a['name'][9]]);
            if ($stmt->rowCount() > 0)
                print('{"result":"Insert Succeeded"}');
        }
        else 
            print('{"result":"No Authorization"}');

    } catch (PDOException $e) {
        print('{"result":"Database Error"}');
        die();
    }

?>