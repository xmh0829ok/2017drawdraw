<?php
require("classes/yb-globals.inc.php");
    
    session_start();
    
    if(!isset($_SESSION['token'])){
        exit('illegal access!');
     }
	 	$curl = curl_init();
    //设置抓取的url
    curl_setopt($curl, CURLOPT_URL, 'https://openapi.yiban.cn/user/me?access_token='.$_SESSION['token']);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($data,true);
	
		$wx = $res['info']['yb_money'];  //我的当前网薪，调用接口来获取.

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
				<li><a class="navfont white-text" href="create.php">创建抽奖</a></li>
				<li><a class="navfont white-text" href="manage.php">管理抽奖</a></li>
				<li><a class="navfont white-text" href="index.php">参加抽奖</a></li>
			</ul>
		</div>
	</nav>
		

		<div class="optionbox">
			<div class="wx">
				<p>我的当前网薪：<?php echo $wx; ?>;</p>
			</div>
		  <div class="input-field col s8">
		  <form>
		    <div class="row">
		    	<p>选择面向院系</p>
					<select multiple name="range">
					  <option>全校范围</option>
					  <option>信息与通信工程学院</option>
					  <option>电子工程学院</option>
					  <option>计算机学院</option>
					  <option>自动化学院</option>
					  <option>软件学院</option>
					  <option>现代邮政学院</option>
					  <option>网络空间安全学院</option>
					  <option>光电信息学院</option>
					  <option>理学院</option>
					  <option>经济管理学院</option>
					  <option>公共管理学院</option>
					  <option>人文学院</option>
					  <option>马克思主义学院</option>
					  <option>国际学院</option>
					  <option>网络教育学院</option>
					  <option>继续教育学院</option>
					  <option>民族教育学院</option>
					  <option>网络技术研究院</option>
					  <option>信息光子学与光通信研究院</option>
					  <option>叶培大学院</option>
   				</select>	   			
	   		</div>
	   		</form>
  		</div>
			<div class="col s8">
				<p>设置奖项1</p>
		    <form action="#">
		    	<p>
		    		<input name="group1"  type="radio" id="award11" value="1">
		    		<label for="award11">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num1" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group1" type="radio" id="award12" value="2">
		    		<label for="award12">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="自定义奖品" id="designaward1" type="text" class="validate">
	       		</div>
       		</div>
		    </form>
		    <p>设置奖项2</p>
		    <form action="#">
		    	<p>
		    		<input name="group2" type="radio" id="award21" value="1">
		    		<label for="award21">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num2" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group2" type="radio" id="award22" value="2">
		    		<label for="award22">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="自定义奖品" id="designaward2" type="text" class="validate">
	       		</div>
       		</div>
		    </form>
		    <p>设置奖项3</p>
		    <form action="#">
		    	<p>
		    		<input name="group3" type="radio" id="award31" value="1">
		    		<label for="award31">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num3" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group3" type="radio" id="award32" value="2">
		    		<label for="award32">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="自定义奖品" id="designaward3" type="text" class="validate">
	       		</div>
       		</div>
		    </form>
		    <p>设置奖项4</p>
		    <form action="#">
		    	<p>
		    		<input name="group4" type="radio" id="award41" value="1">
		    		<label for="award41">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num4" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group4" type="radio" id="award42" value="2">
		    		<label for="award42">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s6">
	          <input placeholder="自定义奖品" id="designaward4" type="text" class="validate">
	       		</div>
       		</div>
		    </form>
		    <p>设置奖项5</p>
		    <form action="#">
		    	<p>
		    		<input name="group5" type="radio" id="award51" value="1">
		    		<label for="award51">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num5" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group5" type="radio" id="award52" value="2">
		    		<label for="award52">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="自定义奖品" id="designaward5" type="text" class="validate">
	       		</div>
       		</div>
		    </form>
		    <p>设置奖项6</p>
		    <form action="#">
		    	<p>
		    		<input name="group6" type="radio" id="award61" value="1">
		    		<label for="award61">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num6" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group6" type="radio" id="award62" value="2">
		    		<label for="award62">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="自定义奖品" id="designaward6" type="text" class="validate">
	       		</div>
       		</div>
		    </form>
		    <p>设置奖项7</p>
		    <form action="#">
		    	<p>
		    		<input name="group7" type="radio" id="award71" value="1">
		    		<label for="award71">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num7" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group7" type="radio" id="award72" value="2">
		    		<label for="award72">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="自定义奖品" id="designaward7" type="text" class="validate">
	       		</div>
       		</div>
		    </form>
		    <p>设置奖项8</p>
		    <form action="#">
		    	<p>
		    		<input name="group8" type="radio" id="award81" value="1">
		    		<label for="award81">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num8" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group8" type="radio" id="award82" value="2">
		    		<label for="award82">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="自定义奖品" id="designaward8" type="text" class="validate">
	       		</div>
       		</div>
		    </form>
		    <p>设置奖项9</p>
		    <form action="#">
		    	<p>
		    		<input name="group9" type="radio" id="award91" value="1">
		    		<label for="award91">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num9" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group9" type="radio" id="award92" value="2">
		    		<label for="award92">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="自定义奖品" id="designaward9" type="text" class="validate">
	       		</div>
       		</div>
		 		</form>
		    <p>设置奖项10</p>
		    <form action="#">
		    	<p>
		    		<input name="group10" type="radio" id="award101" value="1">
		    		<label for="award101">网薪</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="输入网薪数量" id="num10" type="text" class="validate">
	       		</div>
       		</div>
		    	<p>
		    		<input name="group10" type="radio" id="award102" value="2">
		    		<label for="award102">自定义奖品</label>
		    	</p>
		    	<div class="row">
			    	<div class="input-field col s8">
	          <input placeholder="自定义奖品" id="designaward10" type="text" class="validate">
       		</div>
       		<input placeholder="输入抽奖名称" id="lotteryName" type="text" class="validate">
       		</div>
		    </form>

		    <a class="waves-effect waves-light btn orange darken-1" id="makedraw">创建抽奖</a>
		  </div>
		</div>
		<div class="mymodal">
			
		</div>

</body>
</html>