<?php
require_once('header.php');
if(!login())
{
	echo '</head><body>';
	include('ajax_login.php');
	echo '</body></html>';
	exit;
}
$userid = $_SESSION['uid'];

$query_user = "select *  from users where id=".$userid ;
$rs_user = mysql_query($query_user);
$data_user = mysql_fetch_assoc($rs_user);

$query_today = "select SUM(amount) as sum from expence where userid=$userid and `date`='".date('Y-m-d')."'";
$rs_today = mysql_query($query_today);
$data_today = mysql_fetch_assoc($rs_today);

$query_monthly = "select SUM(amount) as sum from expence where userid=$userid and `date` LIKE'".date('Y-m')."%'";
$rs_monthly = mysql_query($query_monthly);
$data_monthly = mysql_fetch_assoc($rs_monthly);

$query_all = "select SUM(amount) as sum from expence where userid=$userid ";
$rs_all = mysql_query($query_all);
$data_all = mysql_fetch_assoc($rs_all);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HOME-MOBACC</title>
</head>

<body>
    



<table class="page-title" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="80px">HOME</td>
                <td ></td>
                <td width="150px" ></td>
            </tr>
        </table>
    <div style="height:30px ">&nbsp;</div>
    <div id="success" align="center"></div>
    
    <div id="welcome-box">
    <h1>Welcome <?php echo ucwords($data_user['name']) ?></h1>
    <table border="0" width="100%" cellpadding="5">
    	<tr>
        	<td>Today Expence:</td>
            <td><?php echo (double) $data_today['sum'] ?> L.L</td>
        </tr>
        <tr>
        	<td>This Month (<?php echo date('F Y') ?>) Expence:</td>
            <td><?php echo (double) $data_monthly['sum'] ?> L.L</td>
        </tr>
        <tr>
        	<td>Total Expence:</td>
            <td><?php echo (double) $data_all['sum'] ?> L.L</td>
        </tr>
    </table>
    
    
    </div>
 
  
</body>
</html>