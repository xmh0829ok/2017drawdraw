<?php
require("classes/yb-globals.inc.php");
    
    session_start();
    
    if(!isset($_SESSION['token'])){
        exit('illegal access!');
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
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/draw.js"></script>
</head>
<body id="drawPage">
	<img src="./img/bgPic.png" id="bgPic">
	<img src="./img/machine.png" id="machine">
	<div class="redBox"></div>
	<div class="deepredBox"></div>
	<div class="drawWindow"></div>
	<img src="./img/arrow.png" id="arrowLeft">
	<img src="./img/arrow.png" id="arrowRight">
	<img src="./img/button.png" id="buttonX">
	<div class="redCover"></div>
	<div class="visibleWindow">
		<div class="drawBar">
			<div class="award" id="award1">
			</div>
			<div class="award" id="award2">
			</div>
			<div class="award" id="award3">
			</div>
			<div class="award" id="award4">
			</div>
			<div class="award" id="award5">
			</div>
			<div class="award" id="award6">
			</div>
			<div class="award" id="award7">
			</div>
			<div class="award" id="award8">
			</div>
			<div class="award" id="award9">
			</div>
			<div class="award" id="award10">
			</div>
			<div class="award">
				<p>终极大奖</p>
			</div>
			<div class="award">
				<p>五百万</p>
			</div>
			<div class="award">
				<p>终极大奖</p>
			</div>
			<div class="award">
				<p>学区房</p>
			</div>
			<div class="award">
				<p>龙珠</p>
			</div>
			<div class="award">
				<p>绝世武功</p>
			</div>
			<div class="award">
				<p>厉害的对手</p>
			</div>
			<div class="award">
				<p>1000网薪</p>
			</div>
			<div class="award">
				<p>2000网薪</p>
			</div>
			<div class="award">
				<p>终极大奖</p>
			</div>
			</div>
		</div>
	</div>
	<div class="myModal">
		<div class="myConfirm">
			<p>根据管理员的设置，你将支付5网薪获得一次抽奖机会</p>
			<button class="confirmButton" id="confirmForConfirm">确认</button>
			<button class="cancelButton" id="cancel">取消</button>
		</div>
		<div class="myAlert">
			<button class="confirmButton" id="confirmForAlert">确认</button>
		</div>
	</div>
	<h1 class="introHead">抽奖介绍</h1>
	<div class="intro">
	</div>
	<div class="buttonGroup">
		<button class="confirmButton" id="checkOut">得奖记录</button>
		<button class="confirmButton" id="return">返回</button>
	</div>
	
</body>
</html>