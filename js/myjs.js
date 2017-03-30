
$(document).ready(function(){

	$('select').material_select();
  $('.button-collapse').sideNav();
  $('#makedraw').click(function(){//创建抽奖函数


  	var authority = [];
    var h = 0;

    $("#range").children("option").each(function(){
      if (this.selected) {
        authority[h++] = 1;
      }
      else {
        authority[h++] = 0;
      }
    });

   
    console.log(authority);
    var lotteryname = $("#lotteryName").val();
  	var name = [];
  	var value = [];
  	var j = 1;
  	var radio;
  	var flag = 0;
  	for(;j<=10;j++){
  			radio = document.getElementsByName("group"+j);
  			if (radio[0].checked) {
  				value[j-1] = radio[0].value;
  				if (value[j-1]==1) {
  					var numtemp = document.getElementById("num"+j).value
  					name[j-1] = numtemp; //“网薪X”直接代表X网薪，储存在awarddetails.name中，自定义奖品同
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
  				value[j-1] = radio[1].value;
  				if (value[j-1]==2) {
  					name[j-1] = document.getElementById("designaward"+j).value;
  					if(!name[j-1]) {
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
    			url:"API/new.php",
    			type:"POST",
    			data:{
  		        name:name,
  		        value:value,
  		        lotteryname:lotteryname,
  		        autho:authority
          	},
    			datatype:'json',
    			success: function(data) {
  	          alert("创建成功！,请从左上方导航进入管理或抽奖页面");
    				//待修改
    			},
          error: function() {
            alert("创建失败，服务器正忙。")
          }
    		});
    	}
  });



});


