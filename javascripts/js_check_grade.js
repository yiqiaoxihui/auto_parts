
function login()
{
	var uname = $("#uname").val();
	var psw = $("#psw").val();
	uname = $.trim(uname);
	psw = $.trim(psw);
	if(uname==""||psw=="")
	{
		alert("请输入正确的帐号、密码！");
		return;
	}
	
    //appendData(uname,psw);
    checkLogin(uname,psw);
}

function checkLogin(uname,psw){
	console.log("uname:"+uname);
	 $.ajax({
        type: 'POST',
        url : 'adminLogin.php',
        contentType : "application/x-www-form-urlencoded", //必须有
        data : {"adminName":uname,"adminPsw":psw},
        dataType:'json', 
        success : function(data) {
			var institute=data['institute'];
			var login_status=data['status'];
			console.log("login_status");
			console.log(login_status);
			if(login_status==-1){
				alert("登陆失败，帐户密码错误！");
				return;
			}
			var sinstitute;
			for (var option in institute){
				sinstitute="<option value="+institute[option]["insid"]+">"+institute[option]["insname"]+"</option>";
				//console.log(institute[option]["insid"]);
				$("#institute").append(sinstitute);
			}
			ifsearch();
			//$("#div-login").css("display","none");
			//$("#grade-result").css("display","inherit");
            
       },
       error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert(XMLHttpRequest.status);
              alert(XMLHttpRequest.readyState);
              alert(textStatus);
       }
    });
}



function ifsearch(){
  // console.log("***************sinstitute_value***************");   
  // var sinstitute = document.getElementById("institute"); //定位id
  // var sinstitute_index= sinstitute.selectedIndex; // 选中索引
  // //var sinstitute_text = sinstitute.options[sinstitute_index].text; // 选中文本
  // var sinstitute_value = sinstitute.options[sinstitute_index].value; // 选中值
  var query_text=document.getElementById('query_text').value;
  // console.log(sinstitute_value);
  // console.log("***************sort_value***************"); 
  var sort = document.getElementById("sort"); //定位id
  var sort_index= sort.selectedIndex; // 选中索引
  // //var sinstitute_text = sinstitute.options[sinstitute_index].text; // 选中文本
  var sort_value = sort.options[sort_index].value; // 选中值
  // console.log(sort_value);
  document.getElementById("summary").innerHTML="";
  // document.getElementById("undo").innerHTML="";
  // document.getElementById("fail").innerHTML="";
  // document.getElementById("excellent").innerHTML="";
  // document.getElementById("perpass").innerHTML="";
  // document.getElementById("perexcellent").innerHTML="";
  document.getElementById("grade-table-body").innerHTML = "<tr><th>型号</th><th>名称</th><th>价格</th><th>商家</th><th>产地</th><th>录入时间</th><th>备注</th><th>操作</th></tr>"; 
 $.ajax({
    type: 'POST',
    url : 'ifsearch.php',
    contentType : "application/x-www-form-urlencoded", //必须有
    data : {"query_text":query_text},
    dataType:'json', 
    success : function(data) {
      //alert("status:"+data['status']);
      //var login_status = data['status'];
      var info=[];
      info=data['content'];
      //var institute=data['institute'];
      //console.log(institute);
      //console.log("data:"+data.length);
      //data = data.substr(1);
      var status=data['status'];
      if(status==2){
        parent.layer.msg("暂无数据");
        //$("#div-login").css("display","none");
        // $("#no-grade").text("暂无成绩");
        //document.getElementById('div-login').style.display = 'block';
        //document.getElementById('grade-result').style.display = 'none';
        return;
      }
      //console.log(info);
      if(sort_value==2){//从低到高排序
      	   info.sort(function(x,y){
      			return x['price']-y['price'];
	      });
      }else if(sort_value==1){
      	    info.sort(function(x,y){
      			return y['price']-x['price'];
	      	});
      }
      var undo=0;
      var fail=0;
      var excellent=0;
      for (var item in info){
          	//console.log(item);
          				//echo $row;
    		// if(info[item]['r_grade']==-1||info[item]['r_grade']==null){
    		// 	undo++;//未完成数目
    		// }
    		// else if(info[item]['r_grade']>=0 && info[item]['r_grade']<60){
    		// 	fail++;
    		// }
    		// else if(info[item]['r_grade']>=90){
    		// 	excellent++;
    		// }
        var date=info[item]["create_time"].split(" ")[0];//只需要日期，不需要具体时间
        addGrade(info[item]["type"],info[item]["name"],info[item]["price"],info[item]["firm"],info[item]["place"],date,info[item]["remarks"],info[item]["id"]);
      }
      perexcellent=parseInt(excellent/info.length*100);
      perpass=parseInt((info.length-fail)/info.length*100);
      document.getElementById("summary").innerHTML="配件总数:  "+info.length;
      // document.getElementById("undo").innerHTML="不及格人数:  "+fail;
      // document.getElementById("fail").innerHTML="优秀人数:  "+excellent;
      // document.getElementById("excellent").innerHTML="未完成人数:  "+undo;
      // document.getElementById("perpass").innerHTML="及格率:  "+perpass+"%";
      // document.getElementById("perexcellent").innerHTML="优秀率:  "+perexcellent+"%";
      $("#div-login").css("display","none");
      $("#grade-result").css("display","inherit");
            
      },
       error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert(XMLHttpRequest.status);
              alert(XMLHttpRequest.readyState);
              alert(textStatus);
       }
    });


}
var failColor;
var excellentColor;
function addGrade(type,name,price,firm,place,create_time,remarks,id)
{
  var add_tr;
  // failColor="</td><td style='color:red;'>"+create_time+"</td></tr>";
  // excellentColor="</td><td style='color:green;'>"+create_time+"</td></tr>";
  // if(create_time==-1||create_time==null){
  //     create_time="</td><td style='color:yellow;'>未完成</td></tr>";
  //     add_tr = "<tr><td>"+type+"</td><td>"+name+"</td><td>"+price+create_time;
  // }else if(create_time<60){
  //     add_tr = "<tr><td>"+type+"</td><td>"+name+"</td><td>"+price+failColor;
  // }else{
  //     add_tr = "<tr><td>"+type+"</td><td>"+name+"</td><td>"+price+excellentColor;
  // }
  dd_tr = "<tr><td>"+type+"</td><td>"+name+"</td><td>"+price+"元</td><td>"+firm+"</td><td>"+place+"</td><td>"+create_time+"</td><td>"+remarks
  +"</td><td style='width:200px;'><button  class='btn btn-success btn-lg btn-block' onClick='modify_item("+id+")'>修改</button><button  class='btn btn-danger btn-lg btn-block' onClick='delete_item("+id+")'>删除</button></td></tr>";
  $("#grade-table-body").append(dd_tr);
}

