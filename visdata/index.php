<?php
include 'dbc.php';

require_once 'class/PHPdb.php';


$objPHPdb = new PHPdb();

$objPHPdb->tableUpdate();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Namibia Map Sales</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="layout.css" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/jquery-1.10.2.min.js"><\/script>')</script>
<script src="js/maxheight.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
<script src="js/Chart.js"></script>
<script src="js/awesomechart.js"></script>

    <script type="text/javascript">
        function circle_in(e){				
            var myVar="#sec_"+e.id;				
			$(myVar).show();     
			var mydata = "id=" + e.id;	
			
			$.ajax({			
			url: "ajax/makeGraph.php",
			type: 'POST',			
			dataType: 'html',	
			data: mydata,
			beforeSend: function() {},
			success: function(data, textStatus, xhr) {				
				$('.graph').html(data);				
			},
			error: function(xhr, textStatus, errorThrown) {
				alert("Load Failed!");
			}
			});

        }
        function circle_out(e){			
			var myVar;
			var myVar="#sec_"+e.id;			
			$(myVar).hide();			
		}
    </script>

	<style>
		canvas{
		}
	</style>
</head>

<body id="index_6" onload="new ElementMaxHeight();">

	<div id="header_tall">
		<div id="main">
			<!--header -->
			<div id="header">
				<div class="h_logo">
						<div class="left">
						<img alt="" src="images/logo.jpg" /><br />
					</div>
					<div class="right">
						<a href="#">RSS</a>				</div>
					<div class="clear"></div>
				</div>
				<div id="menu">
					<div class="rightbg">
						<div class="leftbg">
							<div class="padding">
								<ul>
									<li><a href="index.php">About us</a></li>
									<li><a href="index.php">Solutions</a></li>
									<li><a href="index.php">Products</a></li>
									<li><a href="index.php">Clients</a></li>
									<li><a href="index.php">Services</a></li>
									<li class="last"><a href="index.php">Contacts</a></li>
								</ul>
								<br class="clear" />
							</div>
						</div>
					</div>
				</div>
				<div class="content">
					<div class="text">
						<br />
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<!--header end-->
			<div id="middle" background>
				<div class="indent">
					<img alt="" src="images/map.png" width="100%"/><br/>			
                    <?php

					   $result = mysql_query("select * from target");
                       $num=1;
					   while($position = mysql_fetch_array($result))
					   {
						  $rate = $objPHPdb->getRate($num);                          
						  $sec_width =$rate * $position['width'];
						  $sec_height = $rate * $position['height'];
                          $sec_top = $objPHPdb->getTop($position['width'], $sec_width);
						  $sec_left = $sec_top;

						  $div_str_sec = "<div class=\"sec_circle\" id=\"sec_circle".$num."\" style=\"top:".$sec_top."px; left:".$sec_left."px; width:".
							   $sec_width."px; height:".$sec_height."px; \"></div>";

						  $div_str_first = "<div class=\"first_circle\" id=\"circle".$num."\" style=\"top:".$position['top']."px; left:".$position['left']."px;        width:".$position['width']."px; height:".$position['height']."px;\" tabindex = \"".$num."\" onmouseover=\"circle_in(this);\"    onmouseout=\"circle_out(this);\">".$div_str_sec."</div>";
						  
						  echo $div_str_first;
						  $num++;
					   }
					?> 										
                   <div class="graph">

				   </div>
				</div>
			</div>
			<!--footer -->
			<div id="footer">
				<div class="indent">
					&copy;2013 copyright &bull; <a href="index.php">Privacy Policy</a>				</div>
			</div>
			<!--footer end-->
		</div>
	</div>
</body>
</html>