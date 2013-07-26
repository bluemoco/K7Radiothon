<?php 
error_reporting(0);
session_start();


include("config/connect.php");
define('NUM_PAGE' , 30);
function default_js_css() { ?>   

	<!-- Paul Irish's technique for targeting IE, modified to only target IE6, applied to the html element instead of body -->
	<!--[if IE 6]><html lang="en" class="no-js ie6"><![endif]-->
	<!--[if (gt IE 6)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->
	<meta charset="utf-8">
	
	<title>Home</title>
	<link  href="style_new.css" rel="stylesheet" media="screen">
	<link href="css/bootstrap_new.css" rel="stylesheet" media="screen">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<!--<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>-->

<?php } 

function autocomplete()
{
	?>		
	
	<link rel="stylesheet" href="js/autocomplete/jquery.ui.autocomplete.css">
	<script src="js/autocomplete/jquery.ui.position.js"></script>
	<script src="js/autocomplete/jquery.ui.autocomplete.js"></script>
	
	
	<?php
}

function getAllDonnor() {
	$qry = mysql_query("select * from donnorinfo ORDER BY `index` ASC");
	$str .= "[";
	while($row = mysql_fetch_assoc($qry))
	{
		$str .= '"'.$row['FirstName']. " ".$row['LastName'].'",';
	}
	$str = substr($str, 0, strlen($str) - 1);
	$str .= "]"; 
	return $str;
	
}
?>

