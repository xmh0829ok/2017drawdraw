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
		$.ajax({
  			url:"API/run.php",
  			asyn:false,
  			type:"POST",
  			data:number,
  			datatype:'json',
  			cache: false,
  			success: function() {
  				number = parseInt(Math.random()*10);
					//产生随机数

					var num = [0, -65, -130,-195, -260, -325, -390, -455, -520, -585][number];

					$(".drawBar").animate({"top":-1300},400,"linear", function(){
							$(this).css("top",0).animate({"top":-650},400,"linear",function(){
								$(this).css("top",0).animate({"top":-650},400,"linear");
								$(this).css("top",0).animate({"top":num},1800,"linear");
							});
					});
  			},
  			error: function() {
  				alert("抽奖失败，服务器正忙。请重新尝试。")
  			}
  	});
  	
}
function reset() {
		$(".drawBar").css({"top":0});
}

function getAwards (){
	var userName = window.location.href.split("=")[1];
	var award = new Array("默认1","默认2","默认3","默认4","默认5","默认6","默认7","默认8","默认9","默认10");
	var type = new Array();
	var awardShown = new Array();
	var info = $(".intro");
	for (var i = 1; i <=10; i++) {
		awardShown[i-1] = $("#award"+i);
	};
	$.ajax({ //从后台获得奖项
  			url:"API/getaward.php",
  			asyn:false,
  			type:"GET",
  			data:userName,
  			datatype:'json',
  			cache: false,
  			success: function(result) {
  				console.log(result);
  				award[0]=result.award1;
  				award[1]=result.award2;
  				award[2]=result.award3;
  				award[3]=result.award4;
  				award[4]=result.award5;
  				award[5]=result.award6;
  				award[6]=result.award7;
  				award[7]=result.award8;
  				award[8]=result.award9;
  				award[9]=result.award10;
  				for (var i = 0; i <10; i++) {
  					awardShown[i].append("<p>"+award[i]+"</p>");
  					info.append("<p>"+award[i]+"</p>");
  				}
  			},
  			error: function(){
  				for (var i = 0; i <10; i++) {
				  	awardShown[i].append("<p>"+award[i]+"</p>");
				  	info.append("<p>"+award[i]+"</p>");
				  }
				  $("#confirmForAlert").before("<p id='tempInform'>服务器正忙，加载出现错误，请刷新重试。</p>");
				 	$(".myModal").fadeIn();
				 	$(".myAlert").fadeIn();
  			}
  });
  
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

