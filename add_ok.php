<?php  
/*
*学生完成答题，计算成绩。
*返回json:back {status :1,正常返回，status=-1，非法修改}
*/
	include("conn.php");
	$type=$_POST['type'];//答对题目数
	$price=$_POST['price'];
	$place=$_POST['place'];
	$firm=$_POST['firm'];
	$remarks=$_POST['remarks'];
	$name=$_POST['name'];
	$sql=mysql_query("select * from items where type='$type'");#or name='$name'
	$result=mysql_fetch_assoc($sql);
	$back=array();
	$date=date('Y-m-d h:i:s', time());
	if(empty($result)){
		$rs=mysql_query("insert into items(type,price,name,remarks,create_time,firm,place)value('$type','$price','$name','$remarks','$date','$firm','$place')");
		if(mysql_affected_rows()>0){
			$back['msg']="添加配件信息成功";
			$back['status']=1;
		}else{
			$back['msg']="添加配件信息失败";
			$back['status']=-2;
		}
		echo json_encode($back);
	}else{
		$back['status']=-1;
		$back['msg']="存在相同编号或名称的配件";
		echo json_encode($back);
	}
    mysql_close(); 
?> 