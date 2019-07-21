<?php  
	include("conn.php");
    session_start();  
	// $institute=$_POST['institute'];//客户端post过来的用户名

	$query_text=$_POST['query_text'];
	// $sort=$_POST['sort'];//客户端post过来的密码
	//$institute=1;
	$allInfo=array();
	$content=array();
	// $undo=0;
	// $fail=0;
	// $excellent=0;
	if($query_text==""){
		$result=mysql_query(
			"SELECT id,name,type,price,create_time,remarks,place,firm
			FROM items"
		);
	}else{
		$query_text='%'.$query_text.'%';
		$result=mysql_query(
			"SELECT id,name,type,price,create_time,remarks,place,firm
			FROM items 
			WHERE name like '$query_text'"
		);
	}

	$flag=mysql_num_rows($result);
	//echo $flag;
	if($flag>0){//有数据
		while($row = mysql_fetch_assoc($result)){
			// //echo $row;
			// if($row['r_grade']==-1||$row['r_grade']==null){
			// 	$undo++;//未完成数目
			// }
			// else if($row['r_grade']>=0 && $row['r_grade']<60){
			// 	$fail++;
			// }
			// else if($row['r_grade']>=90){
			// 	$excellent++;
			// }
			$content[]=$row;
		}
		//排序

		// usort($content, function($a, $b) {
  //           $al = $a['r_grade'];
  //           $bl = $b['r_grade'];
  //           if ($al == $bl)
  //               return 0;
  //           return ($al > $bl) ? -1 : 1;
  //       });
		$allInfo['content']=$content;
		$allInfo['status']=1;
		// $allInfo['undo']=$undo;
		// $allInfo['fail']=$fail;
		// $allInfo['excellent']=$excellent;
	}else{
		$allInfo['status']=2;//没有数据
	}

	echo(json_encode($allInfo));
    mysql_close();  
?> 