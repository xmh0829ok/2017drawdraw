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

    
    try {
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        if($_SERVER['REQUEST_METHOD']=="GET"){

            $stmt = $DBH->prepare("UPDATE award SET state = ? WHERE username = ? ;");
            $state = "close";
            $stmt->execute([$state, $username]);
            print('{"result":"yes"}');
            die();

        }else{
            
            $DBH->beginTransaction();
            //value值为1代表网薪，2代表自定义用品 ,name存放奖项内容
            $name = $_POST['name'];
            $value = $_POST['value'];
            $lotteryname = $_POST['lotteryname'];
            $autho = $_POST['autho'];

            $academys = array("全校范围","信息与通信工程学院","电子工程学院","计算机学院","自动化学院","软件学院","现代邮政学院","网络空间安全学院","光电信息学院","理学院","经济管理学院","公共管理学院","人文学院","马克思主义学院","国际学院","网络教育学院","继续教育学院","民族教育学院","网络技术研究院","信息光子学与光通信研究院","叶培大学院");

            $authority = "";
            $first = 1;
            for($i = 0; $i < 21;$i++){
                if($autho[$i]==1&&$first==1){
                    $authority = $authority.$academys[$i];
                    $first = 0;
                }
                else if($autho[$i]==1){
                    $authority = $authority."、".$academys[$i];
                    $first = 0;
                }
            }
            if(strcmp($authority,"")==0){
                $authority = "全校范围";
            }
        
            $stmt = $DBH->prepare("INSERT into hhh ( userid ) values(?);");
            $stmt->execute([$_SESSION['usrid']]);

            $stmt = $DBH->prepare("SELECT * from users WHERE username = ? ;");
            $stmt->execute([$_SESSION['usrid']]);

           if ($stmt->rowCount() > 0){

             while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
                if($res['if_create'] == 1){
                    $sql = "drop TABLE yiban".$username;
                    $DBH->exec($sql);

                    $stmt2 = $DBH->prepare("DELETE from award where username = ? ;");
                    $stmt2 ->bindParam(1,$username);
                    $stmt2 ->execute();
                }
            }
         //   var_dump($name,$value);
          
             //建表操作
            $sql = "CREATE TABLE yiban".$username." (
                ID INT(6) AUTO_INCREMENT PRIMARY KEY, 
                student varchar(150),
                stuentyibanID varchar(150),
                type varchar(5),
                award varchar(300),
                if_wx varchar(5)
            )";
            $createtable=$DBH->prepare($sql);
            $createtable->execute();
            //print_r($createtable->errorInfo());

            $if = 1;//修改if_create的值
            $stmt = $DBH->prepare("UPDATE users set if_create = ? WHERE `username` = ? ;");
            $stmt ->bindParam(1, $if);
            $stmt ->bindParam(2, $username);
            $stmt->execute();
            //print_r($stmt->errorInfo());

           //插入操作
            $state1 = "open";
            $stmt = $DBH->prepare("INSERT into award(username, state, realname, lotteryname, authority, type1, award1, type2, award2, type3, award3, type4, award4, type5, award5, type6, award6, type7, award7, type8, award8, type9, award9, type10, award10 ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            $stmt->execute([$username, $state1, $realname, $lotteryname, $authority, $value[0], $name[0], $value[1], $name[1], $value[2], $name[2], $value[3], $name[3], $value[4], $name[4],  $value[5], $name[5],  $value[6], $name[6], $value[7], $name[7],
                $value[8], $name[8],  $value[9], $name[9]]);
            if ($stmt->rowCount() > 0)
                echo "success";
            }
            else {
                echo "No Authorization";
            }

            $DBH->commit();



        }//对应else

        
    } catch (PDOException $e) {
        print_r($e);
        print('{"result":"Database Error"}');
        die();
    }

?>