var text1 = $("<h1></h1>").text("欢迎来到易乐透");
$(document).ready(function(){
	var canvas = document.getElementById("welcome");
	var context =canvas.getContext("2d");

	canvas.height = window.innerHeight;
	canvas.width = window.innerWidth;
	var VISION_HEIGHT = window.innerHeight/2 -45;

	welcome(canvas, context, VISION_HEIGHT);
	
	checkIfCreator ();//检查是否管理员

	getLotteries();//获得lotteries并显示 

	drawClick();//点击抽奖，确认权限并修改href

})

//检查是否有创建权限，若有则创建一个按钮
function checkIfCreator() {
	$.ajax({ 
  	url:"API/checkcreate.php",
  	asyn:false,
  	type:"GET",
  	datatype:'json',
  	cache: false,
  	success: function(result) {
  	//	var obj = JSON.parse(result);
	  	if (result.result==1) {
				$(".checkContainer").prepend("<button class='confirmButton' style='width:100px;margin-top:20px' href = 'manage.php'>管理抽奖</button>");
	  	}
  	}
  })
}

//获得当前所有被创建的抽奖，并遍历地打印出来。
function getLotteries (){
	
	$.ajax({
  			url:"API/lotteryname.php",
  			asyn:false,
  			type:"GET",
  			datatype:'json',
  			cache: false,
  			success: function(result) {
  				console.log(result);
  				$.each(result, function(idx, obj){
  					$(".checkContainer").append("<div class=checkBox id="+obj.username+"><p>抽奖名："+obj.lotteryname+"</p><p>创建人："+obj.username+"</p></div>");
  				})
  			},
  			erorr: function() {
  				$(".checkContainer").append("<div class=checkBox><p>服务器正忙，读取错误。</p></div>");
  			}
  });
}

//欢迎动画，测试时节省时间可去掉
function welcome(canvas, context, VISION_HEIGHT){
	$("#headBox").css('padding-top', VISION_HEIGHT);
	setTimeout(function (){
		$("#welcomeWords1").fadeOut();
		context.clearRect(0,0,canvas.width,canvas.height);
	}, 2400);
	setTimeout(function (){
		context.strokeStyle = "rgb(178, 47, 47)";
		context.lineWidth = 4;
		context.moveTo(20, VISION_HEIGHT+25);
		context.lineTo(canvas.width-20, VISION_HEIGHT+25);
		context.stroke();
	}, 1400);
	
	setTimeout(function (){
		$("#welcomeWords1").remove();
		context.clearRect(0,0,canvas.width,canvas.height);
		$("#headBox").append(text1);
		$("h1:first").addClass("welcomeWord animated fadeIn headFont");
	},3000);
	setTimeout(function (){
		$("#welcome").remove();
		$(".welcomeWord").fadeOut(function(){
			$(".checkContainer").fadeIn();
		});
	},5000);
}

//某抽奖点击事件，通过唯一id传递到href，唯一标识某抽奖
function drawClick() {
	var thisUserName = this.id;
	var lotteryID = 0;
	var url = "draw.html?lotteryID=";	
	$(".checkBox").click(function(){
		$.ajax({ 
  			url:"API/checkAuthority",
  			asyn:false,
  			type:"POST",
  			data: thisUserName,
  			datatype:'json',
  			cache: false,
  			success: function(result) {
  				console.log(result);
  				var obj = JSON.parse(result);
	  			if (obj.result==1) {
						url = url+lotteryID;
						window.location.href = url;
	  			}
	  			else {
	  				$(".myModal").fadeIn();
						$(".myAlert").fadeIn();
						$("#confirmForAlert").click(function(){
							$(".myModal").fadeOut();
							$(".myAlert").fadeOut();
						});
	  			}
  			}
  	});
	});
}