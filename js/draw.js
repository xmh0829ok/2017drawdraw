var text1 = $("<h1></h1>").text("欢迎来到易乐透");

$(document).ready(function(){


  $("#return").click(function(){
    window.location.href="index.php";
  });

  $("#checkOut").click(function(){
    var userName = window.location.href.split("=")[1];
    $.ajax ({
      type:"POST",
      url:"API/Info.php",
      data:{userName : userName},
      success:function(data){
        var result = JSON.parse(data);
        //console.log(result);
        $.each(result, function(idx, obj){
          if (obj.type=="网薪") {
            $(".myAlert").prepend("<p class='awardRecords'>"+obj.student+"刚刚获得了网薪"+obj.award+"。</p>");
          }
          else if (obj.type=="自定义") {
            $(".myAlert").prepend("<p class='awardRecords'>"+obj.student+"刚刚获得了"+obj.award+"。</p>");
          }
        });
        $(".myModal").fadeIn();
        $(".myAlert").fadeIn();
        confirmForAlert.click(function(){
            myModal.fadeOut();
            myAlert.fadeOut();
            $("#tempInform").remove();
            $(".awardRecords").remove();
        
        });
      }
    });
    
  });

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
var award = [];

function letgo() {	

    var userName = window.location.href.split("=")[1];

		$.ajax({
  			url:"API/run.php",
  			type:"POST",
  			data:{userName:userName},
  			datatype:'json',
  			success: function(data) {
          var obj = $.parseJSON(data);
  				number = obj.randnumber;
          console.log(number);
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
	var type = new Array();
	var awardShown = new Array();
	var info = $(".intro");
	for (var i = 1; i <=10; i++) {
		awardShown[i-1] = $("#award"+i);
	}

	$.ajax({ //从后台获得奖项
  			url:"API/getaward.php",
  			asyn:false,
  			type:"GET",
  			data:{userName:userName},
  			datatype:'json',
  			cache: false,
  			success: function(data) {
  				var result = $.parseJSON(data);
  				if(result.type1==1){
  					award[0]=result.award1+"网薪";
  				}else{
  					award[0]=result.award1;
  				}

  				if(result.type2==1){
  					award[1]=result.award2+"网薪";
  				}else{
  					award[1]=result.award2;
  				}

  				if(result.type3==1){
  					award[2]=result.award3+"网薪";
  				}else{
  					award[2]=result.award3;
  				}

  				if(result.type4==1){
  					award[3]=result.award4+"网薪";
  				}else{
  					award[3]=result.award4;
  				}

  				if(result.type5==1){
  					award[4]=result.award5+"网薪";
  				}else{
  					award[4]=result.award5;
  				}

  				if(result.type6==1){
  					award[5]=result.award6+"网薪";
  				}else{
  					award[5]=result.award6;
  				}

  				if(result.type7==1){
  					award[6]=result.award7+"网薪";
  				}else{
  					award[6]=result.award7;
  				}

  				if(result.type8==1){
  					award[7]=result.award8+"网薪";
  				}else{
  					award[7]=result.award8;
  				}

  				if(result.type9==1){
  					award[8]=result.award9+"网薪";
  				}else{
  					award[8]=result.award9;
  				}

  				if(result.type10==1){
  					award[9]=result.award10+"网薪";
  				}else{
  					award[9]=result.award10;
  				}
  				
  				info.prepend("<p>本次抽奖由"+result.realname+"创建，奖品如下：</p>");
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
							var temp = award[number];
						//	var awardTemp = $("#"+temp).children("p").text();
							confirmForAlert.before("<p id=tempInform>恭喜你获得了"+temp+"，请等待管理员发放</p>");
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

