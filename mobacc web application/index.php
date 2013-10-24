<?php
require_once('header.php');
/*
$i=0;
$a = array('Food','Transport','Restaurant','Entertainment','Other');
while($i<1500){
	
	
	
	$qeury = "insert into expence set cat='".$a[rand(0,4)]."' ,amount='".(rand(1,1000)*250)."', date='".date('Y-m-d',(strtotime(date('Y-m-d'))+($i*rand(10000,30000))))."' ,userid=1";
	mysql_query($qeury);
	$i++;
}
*/

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css" />
<title>MOBACC</title>
<script src="Scripts/jquery-1.7.min.js"  type="text/javascript" language="javascript"></script>
<script src="Scripts/jquery.validate.min.js" type="text/javascript" language="javascript"></script>
<script type="text/javascript" language="javascript" src="Scripts/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" language="javascript" src="Scripts/highcharts.js"></script>
 
                             

<?php 

if(!login())
{
	echo '</head><body>';
	include('ajax_login.php');
	echo '</body></html>';
	exit;
}



?>


<script language="javascript" src="Scripts/jquery.meio.mask.js"></script>

	
<script>

 


var colorRadialized = false;


$(document).ready(function(){

$(window).bind( 'hashchange', function(e) {
		
		
		
		$('.primary_menu').removeClass('primary_menu_selected');
		currentAnchor = document.location.hash;
		var splits = currentAnchor.substring(1).split('?');
		a_url= splits[0].substring(1);
		var a_params= splits[1];
		
		
		
		
		if(document.location.hash=='' || document.location.hash=='#!home.php' ){
			
			loadPage('home.php','','page','loader');
		
		}else{
		
			loadPage(a_url,a_params,'page','loader');
		

		}
	

	});
	
$(window).trigger( 'hashchange' ) 
});


function loadPage(url,params,placeholder,loader){

	var milliseconds = new Date().getTime();
	
	if(loader!=''){
	
		
		  $("#"+loader).show().animate({opacity:1},400)
	}
	
	$("html, body").animate({ 'scrollTop':'0' },500);
	$('body').css({ 'cursor': 'progress' });
	$.post('ajax_'+url+'?t='+milliseconds+'&'+params, { },  
	  function(data) { 
	  	  
		  $('#'+placeholder).html(data);
		  footer_function();
		 
		  
		  $('body').css({ 'cursor': 'auto' });
		  if(loader!=''){
			  
			
			
			
			  	$("#"+loader).animate({opacity:0},0).hide()
			
		  }
	  });
	
	
}


function dfooter()
{
	
	if($('body').height()> $(window).height())
	{
		$('#footer').css({position:'static'})
		$('.grid-footer').addClass('fixed')
	}else
	{
		$('#footer').css({position:'absolute'})
		$('.grid-footer').removeClass('fixed')
	}
	if($(document).height()> $(window).height())
	{
		$('#footer').css({position:'static'})
		$('.grid-footer').addClass('fixed')
	}
	
	
}
setTimeout('dfooter()',5000);
function footer_function()
{
$('.clk').click(function(){document.location.hash=$(this).attr('href').replace('ajax_','!');
return false;
});
dfooter();
$(window).scroll(function () {
  var st = $(window).scrollTop();
  var scrollBottom = $(document).height() - $(window).height() - $(window).scrollTop();

	if(scrollBottom<100){
 	$('.grid-footer').removeClass('fixed')
	}else
	{
		$('.grid-footer').addClass('fixed')
	}
});



}


			
</script>
<style>
body
{
	margin:0;
	
}


</style>
</head>



<body>

<div align="center" id="header"> 
<div align="left"  style="width:1200px;">



<a href="index.php"><img src="img/logo.jpg" id="logo" height="80"/></a><img src="img/loader.gif" style="margin-top:13px;" id="loader" />

<div id="menu">

<a class="primary-menu clk" href="ajax_home.php">Home</a>
<a class="primary-menu clk" href="ajax_expence.php">Expence</a>
<a class="primary-menu clk" href="ajax_statistics.php">Statistics</a>

<a class="primary-menu" href="logout.php">Logout!</a>


    
   
    
    
   
	</div>
</div>
<script>
$('div.primary-menu').mouseenter(function()
{
	$(this).find('.ddm').show().animate({opacity:1},200);
});
$('div.primary-menu').mouseleave(function()
{
	$(this).find('.ddm').css('opacity',0).hide();
});
</script>

</div>






</div>

<div align="center">
	<div align="left" style="width:1200px;" id="page">

    </div>


</div>
<div align="center" >
	<div align="center" id="footer" >
		Web Design And Development by <span title="70504094">ALI TAHA</span>
    </div>


</div>
<table class="lightbox" id="confirm-lightbox" >
    	<tr>
        	<td align="center"> <div class="lightbox-content" style="height:90px;width:420px;" >
            	<div class="fl form" >
                	<div id="confirm-message"  class="warn-msg">Are you sure you want to delete this record?</div>
                    <input type="button" class="btn fl" value="Delete Record" id="confirm-accept" onclick=""/>
                    <input type="button" class="btn fl" value="Cancell" style="background-color: #8E8C8D;" onclick="hideConfirmLightbox()" />
               	</div>
            <img class="fr" src="img/warning.png" style="margin-top:25px;"/>
            </div>
            </td>
        </tr>
</table>
<table class="lightbox" id="alert-lightbox" >
    	<tr>
        	<td align="center"> <div class="lightbox-content" style="height:90px;width:420px;" >
            	<div class="fl form" >
                	<div id="alert-message" class="warn-msg">An error occured.</div>
                    <input type="button" class="btn fl" value="OK" onclick="hideAlertLightbox()"/>
                   
               	</div>
            <img class="fr" src="img/error.png" style="margin-top:25px;"/>
            </div>
            </td>
        </tr>
</table>
<script>
function showConfirmLightbox(onclk)
{
	
	$('#confirm-lightbox').css('display','table').animate({opacity:1},200)
	$('#confirm-accept').attr('onclick',onclk+';hideConfirmLightbox()');
	
}
function hideConfirmLightbox()
{
	$('#confirm-accept').attr('onclick','');
	$('#confirm-lightbox').animate({opacity:0},200,function(){$(this).hide()})
	
}
function showAlertLightbox(txt)
{
	$('#alert-message').html(txt);
	$('#alert-lightbox').css('display','table').animate({opacity:1},200)
	
	
}
function hideAlertLightbox()
{
	$('#alert-message').html('&nbsp;');
	
	$('#alert-lightbox').animate({opacity:0},200,function(){$(this).hide()})
	
}

			

footer_function();</script>
</body>
</html>