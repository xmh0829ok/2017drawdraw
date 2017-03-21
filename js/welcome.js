var text1 = $("<h1></h1>").text("欢迎来到易乐透");
$(document).ready(function(){
	var canvas = document.getElementById("welcome")
	var context =canvas.getContext("2d");

	canvas.height = window.innerHeight;
	canvas.width = window.innerWidth;
	var VISION_HEIGHT = window.innerHeight/2 -45;
	$("#headBox").css('padding-top', VISION_HEIGHT);
	setTimeout(function (){
		$("#welcomeWords1").fadeOut();
		context.clearRect(0,0,canvas.width,canvas.height);
	}, 3000);
	setTimeout(function (){
		context.strokeStyle = "rgb(178, 47, 47)";
		context.lineWidth = 4;
		context.moveTo(20, VISION_HEIGHT+25);
		context.lineTo(canvas.width-20, VISION_HEIGHT+25);
		context.stroke();
	}, 1800);
	
	setTimeout(function (){
		$("#welcomeWords1").remove();
		context.clearRect(0,0,canvas.width,canvas.height);
		$("#headBox").append(text1);
		$("h1:first").addClass("welcomeWord animated fadeIn headFont");
	},4500);
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
	},8000);
	
})