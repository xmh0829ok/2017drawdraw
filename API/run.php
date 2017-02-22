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
    
    $username = $_SESSION['usrid'];//当前抽奖人
    $creator = $_POST['creator'];//抽奖创建者
    $number = $_POST['number'];//奖项编号
    $this_type = "type".$number;
    $this_award = "award".$number;

    try {
        $DBH = new PDO("mysql:host=$db_host;dbname=$db_database;", $db_user, $db_password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOExveption $e) {
        print('{"result":"Database Fatal"}');
        die();
    }


    try {
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dbh->beginTransaction();

        $stmt = $DBH->prepare("SELECT {$this_type}, {$this_award} from award WHERE username = ? ");
        $stmt->execute([$creator]);//查询奖项
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $award = $res["$this_award"];

        if(strcmp($res["$this_type"], "1")==0){//网薪
            $type = "网薪";
        }
        else{//自定义
            $type = "自定义"；
        }
        
        $if = "未发放";
        $stmt = $DBH->prepare("INSERT into {$creator} (student, type, award, if_wx) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $type, $award, $if]);

        $dbh->commit();
        
    } catch (PDOException $e) {
        print('{"result":"Database Error"}');
        die();
    }

?>