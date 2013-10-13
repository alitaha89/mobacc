<?php
require_once('header.php');

if($_SESSION['all_branches'])
{
	$query = "update branches set `status`=0 where restaurants_id=".$_SESSION['resid'];
}else
{
	$query = "update branches set `status`=0 where id=".$_SESSION['branches_id'];

}
mysql_query($query,$iorder_rs);

session_destroy();
header('Location: index.php')
?>
<script>window.location ='index.php';</script>
<a href="index.php">Main</a>