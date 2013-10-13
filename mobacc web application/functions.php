<?php


function secure($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
	
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
	  case "text1":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "''";
      break;  
	   case "text2":
      $theValue = ($theValue != "") ? $theValue  : "";
      break;     
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "0";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "0";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;


}



function objectToArray($d) {
	if (is_object($d)) {
		$d = get_object_vars($d);
	}
	if (is_array($d)) {
		return array_map(__FUNCTION__, $d);
	}
	else {
		return $d;
	}
}


function dologin($id){
	$_SESSION['login'] = true;
	$_SESSION['uid'] = $id;
}





function echoJson($array)
{
	header('Content-type: application/json');
	echo json_encode($array);
	exit();
}


function check_row($table ,$id)
{
	$query = "select id from $table where id=$id and cancelled=0";
	$rs = mysql_query($query);
	if(mysql_num_rows($rs)>0)
	{
		return true;
	}else
	return false;
}


function login()
{
	if($_SESSION['login']==true)
	return true;
	else return false;
}



function  echoSortTd($page,$db_val,$val,$sort_array,$td_width=false,$extra_get='')
{
?>
	
	<td <?php if($td_width)  echo 'width="'.$td_width.'"'; ?> class="clk" href="<?php echo 'ajax_'.$page.'.php?sort='. $db_val.$extra_get;  if($_SESSION['sort'][$_SERVER['PHP_SELF']]==$db_val) echo '&sort_d='.$sort_array[$_SESSION['sort_d'][$_SERVER['PHP_SELF']]]; ?>" >
          
           		<div class ="<?php  if($_SESSION['sort'][$_SERVER['PHP_SELF']]==$db_val) echo'sort '.$sort_array[$_SESSION['sort_d'][$_SERVER['PHP_SELF']]].' ' ;?>"> <?php echo $val; ?> </div>
            </td>
<?php
	
	
}



function getBrowser() 
{ 
    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
    
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 
    
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
    
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
    
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
    
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
} 

?>