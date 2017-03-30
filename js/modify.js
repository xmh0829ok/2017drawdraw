

$(document).ready(function(){
    $('.button-collapse').sideNav();

  $.ajax({
        type:"GET",
        url:"API/getaward.php",
        dataType:"json",
        success:function(obj){
          //var obj = $.parseJSON(data);
          if(obj.type1==1){
            $("#jx1").val("网薪"+obj.award1);
          }else {
            $("#jx1").val(obj.award1);
          }

          if(obj.type2==1){
            $("#jx2").val("网薪"+obj.award2);
          }else {
            $("#jx2").val(obj.award2);
          }
          if(obj.type3==1){
            $("#jx3").val("网薪"+obj.award3);
          }else {
            $("#jx3").val(obj.award3);
          }
          if(obj.type4==1){
            $("#jx4").val("网薪"+obj.award4);
          }else {
            $("#jx4").val(obj.award4);
          }
          if(obj.type5==1){
            $("#jx5").val("网薪"+obj.award5);
          }else {
            $("#jx5").val(obj.award5);
          }
          if(obj.type6==1){
            $("#jx6").val("网薪"+obj.award6);
          }else {
            $("#jx6").val(obj.award6);
          }
          if(obj.type7==1){
            $("#jx7").val("网薪"+obj.award7);
          }else {
            $("#jx7").val(obj.award7);
          }
          if(obj.type8==1){
            $("#jx8").val("网薪"+obj.award8);
          }else {
            $("#jx8").val(obj.award8);
          }
          if(obj.type9==1){
            $("#jx9").val("网薪"+obj.award9);
          }else {
            $("#jx9").val(obj.award9);
          }
          if(obj.type10==1){
            $("#jx10").val("网薪"+obj.award10);
          }else {
            $("#jx10").val(obj.award10);
          }

          $("#nowstate").val(obj.state);

        },
        error: function (XMLHttpRequest, textStatus, errorThrown){    
        }
    });       


    $('#check').click(function(){//查看获奖名单，弹出遮罩层
    $('#checkmodal').show();
    
    $.ajax({
      url: "API/Info.php",
      type: "GET",
      success: function(data) {
        console.log(data);
        if(data==""){
          alert("当前无人参与抽奖！");
        }
        $.each(data, function(idx, obj){
          var　typee = "";
          if (obj.type==1) {
              typee = typee+"网薪";
          }
          else typee = typee+"自定义";
          $(".checkbox").append("<div class='row luckygroup'><div class='col s6'><p class=luckyone>中奖用户：</p><a class=luckyone>"+obj.student+"</a></div><div class='col s6'><p class=luckyone>奖项："+typee+"</p></div><div class='col s12'><p class=luckyone>具体描述："+obj.award+"</p></div></div>")
        });
      }

    });
    
  });



  $(".mymodal").click(function(){//取消遮罩层
     $(".mymodal").hide();
     $(".luckygroup").remove();
  });


  $("#pullout").click(function(){
    $.ajax({
      url:"API/wx.php",
      type:"GET",
      datatype:'json',
      success: function(data) {
          alert("网薪发放成功！");
      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {  //#3这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
       }
    });
  });


  $("#pause").click(function(){
    $.ajax({
      url:"API/new.php",
      type:"GET",
      success: function(data) {
          alert("成功关闭抽奖！");
          $("#pause").attr("disabled", true);

      },
      error: function(XMLHttpRequest, textStatus, errorThrown) {  //#3这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
      }
    });
  });
  


  $.ajaxSetup({
    type:"POST",
    url:"API/modify.php",
    dataType:"json",
    success:function(data){
      //var result = $.parseJSON(data);
      if (data.result=="success") {
          alert("修改成功！");
      } else {
          alert("修改失败！");
    }
        
    }
  });
  
  
  $('#jx1').change(function(){
    var sub = new Object;
    sub.jx1 = $("#jx1").val();
    $.ajax({
      data:sub
    });
  });
  $('#jx2').change(function(){
    var sub = new Object;
    sub.jx2 = $("#jx2").val();
    $.ajax({
      data:sub
    });
  });
  $('#jx3').change(function(){
    var sub = new Object;
    sub.jx3 = $("#jx3").val();
    $.ajax({
      data:sub
    });
  });
  $('#jx4').change(function(){
    var sub = new Object;
    sub.jx4 = $("#jx4").val();
    $.ajax({
      data:sub
    });
  });
  $('#jx5').change(function(){
    var sub = new Object;
    sub.jx5 = $("#jx5").val();
    $.ajax({
      data:sub
    });
  });
  $('#jx6').change(function(){
    var sub = new Object;
    sub.jx6 = $("#jx6").val();
    $.ajax({
      data:sub
    });
  });
  $('#jx7').change(function(){
    var sub = new Object;
    sub.jx7 = $("#jx7").val();
    $.ajax({
      data:sub
    });
  });
  $('#jx8').change(function(){
    var sub = new Object;
    sub.jx8 = $("#jx8").val();
    $.ajax({
      data:sub
    });
  });
  $('#jx9').change(function(){
    var sub = new Object;
    sub.jx9 = $("#jx9").val();
    $.ajax({
      data:sub
    });
  });
  $('#jx10').change(function(){
    var sub = new Object;
    sub.jx10 = $("#jx10").val();
    $.ajax({
      data:sub
    });
  });

  $('#nowstate').change(function(){
    var sub = new Object;
    sub.nowstate = $("#nowstate").val();
    $.ajax({
      data:sub
    });
  });



});
