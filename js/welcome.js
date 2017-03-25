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

function checkIfCreator() {
	/*
	$.ajax({ 
  			url:"API/checkcreate.php",
  			asyn:false,
  			type:"GET",
  			datatype:'json',
  			cache: false,
  			success: function(result) {
	  			if (result==1) {
						$(".checkContainer").prepend("<button class="confirmButton" style="width:100px;margin-top:20px" href = "create.php">管理抽奖
						</button>")
	  			};
	  			};
  			}
  })
*/
  var tempHref = "create.php";
  var className = "confirmButton";
	var result = 1;
	if (result) {
		$(".checkContainer").prepend("<button class="+className+" href = "+tempHref+" style=width:100px;margin-top:20px;>管理抽奖</button>")
	};
}

function getLotteries (){
	var userName = {};
	var lotteryName = {};
	var target = {};
	/*
	$.ajax({
  			url:"API/lotteryname.php",
  			asyn:false,
  			type:"GET",
  			datatype:'json',
  			cache: false,
  			success: function(result) {
  			for (var j = 0; j <result.username.length; j++) {
  				userName[j] = data.username[j];
					lotteryName[j] = data.lotteryname[j];
					$("#checkContainer").append("<div class=checkBox id="+userName[j]+"><p>抽奖名："+lotteryName[j]+"</p><p>创建人："+userName[j]+"</p></div>");
  			};
  }
  */

}


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
	/*
	function welcomeIn (){
		$("#welcomeWords1").remove();
		context.clearRect(0,0,canvas.width,canvas.height);
		$("#headBox").append(text1);
		$("h1:first").addClass("welcomeWord animated fadeIn headFont");
	}
	*/
	setTimeout(function (){
		$("#welcome").remove();
		$(".welcomeWord").fadeOut(function(){
			$(".checkContainer").fadeIn();
		});
	},5000);
}

function drawClick() {
	var thisUserName = this.id;
	var lotteryID = 0;
	var url = "draw.html?lotteryID=";	
	$(".checkBox").click(function(){
	/*	$.ajax({ 
  			url:"",
  			asyn:false,
  			type:"POST",
  			data: thisUserName,
  			datatype:'json',
  			cache: false,
  			success: function(data) {
	  			if (data.result=="no authority") {
						
	  			};
  			}
  	})
*/
		//权限无
		$(".myModal").fadeIn();
		$(".myAlert").fadeIn();
		$("#confirmForAlert").click(function(){
			$(".myModal").fadeOut();
			$(".myAlert").fadeOut();
		});
		//权限有
		url = url+lotteryID;
		window.location.href = url;
	})
}