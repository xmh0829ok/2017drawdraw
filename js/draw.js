var text1 = $("<h1></h1>").text("欢迎来到易乐透");
$(document).ready(function(){
	var myModal = $(".myModal");
	var myConfirm = $(".myConfirm");
	var confirmForConfirm = $("#confirmForConfirm");
	var confirmForAlert = $("#confirmForAlert");
	var myAlert = $(".myAlert");

	getAwards();//获得奖项们并显示出来

	drawClickActions(myModal, myConfirm, confirmForConfirm, confirmForAlert, myAlert);

});

var flag = false;
var number;

function letgo() {
		//检查合法性
		number = parseInt(Math.random()*10);
		//产生随机数，此处可交给后端

		var num = [0, -65, -130,-195, -260, -325, -390, -455, -520, -585][number];

		$(".drawBar").animate({"top":-1300},400,"linear", function(){
				$(this).css("top",0).animate({"top":-650},400,"linear",function(){
					$(this).css("top",0).animate({"top":-650},400,"linear");
					$(this).css("top",0).animate({"top":num},1800,"linear");
				});
				
		});
/*
		$.ajax({
  			url:"API/run.php",
  			asyn:false,
  			type:"GET",
  			data:number,
  			datatype:'json',
  			cache: false,		
  	};
  	*/
}
function reset() {
		$(".drawBar").css({"top":0});
}

function getAwards (){
	var userName = window.location.href.split("=")[1];
	var award = new Array();
	var type = new Array();
	var awardShown = new Array();
	var info = $(".intro");
	for (var i = 1; i <=10; i++) {
		awardShown[i-1] = $("#award"+i);
	};
	/*
	$.ajax({ //只有每个奖项都填写时，才将数据发送给后台
  			url:"API/getaward.php",
  			asyn:false,
  			type:"GET",
  			data:userName;
  			datatype:'json',
  			cache: false,
  			success: function(data) {
  			for (var j = 0; j <data.length; j++) {
  				award[j] = data[j];
  				type[j] = data[j];
  	};
  }
  */
  awardd = new Array("网薪1", "网薪2", "网薪3", "网薪4", "网薪5", "网薪6", "网薪7", "网薪8", "网薪9", "网薪10");
  for (var k = 0; k < 10; k++) {
  	awardShown[k].append("<p>"+awardd[k]+"</p>");
  	info.append("<p>"+awardd[k]+"</p>");
  };

}

function drawClickActions (myModal, myConfirm, confirmForConfirm, confirmForAlert, myAlert){
		$("#buttonX").click(function(){
		if (!flag) {
			myModal.fadeIn();
			myConfirm.fadeIn();
			confirmForConfirm.click(function(){
					myModal.hide();
					myConfirm.hide();
					if (!flag) {
						flag = true;
						reset();
						letgo();
						setTimeout(function(){
							flag = false;
							var tempNum = number+1
							var temp = "award"+tempNum;
							var awardTemp = $("#"+temp).children("p").text();
							confirmForAlert.before("<p id=tempInform>恭喜你获得了"+awardTemp+"，请等待管理员发放</p>");
							myModal.fadeIn();
							myAlert.fadeIn();
						}, 3500);
					}
				});
			confirmForAlert.click(function(){
				myModal.fadeOut();
				myAlert.fadeOut();
				$("#tempInform").remove();
			});
			$(".cancelButton").click(function(){
				myModal.fadeOut();
				myConfirm.fadeOut();
			});
		}
	});
}

function checkIfCreator() {
	/*
	$.ajax({ 
  			url:"API/checkcreate.php",
  			asyn:false,
  			type:"GET",
  			datatype:'json',
  			cache: false,
  			success: function(result) {
	  			if (result) {
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
		$(".checkContainer").prepend("<button class="+className+" href = "+tempHref+" style=width:100px;margin-top:20px;>管理抽奖</button>");
	}
}


