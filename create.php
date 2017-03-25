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
				<li><a class="navfont white-text" href="">参加抽奖</a></li>
			</ul>
		</div>
	</nav>
	<div class="container z-depth-1 maincont2">
		<div class="wx">
			我的当前网薪：<?php echo $wx; ?>;
		</div>
		<div class="optionbox">
			<div class="col s10">
				<p>设置奖项1</p>
		    <form action="#">
		    	<p>
		    		<input name="group1" type="radio" id="award11" value="1">
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
		    <form action="#">
		    	<div class="input-field col s12">
		    		<div class="row">
					    <select multiple>
					      <option value="1">选项 1</option>
					      <option value="2">选项 2</option>
					      <option value="3">选项 3</option>
   						</select>
	   				 	<label>Materialize 下拉列表</label>
	   				</div>
  				</div>
		    </form>
		    <a class="waves-effect waves-light btn orange darken-1" id="makedraw">创建抽奖</a>
		  </div>
		</div>
		<div class="mymodal">
			
		</div>
	</div>
</body>
</html>