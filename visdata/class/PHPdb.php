<?php




class PHPdb
{
   public function tableUpdate()
	{
	   $sql_sales = "select * from sales order by target_sale";
	   $sql_target = "select * from target";
	   
	   $result_sales = mysql_query($sql_sales) or die("Failed:".mysql_error());
	   $result_target = mysql_query($sql_target) or die("Failed:".mysql_error());
       
	   $step = 5;
	   while($pos_sales = mysql_fetch_array($result_sales))
		{
            $pos_target = mysql_fetch_array($result_target);
            $width = $pos_target['width'];
			$height = $pos_target['height'];
          
		    $no = $pos_sales['no'];
		    $width = $width + $step;  $height = $height + $step;
			//mysql_query("update target set width='$width', height = '$height' where no='$no'");
			
			$step = $step+ 5;
		}
	}

	public function getRate($num)
	{
		$sql = "select * from sales where no='$num'";
		$result = mysql_query($sql) or die("Failed:".mysql_error());
		$res = mysql_fetch_array($result);
		$rate = $res['actual_sale'] / $res['target_sale'];
		return $rate;
	}

	public function getTop($first_width, $sec_width)
	{
		//$sec_width = round($sec_width);
        if($first_width > $sec_width)
		{
			$value = ($first_width - $sec_width)/2;
			$value = 0 + $value;
		}
		else
		{
			$value = ($sec_width - $first_width) / 2;
			$value = 0 - $value;
		}
		//$value = round($round);
		return $value;

	}

	
}

?>


