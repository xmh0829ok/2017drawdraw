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
    
    $nowuser = $_SESSION['usrid'];

    try {
        $DBH = new PDO("mysql:host=$db_host;dbname=$db_database;", $db_user, $db_password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOExveption $e) {
        print('{"result":"Database Fatal"}');
        die();
    }

    try {
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $creator = $_POST['thisUserName'];
        $stmt = $DBH->prepare("SELECT authority from award WHERE username = ? ;");
        $stmt->execute([$creator]);

        $allrows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($allrows as $row){
            $authority = $row['authority'];
        }
        if(strcmp($authority,"全校范围")!=0){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, "https://openapi.yiban.cn/user/verify_me?access_token=".$_SESSION['token']);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($curl);//data是返回的数组
            curl_close($curl);
            $abc = json_decode($data,true);
            $studentid = $abc['info']['yb_studentid'];

            $stmt = $DBH->prepare("SELECT academy from studentInfo WHERE BUPT_studentid = ? ;");
            $stmt->execute([$studentid]);
            $ress = $stmt->fetch(PDO::FETCH_ASSOC);
            $academy = $ress['academy'];

            if(strpos($authority,$academy)==FALSE){
                print('{"result":"0"}');
                die();
            }else{
                print('{"result":"1"}');
                die();
            }

        }else{
            print('{"result":"1"}');
            die();
        }

    } catch (PDOException $e) {
        print('{"result":"Database Error"}');
        die();
    }    

?>