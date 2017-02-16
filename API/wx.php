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
    
    $creator = $_SESSION['usrid'];//抽奖创建者

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

        $if = "未发放";
        $type = "网薪";
        $stmt = $DBH->prepare("SELECT student, award from {$creator} WHERE if_wx = ? AND type = ?");
        $stmt->execute([$if ,$type]);

        while($res = $stmt->fetch(PDO::FETCH_ASSOC)){

            $wx = $res['award'];
            $curl = curl_init();//抽奖创建者支付网薪
            curl_setopt($curl, CURLOPT_URL, "https://openapi.yiban.cn/pay/yb_wx?access_token=".$_SESSION['token']."&pay=".$wx);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($curl);//data是返回的数组
            curl_close($curl);

            if(strcmp("success", $data['status'])==0){
                //支付给获奖者

                $usr = $res['student'];
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://openapi.yiban.cn/school/award_wx?access_token=".$_SESSION['token']."&yb_userid=".$usr."&award=".$wx);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $data2 = curl_exec($curl);
                curl_close($curl);

            }

            $if = "已发放";
            $stmt2 = $DBH->prepare("UPDATE {$creator} set if_wx = ? WHERE student = ? ");//更改网薪状态
            $stmt2->execute([$if, $res['student']]);

        }

    } catch (PDOException $e) {
        print('{"result":"Database Error"}');
        die();
    }

?>