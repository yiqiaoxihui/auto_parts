<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
     $conn=mysql_connect("localhost","root","") or die("数据库服务器连接错误".mysql_error());
     mysql_select_db("auto_parts",$conn) or die("数据库访问错误".mysql_error());
     
	 mysql_query("SET NAMES 'utf8'");
?>
