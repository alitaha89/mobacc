<?php

include('../Connections/rs.php');
require_once('../functions.php');


$_GET['data'] = "[".str_replace("}{","},{",$_GET['data'])."]";

$data  = json_decode($_GET['data']);
$dataall = objectToArray($data);
foreach($dataall as $row){

	$query = "insert into depence set userid ='".secure($row['userid'],'int')."',cat='".secure($row['cat'],'text1')."',description='".secure($row['description'],'text1')."',`date`='".secure($row['date'],'text1')."',merchant='".secure($row['merchant'],'text1')."',amount='".secure($row['amount'],'text1')."'ß";
	mysql_query($query); 	


}






?>