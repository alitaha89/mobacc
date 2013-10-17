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
$quering="";

if(isset($_GET['cat']) and !empty($_GET['cat'])){
	
	$quering .= " and cat=".secure($_GET['cat'],'text1');
	
}

if(isset($_GET['dateFrom']) and !empty($_GET['dateFrom'])){
	
	$quering .= " and date>=".secure($_GET['dateFrom'],'text1');
	
}

if(isset($_GET['dateTo']) and !empty($_GET['dateTo'])){
	
	$quering .= " and date<=".secure($_GET['dateTo'],'text1');
	
}
if(isset($_GET['description']) and !empty($_GET['description'])){
	
	$quering .= " and description LIKE '%".secure($_GET['description'],'text2')."%'";
	
}

$queryStat = "select date,SUM(amount) as amnt from depence where userid=$userid $quering group by date ";
$rsStat = mysql_query($queryStat);
$dataStat = mysql_fetch_assoc($rsStat);
$stat =$dataStat['amnt'];
$oldtime =strtotime($dataStat['date']);
$startingtime = $oldtime;
$daylength = 86400;
while($dataStat = mysql_fetch_assoc($rsStat)){

	$timenow = strtotime($dataStat['date']);
	$diff = abs(floor(($timenow -$oldtime)/$daylength)) ;
	
	if($diff>1){
		
		for($i=1;$i<$diff;$i++){
			$stat.=",0";
		}
	}
	
	$stat.=",".$dataStat['amnt'];
	$oldtime=$timenow; 
}
$queryTotal = "select SUM(amount) as amnt from depence where userid=$userid $quering ";
$rsTotal = mysql_query($queryTotal);
$dataTotal = mysql_fetch_assoc($rsTotal);
$total = $dataTotal['amnt'];

$statCat = "";
$queryStatCat = "select cat,SUM(amount) as amnt from depence where userid=$userid $quering group by cat ";
$rsStatCat = mysql_query($queryStatCat);
while($dataStatCat = mysql_fetch_assoc($rsStatCat)){
	$statCat.="['".$dataStatCat['cat'].": [ ".$dataStatCat['amnt']." L.L ] ',".round($dataStatCat['amnt']*100/$total,2)."],";
	
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Highcharts</title>
        
        <style>
		svg text tspan[x='1190']
		{
			opacity:0;
			display:none;
		}	
		</style>

		
		<script type="text/javascript">
$(document).ready(function(){
	
$('#dateFrom').datepicker({changeYear:true, changeMonth:true,yearRange: '2013:c+2',dateFormat:'yy-m-d'});
$('#dateTo').datepicker({changeYear:true, changeMonth:true,yearRange: '2013:c+2',dateFormat:'yy-m-d'});

//Highcharts.getOptions().colors=Array();
        $('#container').highcharts({
            chart: {
                zoomType: 'x',
                spacingRight: 20
            },
            title: {
                text: 'Daily Expence L.L'
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                    'Click and drag in the plot area to zoom in' :
                    'Pinch the chart to zoom in'
            },
            xAxis: {
                type: 'datetime',
                maxZoom: 7 * 24 * 3600000, // fourteen days
                title: {
                    text: null
                }
            },
            yAxis: {
                title: {
                    text: 'Expence Amount L.L'
                }
            },
            tooltip: {
                shared: true
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    lineWidth: 1,
                    marker: {
                        enabled: false
                    },
                    shadow: false,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },
    
            series: [{
                type: 'area',
                name: 'Amount L.L',
                pointInterval: 24 * 3600 * 1000,
                pointStart: Date.UTC(<?php echo date('Y',$startingtime) ?>, <?php echo date('m',$startingtime)-1 ?>, <?php echo date('d',$startingtime) ?>),
                data: [<?php echo $stat; ?>]
            }]
        });

    	
    	// Radialize the colors
		if(!colorRadialized && false){
		Highcharts.getOptions().colors = Highcharts.map(Highcharts.getOptions().colors, function(color) {
		    return {
		        radialGradient: { cx: 0.5, cy: 0.3, r: 0.7 },
		        stops: [
		            [0, color],
		            [1, Highcharts.Color(color).brighten(-0.3).get('rgb')] // darken
		        ]
		    };
		});
		colorRadialized = true;
		}
		// Build the chart
        $('#container2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Amount Expence Percentage by Categorie'
            },
            tooltip: {
        	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
                        }
                    }
                }
            },
            series: [{
                type: 'pie',
                name: 'Categorie Percentage',
                data: [<?php echo $statCat; ?>]
            }]
        });
    });
    



		</script>
	</head>
	<body>
        <table class="page-title" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="65px">Statistics</td>
                <td ></td>
                <td width="150px" ></td>
            </tr>
        </table>
<form  id="statistics_form">
<table class="form" cellpadding="5px" style="display: block;margin-top:15px">
                    <tr>
                        <td>From:</td>
                        <td><input type="text" name="dateFrom" id="dateFrom" value="<?php echo $_GET['dateFrom'] ?>" size="" class="input-text"  alt="" />
                                </td>
                        
                   
                        <td>To:</td>
                        
                        <td><input type="text" name="dateTo" id="dateTo" value="<?php echo $_GET['dateTo'] ?>" size="" class="input-text"  alt="" /></td>
                        <td>Category:</td>
                        
                        <td><select name="cat"><option></option><option></option><option></option><option></option></select></td>
                        <td>Description:</td>
                        <td><input type="text" name="description" id="description" value="<?php echo $_GET['description'] ?>" size="" class="input-text"  alt="" /></td>
                    
                        <td></td>
                        <td><input type="submit" class="btn fr" value="View" /></td>
                       
                    </tr>
                    </table>
</form>
<script>
$('#statistics_form').submit(function() {
  window.location.hash='!statistics.php?'+$(this).serialize();
  return false;
});
</script>

<div id="container" style="min-width: 400px; height: 400px; margin: 100px auto"></div>
<div id="container2" style="min-width: 400px; height: 400px; margin: 100px auto"></div>
	</body>
</html>
