

$(document).ready(function(){
  $('select').material_select();
  $('.button-collapse').sideNav();
  $('#makedraw').click(function(){//创建抽奖函数
  	var awarddetails = {};//awarddetails的name和value两个数组将分别储存10个奖项的内容和类型
  	awarddetails.name = [];
  	awarddetails.value = [];
  	var j = 1;
  	var radio;
  	var flag = 0;
  	for(;j<=10;j++){
  			radio = document.getElementsByName("group"+j);
  			if (radio[0].checked) {
  				awarddetails.value[j-1] = radio[0].value;
  				if (awarddetails.value[j-1]==1) {
  					var numtemp = document.getElementById("num"+j).value
  					awarddetails.name[j-1] = "网薪"+numtemp; //“网薪X”直接代表X网薪，储存在awarddetails.name中，自定义奖品同
  					if(!numtemp) {
  						alert("选项"+j+"未填写网薪数量，请填充。");
  						flag = 1;
  						break;
  					}
  				} //检查每个单选的第一个是否已被选择
  				  //并将用户的选项存储到数组name和value中
  				  //value值为1代表网薪，2代表自定义用品
  			}
  			else if (radio[1].checked) {
  				awarddetails.value[j-1] = radio[1].value;
  				if (awarddetails.value[j-1]==2) {
  					awarddetails.name[j-1] = document.getElementById("designaward"+j).value;
  					if(!awarddetails.name[j-1]) {
  						alert("选项"+j+"未填写自定义奖品，请填充。");
  						flag = 1;
  						break;
  					}
  				}
  			}
  			else {
  				alert("有选项未填充，请检查。");
  				flag = 1;
  				break;
  			}
  			flag = 0;
  	}
  	if (flag==0) {
  		$.ajax({ //只有每个奖项都填写时，才将数据发送给后台
  			url:"",
  			asyn:false,
  			type:"POST",
  			data:awarddetails,
  			datatype:'json',
  			cache: false,
  			success: function() {
  				//待修改
  			}
  		})
  	};
  })
	$('#check').click(function(){//查看获奖名单，弹出遮罩层
		$('#checkmodal').show();
	})
	$(".mymodal").click(function(){//取消遮罩层
     $(".mymodal").hide();
	}) 

})


