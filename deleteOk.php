<?php  
/*
*学生完成答题，计算成绩。
*返回json:back {status :1,正常返回，status=-1，非法修改}
*/
	include("conn.php");
	$id=$_POST['id'];

	$sql=mysql_query("select * from items where id='$id'");#or username='$name'
	$result=mysql_fetch_assoc($sql);
	$back=array();
	if(!empty($result)){
		$rs=mysql_query("delete from items where id = '$id'");
		if(mysql_affected_rows()>0){
			$back['msg']="删除配件信息成功";
			$back['status']=1;
		}else{
			$back['msg']="删除配件信息失败";
			$back['status']=-2;
		}
		echo json_encode($back);
	}else{
		$back['status']=-1;
		$back['msg']="不存在id=".$id."的配件";
		echo json_encode($back);
	}
    mysql_close(); 
?> 