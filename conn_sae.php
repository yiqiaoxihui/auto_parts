<?php
$con = 
mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,SAE_MYSQL_USER,SAE_MYSQL_PASS);if(!$con){ die('could
 not connect:'.mysql_error()); }mysql_select_db(SAE_MYSQL_DB,$con);
?>
