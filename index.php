<?php
	/**
	 * 轻应用通过IFrame方式在易班开放平台中接入显示
	 * 所以不能直接在浏览器打开本地地址进入浏览
	 * 而是打开易班管理中心中对应站内应用的网站地址进行浏览
	 *
	 * SDK中的方式会检测是否有易班开放平台提供的参数，若无则会抛出异常
	 */


	/**
	 * 包含SDK
	 */
	require("classes/yb-globals.inc.php");
	
	session_start();

	
	/**
	 * 配置文件
	 */
	include('config.php');

	/**
	 * 站内应用需要使用AppID、AppSecret和应用入口地址初始化
	 *
	 */
	$api = YBOpenApi::getInstance()->init($cfg['x']['appID'], $cfg['x']['appSecret'], $cfg['x']['callback']);
	if (!isset($_SESSION['token'])) {
		try
		{
			/**
			 * 调用perform()验证授权，若未授权会自动重定向到授权页面
			 * 授权成功返回的数组中包含用户基本信息及访问令牌信息
			 */
			$info = $api->getFrameUtil()->perform();
            $userInfo = $api->getUser()->other();
				// 可以输出info数组查看
								// 访问令牌[visit_oauth][access_token]
			$_SESSION['token']	= $info['visit_oauth']['access_token'];
			$_SESSION['usrid']	= $info['visit_user']['userid'];
			$_SESSION['name']	= $info['visit_user']['username'];
		}
		catch (YBException $ex)
		{
			echo $ex->getMessage();
		}		
	}
	
	$api = YBOpenApi::getInstance()->bind($_SESSION['token']);
	$token_info = $api->getAuthorize()->query();
	
	if ($token_info['status'] === "404")
	{
		try
		{
			/**
			 * 调用perform()验证授权，若未授权会自动重定向到授权页面
			 * 授权成功返回的数组中包含用户基本信息及访问令牌信息
			 */
			$info = $api->getFrameUtil()->perform();
			# print_r($info);	// 可以输出info数组查看
								// 访问令牌[visit_oauth][access_token]
			$_SESSION['token']	= $info['visit_oauth']['access_token'];
			$_SESSION['usrid']	= $info['visit_user']['userid'];
			$_SESSION['name']	= $info['visit_user']['username'];
		}
		catch (YBException $ex)
		{
			echo $ex->getMessage();
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>北邮易抽奖</title>
	<link href="css/materialize.min.css" rel="stylesheet" type="text/css">
	<link href="css/draw.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/welcome.js"></script>
</head>
<body id="welcomePage">
	<div id="headBox">
		<h1 class="welcomeWord animated bounceInDown headFont" id="welcomeWords1">
			欢迎来到澳门赌场
		</h1>
	</div>
	<canvas id="welcome"></canvas>
	<div class="checkContainer">
	</div>
	<div class="myModal">
		<div class="myAlert">
			<p>对不起，您没有此抽奖的参加权限</p>
			<button class="confirmButton" id="confirmForAlert">确认</button>
		</div>
	</div>
</body>
</html>