<?php


require_once('header.php');

if(!login())
{
	echo '</head><body>';
	include('ajax_login.php');
	echo '</body></html>';
	exit;
}

$maintable = "expence";



$securequery = "userid=".$_SESSION['uid'];






if(isset($_POST['id']) && !empty($_POST['id']))
{
	$quering = "and id =".secure($_POST['id'],'int');
}

if(isset($_POST['action']) && $_POST['action']=='del')
{
	
	$query ="delete from $maintable where $securequery and id = ".secure($_POST['delid'],'int');
	if(mysql_query($query))
	{
		echo '1';
	}else
	{
		die("error");
	}
}
if(isset($_POST['formaction']) && ($_POST['formaction']=='insert' || $_POST['formaction']=='update') )
{
	if($_POST['formaction']=='update')
	{
		 $querytoadd = "where $securequery and id=". secure($_POST['formid'],'id')."  ";
	}else{
	$querytoadd = ",".$securequery ;
	}
	
	
	$query = $_POST['formaction']." $maintable set merchant=".secure($_POST['merchant'],'text1')." , `date` =".secure($_POST['date'],'text1')." ,amount=".secure($_POST['amount'],'text1').",cat=".secure($_POST['cat'],'text1').",description=".secure($_POST['description'],'text')."        $querytoadd ";
	
	
	
mysql_query($query);
	
}


$querysort = sprintf($querysort,$maintable.'.');


$query = "select * from $maintable where $securequery  $quering  $querysort";
$rs = mysql_query($query);
while($data = mysql_fetch_assoc($rs))
{
	
	$return[] = array('id'=>$data['id'],'merchant'=>$data['merchant'],'cat'=>$data['cat'],'amount'=>$data['amount'],'description'=>$data['description'],'date'=>$data['date']);
	
}



