<?php
        include '../dbc.php';

		$id = array("circle1","circle2","circle3","circle4","circle5","circle6","circle7","circle8","circle9","circle10","circle11"
		             ,"circle12","circle13","circle14","circle15","circle16","circle17","circle18","circle19","circle20");
?>

    <canvas id="chartCanvas" width="200" height="400"></canvas>

	<script>
           var chart = new AwesomeChart('chartCanvas');		  		   
<?php
			$index =$_POST['id'];
			for($i = 1; $i<=count($id); $i++)
			{
				if($index == $id[$i-1])
					$num = $i;
			}
			
			$sql = "select * from sales where no = '$num'";
			$result = mysql_query($sql) or die("failed:".mysql_error());
			$sale = mysql_fetch_array($result);

			$target_sale = $sale['target_sale'];
			$actual_sale = $sale['actual_sale'];             
			$city_name = $sale['city_name'];
			echo "chart.data = [". $target_sale.",".$actual_sale."];";			

?>
     //chart.chartType = "horizontal bars";
	 
     chart.colors = ['#006CFF', '#FF6600'];
	 chart.randomColors = true;
     chart.animate = true;
	 chart.animationFrames = 30;
     chart.draw();
	
	</script>

    <div class="graph2"><p><h2 id="city_name"><?php echo $city_name; ?> </h2></div>
	<div class="graph2"><p><h3 id="target_name">Target</h2></div>
	<div class="graph2"><p><h3 id="actual_name">Actual</h2></div>

	        
            
            
           
            
            