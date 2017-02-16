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
	<title>北邮易抽抽</title>
	<link href="css/materialize.min.css" rel="stylesheet" type="text/css">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/myjs.js"></script>
</head>
<body>
	<nav>
		<div class="orange darken-1 nav-wrapper">
			<a href="#" data-activates="nav-mobile" class="button-collapse"><img id="logo" src="img/menu.png"></a>
			<a href="" class="brand-logo center">北邮易抽奖</a>
			<ul id="nav-mobile" class="side-nav orange">
				<li><a class="navfont white-text" href="create.html">创建抽奖</a></li>
				<li><a class="navfont white-text" href="manage.html">管理抽奖</a></li>
				<li><a class="navfont white-text" href="">参加抽奖</a></li>
			</ul>
		</div>
	</nav>
	<div class="container z-depth-1 maincont">
		<div class="container instrucont center">
			<h6 class="">亲爱的用户xxx，您目前已发布的抽奖如下</h6>
			<div class="container z-depth-1 awardbox left-align">
				<p>奖项1:</p>
				<p>奖项2:</p>
				<p>奖项3:</p>
				<p>奖项4:</p>
				<p>奖项5:</p>
				<p>奖项6:</p>
				<p>奖项7:</p>
				<p>奖项8:</p>
				<p>奖项9:</p>
				<p>奖项10:</p>
				<p>抽奖状态：开启中</p>
			</div>
			<div class="functionbox center">
				<a class="waves-effect waves-light btn orange darken-1" id="change">修改抽奖</a>
				<a class="waves-effect waves-light btn orange darken-1" id="pause">暂停抽奖</a>
				<a class="waves-effect waves-light btn orange darken-1" id="check" style="margin-top:10px;">查看名单</a>
				<a class="waves-effect waves-light btn orange darken-1" id="share" style="margin-top:10px;">分享抽奖</a>
			</div>
		</div>
	</div>
	<div class="mymodal" id="checkmodal">
		<div class="container z-depth-1 checkbox">
			<div class="row luckygroup">
				<div class="col s6">
					<p class="luckyone">中奖用户：</p>
					<a class="luckyone">xxx</a>
				</div>
				<div class="col s6">
					<p class="luckyone">奖项：网薪</p>
				</div>
				<div class="col s12">
					<p class="luckyone">中奖时间：</p>
				</div>
			</div>
			<a class="waves-effect waves-light btn orange darken-1" id="pullout" style="margin-top:10px;">导出名单</a>
		</div>
	</div>
</body>
</html>