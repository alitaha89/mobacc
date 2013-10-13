<?php
session_start();sleep(4);
include('../Connections/rs.php');
require_once('../functions.php');
$return = array();
if(isset($_REQUEST['name']) &&isset($_REQUEST['username']) && isset($_REQUEST['pass'])){
	
	$query_check = "select * from users where username=".secure($_REQUEST['username'],"text1");
	
	if($rs_check = mysql_query($query_check)){
		if(mysql_num_rows($rs_check )>0){
			echoJson(array("false","username alredy exist",""));
			
		}else{
			
			$query_login = "insert into  users set name=".secure($_REQUEST['name'],"text1")." ,username=".secure($_REQUEST['username'],"text1")." , pass= '".md5($_REQUEST['pass'])."'";
			
			if( @mysql_query($query_login)){
				
				if(isset($_GET['source']) && $_GET['source']=="browser"){
					
					dologin($data['id']);

				}
				
				echoJson(array("true","Welcome ".ucwords($_REQUEST['name']),'"'.mysql_insert_id().'"'));
				
			}else{
				
				echoJson(array("false","internal error",""));
			
			
			}
		}
			
	}else{
			
			echoJson(array("false","internal error",""));
			
	}
}else{

		echoJson(array("false","request error",""));
}

?>