function delete_item(id)
{
    if(id==""){
      alert("id 不能为空");
      return;
    }
  layer.confirm('确定删除这条信息？', {
    btn: ['确定','取消'] //按钮
  }, function(){
    $.ajax({
            type: 'POST',
            url : "deleteOk.php",
            contentType : "application/x-www-form-urlencoded", //必须有
            data : {"id":id},
            dataType:'JSON', 
            success : function(data) {
                  
                  // alert(result['msg']);
                  location.reload();
                  layer.msg(data['msg'], {icon: 1,time:2000});
            },
            error : function(err) {
                alert("删除异常！get  "+err);
            }
        });
  }, function(){
  });

    
}

// function appendData(uname,psw)
// {
// 	console.log("uname:"+uname);
// 	 $.ajax({
//         type: 'POST',
//         url : 'adminLogin.php',
//         contentType : "application/x-www-form-urlencoded", //必须有
//         data : {"adminName":uname,"adminPsw":psw},
//         dataType:'json', 
//         success : function(data) {
// 			//alert("status:"+data['status']);
// 			//var login_status = data['status'];
// 			var info=data['content'];
// 			var institute=data['institute'];
// 			//console.log(institute);
// 			//console.log("data:"+data.length);
// 			//data = data.substr(1);
// 			var login_status=data['status'];
// 			console.log("login_status");
// 			console.log(login_status);
// 			if(login_status==-1){
				
// 				alert("登陆失败，帐户密码错误！");
// 				    //$("#div-login").css("display","none");
				
// 				//document.getElementById('div-login').style.display = 'block';
// 				//document.getElementById('grade-result').style.display = 'none';
// 				return;
// 			}
// 			if(login_status==-2)
// 			{
// 				$("#no-grade").text("暂无成绩");
// 				$("#grade-result").css("display","inherit");
// 			}
// 			var jslength=0;
// 			for(var js2 in info){

// 				jslength++;
// 				//console.log("name:"+a_data["0"]["name"]);
// 			}
// 			//var instlen=0;
// 			var sinstitute;
// 			for (var option in institute){
// 				sinstitute="<option value="+institute[option]["insid"]+">"+institute[option]["insname"]+"</option>";
// 				//console.log(institute[option]["insid"]);
// 				$("#institute").append(sinstitute);
// 			}
// 			var js_dex = 0;
// 			for(js_dex = 0;js_dex<jslength;js_dex++)
// 			{
// 				addGrade(info[js_dex]["type"],info[js_dex]["name"],info[js_dex]["insname"],info[js_dex]["r_grade"]);
// 			}

// 			$("#div-login").css("display","none");
// 			$("#grade-result").css("display","inherit");
            
//         },
//        error: function(XMLHttpRequest, textStatus, errorThrown) {
//               alert(XMLHttpRequest.status);
//               alert(XMLHttpRequest.readyState);
//               alert(textStatus);
//        }
//     });
   
// }