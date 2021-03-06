<?php
     /**
	 * 包含SDK
	 */
   // header('Content-type:text/json');

	require("../classes/yb-globals.inc.php");
    
    session_start();
    
    if(!isset($_SESSION['token'])){
        print('{"result":"Forbidden"}');
        die();
    }
    
    include_once "db_config.php";
    
    $yibanid = $_SESSION['usrid'];//当前抽奖人
    $creator = $_POST['userName'];//抽奖创建者
    //奖项编号
    //生成随机数
    $number = mt_rand(0,9);
    $this_type = "type".$number;
    $this_award = "award".$number;


    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://openapi.yiban.cn/user/verify_me?access_token=".$_SESSION['token']);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);//data是返回的数组
    curl_close($curl);
    $abc = json_decode($data,true);

    $realname = $abc['info']['yb_realname'];

    try {
        $DBH = new PDO("mysql:host=$db_host;dbname=$db_database;", $db_user, $db_password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    } catch (PDOExveption $e) {
        print('{"result":"Database Fatal"}');
        die();
    }


    try {
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $DBH->beginTransaction();

        $stmt = $DBH->prepare("SELECT {$this_type}, {$this_award} from award WHERE username = ? ");
        $stmt->execute([$creator]);//查询奖项
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        $award = $res["$this_award"];

        if(strcmp($res["$this_type"], "1")==0){//网薪
            $type = "网薪";
        }
        else{//自定义
            $type = "自定义";
        }
        
        $if = "未发放";
        $tablename = "yiban".$creator;
        $stmt = $DBH->prepare("INSERT into {$tablename} (student, stuentyibanID, type, award, if_wx) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$realname, $yibanid, $type, $award, $if]);

        $DBH->commit();
        //$str = array("randnumber"=>7);
        //print(json_encode($str, JSON_UNESCAPED_UNICODE));
        print('{"randnumber":"'.$number.'"}');

    } catch (PDOException $e) {
        print_r($e);
        print('{"result":"Database Error"}');
        die();
    }

?>