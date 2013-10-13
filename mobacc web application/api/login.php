<?php
session_start();
include('../Connections/rs.php');
require_once('../functions.php');
if(isset($_REQUEST['username']) && isset($_REQUEST['pass'])){


	$query_login = "select id,name from users where username=".secure($_REQUEST['username'],"text1")." and pass= '".md5($_REQUEST['pass'])."' limit 1";
	if($rs_login = mysql_query($query_login)){
		if(mysql_num_rows($rs_login)>0)
		{
			$data_login = mysql_fetch_assoc($rs_login);
			if(isset($_GET['source']) && $_GET['source']=="browser"){
				
				dologin( $data_login['id']);
			}
			echoJson(array("true","Welcome ".ucwords($data_login['name']),'"'.$data_login['id'].'"'));
			
		}else{
			
			echoJson(array("false","error username/password combination",""));
		
		}
	}else 	echoJson(array("false","internal error",""));
	
	
}else echoJson(array("false","request error",""));


?>