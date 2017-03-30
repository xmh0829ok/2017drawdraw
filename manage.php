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
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="js/modify.js"></script>
</head>
<body>
	<nav>
		<div class="orange darken-1 nav-wrapper">
			<a href="#" data-activates="nav-mobile" class="button-collapse"><img id="logo" src="img/menu.png"></a>
			<a href="" class="brand-logo center">北邮易抽奖</a>
			<ul id="nav-mobile" class="side-nav orange">
				<li><a class="navfont white-text" href="create.php">创建抽奖</a></li>
				<li><a class="navfont white-text" href="manage.php">管理抽奖</a></li>
				<li><a class="navfont white-text" href="index.php">参加抽奖</a></li>
			</ul>
		</div>
	</nav>
	<div class="container z-depth-1 maincont">
		<div class="container instrucont center">
			<h6 class="">亲爱的用户 <?php echo $_SESSION['name'];?> ，您目前已发布的抽奖如下</h6>
			<div class="container z-depth-1 awardbox left-align">
				<p>奖项1:<input id="jx1"  /></p> 
				<p>奖项2:<input id="jx2"  /></p>
				<p>奖项3:<input id="jx3"  /></p>
				<p>奖项4:<input id="jx4"  /></p>
				<p>奖项5:<input id="jx5"  /></p>
				<p>奖项6:<input id="jx6"  /></p>
				<p>奖项7:<input id="jx7"  /></p>
				<p>奖项8:<input id="jx8"  /></p>
				<p>奖项9:<input id="jx9"  /></p>
				<p>奖项10:<input id="jx10" /></p>
				<p>抽奖状态：<input id="nowstate" /></p>
			</div>
			<div class="functionbox center">
				<a class="waves-effect waves-light btn orange darken-1" id="check" style="margin-top:10px;">查看名单</a>
				<a class="waves-effect waves-light btn orange darken-1" id="pause" style="margin-top:10px;">关闭抽奖</a>
			</div>
		</div>
	</div>
	<div class="mymodal" id="checkmodal">
		<div class="container z-depth-1 checkbox">
			<a class="waves-effect waves-light btn orange darken-1" id="pullout" style="margin-top:10px;">一键发放网薪</a>
		</div>
	</div>
</body>
</html>