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
    $name = $_POST['name'];
    $value = $_POST['value'];

    try {
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $DBH->beginTransaction();

        $stmt = $DBH->prepare("INSERT into hhh ( userid ) values(?);");
        $stmt->execute([$_SESSION['usrid']]);

        $stmt = $DBH->prepare("SELECT * from users WHERE username = ? ;");
        $stmt->execute([$_SESSION['usrid']]);

        if ($stmt->rowCount() > 0){

            while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($res['if_create'] == 1){
                    $sql = "drop TABLE ".$username;
                    $DBH->exec($sql);
                }
            }
            
            //建表操作
            $sql = "CREATE TABLE ".$username." (
                ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                student varchar(150),
                type varchar(5),
                award varchar(300),
                if_wx varchar(5)
            )";
            $DBH->exec($sql);

            $if = 1;//修改if_create的值
            $stmt = $DBH->prepare("UPDATE users set if_create = ? WHERE username = ? ;");
            $stmt->execute([$if, $_SESSION['usrid']]);

            //插入操作
            $stmt = $DBH->prepare('INSERT INTO `award` (`username`, `type1`, `award1`, `type2`, `award2`, `type3`, `award3`, `type4`, `award4`, `type5`, `award5`, 
            	`type6`, `award6`, `type7`, `award7`, `type8`, `award8`, `type9`, `award9`, `type10`, `award10`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([$username, $value[0], $name[0], $value[1], $name[1], $value[2], $name[2], $value[3], $name[3],
                $value[4], $name[4],  $value[5], $name[5],  $value[6], $name[6], $value[7], $name[7],
                $value[8], $name[8],  $value[9], $name[9]]);
            if ($stmt->rowCount() > 0)
                print('{"result":"Insert Succeeded"}');
        }
        else 
            print('{"result":"No Authorization"}');

        $DBH->commit();
        
    } catch (PDOException $e) {
        print('{"result":"Database Error"}');
        die();
    }

?>