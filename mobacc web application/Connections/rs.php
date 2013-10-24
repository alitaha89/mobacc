<?php 

$hostname_rs = "localhost";
$database_rs = "mobacc";
$username_rs = "root";
$password_rs = "root";


$mobac_rs = mysql_pconnect($hostname_rs, $username_rs, $password_rs) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_select_db($database_rs);
mysql_set_charset('utf8',$mobac_rs);
?>