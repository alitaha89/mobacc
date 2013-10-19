<?php
session_start();
include('../Connections/rs.php');
require_once('../functions.php');


if(isset($_REQUEST['id'])){
	
$userid = $_REQUEST['id'];	
include('../statement.php');


echoJson(array("true","Done","".(double) $data_today['sum']."","".(double) $data_monthly['sum']."","".(double) $data_all['sum'].""));
	
	
}else echoJson(array("false","request error","","",""));


?>