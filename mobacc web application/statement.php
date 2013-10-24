<?php

$query_user = "select *  from users where id=".$userid ;
$rs_user = mysql_query($query_user);
$data_user = @mysql_fetch_assoc($rs_user);

$query_today = "select SUM(amount) as sum from expence where userid=$userid and `date`='".date('Y-m-d')."'";
$rs_today = mysql_query($query_today);
$data_today = @mysql_fetch_assoc($rs_today);

$query_monthly = "select SUM(amount) as sum from expence where userid=$userid and `date` LIKE'".date('Y-m')."%'";
$rs_monthly = mysql_query($query_monthly);
$data_monthly = @mysql_fetch_assoc($rs_monthly);

$query_all = "select SUM(amount) as sum from expence where userid=$userid ";
$rs_all = mysql_query($query_all);
$data_all = @mysql_fetch_assoc($rs_all);

?>