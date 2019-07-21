<?php  
/*
*学生完成答题，计算成绩。
*返回json:back {status :1,正常返回，status=-1，非法修改}
*/
	include("conn.php");
	$price=$_POST['price'];
	$name=$_POST['name'];
	$place=$_POST['place'];
	$firm=$_POST['firm'];
	$remarks=$_POST['remarks'];
	$type=$_POST['type'];
	$id=$_POST['id'];
	$sql=mysql_query("select * from items where id='$id'");#or type='$type'
	$result=mysql_fetch_assoc($sql);
	$back=array();
	$date=date('Y-m-d h:i:s', time());
	if(!empty($result)){
		$rs=mysql_query("update items set type='$type',name='$name',price='$price',place='$place',firm='$firm',type='$type',remarks='$remarks' where id = '$id'");
		if(mysql_affected_rows()>0){
			$back['msg']="修改配件信息成功";
			$back['status']=1;
		}else{
			$back['msg']="修改配件信息失败";
			$back['status']=-2;
		}
		echo json_encode($back);
	}else{
		$back['status']=-1;
		$back['msg']="不存在该配件,修改信息失败，id=".$id;
		echo json_encode($back);
	}
    mysql_close(); 
?>