$(document).ready(function(){
	var myModal = $(".myModal");
	var myConfirm = $(".myConfirm");
	var confirmForConfirm = $("#confirmForConfirm");
	var confirmForAlert = $("#confirmForAlert");
	var myAlert = $(".myAlert");
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
							text1 = text1+1
							var temp = "award"+text1;
							var awardTemp = $("#"+temp).children("p").text();
							confirmForAlert.before("<p id="+"tempInform"+">恭喜你获得了"+awardTemp+"，请等待管理员发放</p>");
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
});

var flag = false;
var text1;

function letgo() {
		//检查合法性
		text1 = parseInt(Math.random()*10);
		//产生随机数，此处可交给后端

		var num = [0, -65, -130,-195, -260, -325, -390, -455, -520, -585][text1];

		$(".drawBar").animate({"top":-1300},400,"linear", function(){
				$(this).css("top",0).animate({"top":-650},400,"linear",function(){
					$(this).css("top",0).animate({"top":-650},400,"linear");
					$(this).css("top",0).animate({"top":num},1800,"linear");
				});
				
		});
}

function reset() {
		$(".drawBar").css({"top":0});
}