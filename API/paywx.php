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
    $wx = 5;

    $curl = curl_init();//支付网薪
    curl_setopt($curl, CURLOPT_URL, "https://openapi.yiban.cn/pay/yb_wx?access_token=".$_SESSION['token']."&pay=".$wx);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);//data是返回的数组
    curl_close($curl);

?>