if($_GET['datatype']=='json')
{
	
	echoJson($return);
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Expence</title>
</head>

<body>
        <table class="page-title" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="115px">EXPENCES</td>
                <td ></td>
                <td width="150px" ></td>
            </tr>
        </table>
    <div style="height:50px ">&nbsp;</div>
    
    <div style="position:relative;overflow:hidden">
    <table class="grid"  id="expence_grid" >
    	<tr >
        
        <?php
		echoSortTd('expence','id','ID',$sort_array);
		echoSortTd('expence','merchant','Merchant',$sort_array); 
		echoSortTd('expence','cat','Category',$sort_array); 
		echoSortTd('expence','amount','Amount L.L',$sort_array); 
		echoSortTd('expence','description','Description',$sort_array); 
		echoSortTd('expence','date','Date',$sort_array); 
		
		?>

        </tr>

       <tr id="grid-tr-footer">
        	<td colspan="8" class="grid-footer">
            	<div class="grid-edit" ref="form-lightbox">Edit Selected Row</div>
                <div class="grid-add" ref="form-lightbox">Add A New Record</div>
                <div class="grid-del" >Delete Selected Row</div>
            </td>
           
        </tr>
        
        
        
    </table>
    
    <div class="grid-loader" ><div></div></div>
    </div>
    <table class="lightbox" id="form-lightbox">
    	<tr>
        	<td align="center">
            
  <!--------------------------- lightbox content ------------------------------------------------->
  
  <div class="lightbox-container">
    <div class="lightbox-head">
    	<div class="lightbox-title"  >Expence</div>
        <div class="lightbox-close"  >&times;</div>
    </div>
      <div class="lightbox-content" >
      <div class="lightbox-loader"></div>
      <form id="lightbox-form" action="" method="post">
      <input type="hidden" name="formaction" id="formaction" value="insert" />
      <input type="hidden" name="formid" id="formid" value="" />
            	<table class="form" cellpadding="5px" style="display: block;">
                    <tr>
                        <td>Merchant</td>
                        <td><input type="text" class="input-text required" name="merchant" id="f-merchant"  /></td>
                        
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td><input type="text" class="input-text required" name="date" id="f-date"  /></td>
                        
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td><input type="text" class="input-text" name="amount" id="f-amount" alt="999999999.9999999999999999" /><script>$('#f-amount').setMask()</script></td>
                        
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td><select name="cat" id="f-cat" class="select">
                        <option value="Food">Food</option>
                        <option value="Transport">Transport</option>
                        <option value="Restaurant">Restaurant</option>
                        <option value="Entertainment">Entertainment</option>
                       <option value="Other">Other</option>
                        </select></td>
                        
                    </tr>
                    <tr>
                        <td>Descritption</td>
                        <td><textarea name="description" id="f-description"></textarea></td>
                        
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="submit" class="btn fr" value="Submit" /></td>
                       
                    </tr>
			</table>
            </form>
        </div>
        </div>
        
        
        
        
        </td>
        </tr>
    </table>
<script type="text/javascript">
$('#f-date').datepicker({changeYear:true, changeMonth:true,yearRange: '2013:c+2',dateFormat:'yy-m-d'});
function gridPreparation()
{
	$('.tr-data').click(function()
	{
		$('.tr-data').removeClass('tr-selected')
		if($(this).hasClass('tr-selected'))
		$(this).removeClass('tr-selected')
		else
		$(this).addClass('tr-selected');
	});
}
function loadgrid(data)
{
	$('.tr-data').remove();
	var i =0
	
	var b ;
	while(b = data[i])
	{

		$('#grid-tr-footer').before('<tr id="tr-'+b.id+'" ref="'+b.id+'" class="tr-data"><td>'+b.id+'</td><td> '+b.merchant+'</td><td>'+b.cat+'</td><td>'+b.amount+'</td><td>'+b.description+'</td><td>'+b.date+'</td></tr>');
		i++;
		
	}
	$('.grid-loader').hide();
	
}
var data = <?php  echo json_encode($return)?>;

evaldata = eval(data);
loadgrid(evaldata)
gridPreparation()











function ajaxSubmit(form)
{
	$('.grid-loader').show();
	$.post('ajax_expence.php?datatype=json&action=edit',$(form).serializeArray(),function(data)
	{
		loadgrid(data)
		gridPreparation()
		
		
	});
	hideLightbox($(form))
	
}
$('#lightbox-form').validate({
   submitHandler: function(form) {
     ajaxSubmit(form);
   }
});

function filForm(data)
{
	$('#formaction').val('update')
	$('#formid').val(data[0].id)
	$('#f-merchant').val(data[0].merchant);
	$('#f-date').val(data[0].date);
	$('#f-amount').val(data[0].amount);
	
	
	$('#f-cat option').removeAttr('selected');
	$('#f-cat option[value="'+data[0].cat+'"]').attr('selected','selected');
	$('#f-description').val(data[0].description)
	
}

function showLightbox(lightboxId,id)
{

	if(id>0)
	{
		$('.lightbox-loader').show();
		$.post("ajax_expence.php?datatype=json",{id:id},function(data){
			
			filForm(data)
			$('.lightbox-loader').hide();
			})
	}
	$('#'+lightboxId).show().animate({opacity:1},200)
	

}


/////////// footer function////////lightbox/////////////////////////////
function hideLightbox(selector)
{
	var lightbox =  selector.closest('table.lightbox');
	lightbox.find('form').get(0).reset();
	lightbox.animate({opacity:0},200,function()
	{
		lightbox.hide();
	})
  return false;
}
$('.lightbox-close').click(function()
{
	hideLightbox($(this))
});


$('.grid-add').click(function()
{
		$('#formaction').val('insert')
	$('#formid').val()
	showLightbox($(this).attr('ref'));
});



$('.lightbox').show()

if((window.innerHeight-100) < $('.lightbox-content').height())
{
	$('.lightbox-content').css('height',(window.innerHeight-100))
	//$('.lightbox-content').({autohide:true})
}
$('.lightbox').hide()

///////////////////lightbox/////////////////////////////

$('.grid-edit').click(function()
{
	
	if($('.tr-selected').length>0)
	showLightbox($(this).attr('ref'),$('.tr-selected').attr('ref'));
	else
	{
		showAlertLightbox('you must select row')
	}
});
function dellrow()
{
		var delId = $('.tr-selected').attr('ref');
				var delrowId = $('.tr-selected').attr('id');
				$('.tr-selected').animate({opacity:0},300,function(){
					$(this).hide();
					});
				$.post('ajax_expence.php',{delid:delId,action:'del'},function(data)
				{
					
					if(data=='error')
					{
						$('#'+delrowId).animate({opacity:1},300,function(){$(this).show()})
						showAlertLightbox('internal error'+delrowId);
					}
					
				});
}
$('.grid-del').click(function()
{
	
	if($('.tr-selected').length>0)
	{
		showConfirmLightbox('dellrow()');
		
	}
	else
	{
		showAlertLightbox('you must select row')
	}
});

</script>
</body>
</html>