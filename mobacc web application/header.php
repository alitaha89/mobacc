<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
require_once('Connections/rs.php');
require_once('functions.php');

$return = array();
$querysort ="";
$sort_array = array('asc'=>'desc','desc'=>'asc',''=>'asc');
if(!isset($_SESSION['sort']))
{
$_SESSION['sort']=array();
}
if(!isset($_SESSION['sort_d']))
{
$_SESSION['sort_d']=array();
}
if(isset($_GET['sort']))
{
	$_SESSION['sort'][$_SERVER['PHP_SELF']] = secure($_GET['sort'],'text2');
	
	
	
	
}
if(isset($_GET['sort_d']) && ($_GET['sort_d']=='asc' || $_GET['sort_d']=='desc') )
{
	$_SESSION['sort_d'][$_SERVER['PHP_SELF']] = $_GET['sort_d'];
}



if(isset($_SESSION['sort'][$_SERVER['PHP_SELF']]) and !empty($_SESSION['sort'][$_SERVER['PHP_SELF']]))
{
	$querysort = "order by  `".$_SESSION['sort'][$_SERVER['PHP_SELF']].'` '.$_SESSION['sort_d'][$_SERVER['PHP_SELF']];
}


?>