<?php 
	include("common.php"); 
	include("session_active.php"); 
?>

<!doctype html>

<head>

<?php default_js_css(); ?>	

<script>
$(document).ready(function(){  
	 jQuery('.btn').removeClass('btn-primary');	 
 	 jQuery('#btn1').removeClass('btn-inverse');	  
	 jQuery('#btn1').addClass('btn-primary'); 
});
</script>
</head>

<body>

	<div class="main-header">
		<?php include('header.php'); ?>
    </div>
    <div class="clearfix"></div>
	
   
   <div class="container">  
   
   <div class="matter">
   <div class="fheading"><h1></h1></div>
    <div class="span8" style="width:676px">
    <div class="row-fluid">
   <!--form-->
   <div class="input-append" style="margin-top:70px;">
   <form name="search" action="" method="get">
  <input class="input-xxlarge" id="phone" name="phone" type="text" placeholder="Search Telephone Here..." value="<?php echo (isset($_GET['phone']) ? $_GET['phone'] : '') ?>">
  <button class="btn btn-inverse" type="submit"><img src="images/find.png" alt="find"></button>
 </form>
</div>
   <!--/form-->
   </div>
   </div>
   
	<div class="row-fluid">
   <table class="table table-striped table-hover">
	  <thead>
		<tr>
		  <th>Telephone</th>
		  <th>User Name</th>
		  <th>Town</th>
		</tr>
	  </thead>
	  <tbody>
	 <?php
			include('lib/pager.class.php');
			if(isset($_GET['page'])) {
				$page = $_GET['page'];
			} else {
				$page = 1;
			}
			
			$q = "select * from clientinfo as c LEFT JOIN town as t ON c.TownID = t.TownID ";
			$qurey_string = "";
			if(isset($_GET['phone'])) {
				$q .= "WHERE c.Phone like '%".$_GET['phone']."%'";
				$qurey_string = "?phone=".$_GET['phone'];
			} 
			$q .= " ORDER BY c.index DESC";
			
			$o__pager = new pager('clientinfo', $page, NUM_PAGE ,array(), $q);
			$client = $o__pager->getQuery();			 
		 while ($arrclient = mysql_fetch_assoc($client)):
	 ?> 
	 	<tr>	
		  <td><a href="itemlist.php?id=<?php echo $arrclient['index']; ?>"><?php echo $arrclient['Phone']; ?></a></td>		
		  <td><?php echo $arrclient['FirstName']. " " . $arrclient['LastName']; ?></td>
		  <td><?php echo $arrclient['TownName']; ?></td>
		</tr>
	 <?php endwhile; ?>	
	 
	  </tbody>
	</table>
   
	 	<div class="pagination pagination-right">
		<ul>
		<?php echo $o__pager->getPagerString('placebid.php'.$qurey_string); ?>
		</ul>
	</div>

   </div>
	
	
   </div>
   
    <div class="clearfix"></div>
 </div>
  
	<?php include('footer.php'); ?>

<!--Feet-->

<div class="feet">
<div class="container">
<p class="copy">Company Name Goes Here.. Copyright 2013. All Rights Researved. </p>

</div>
</div>

<!--/Feet-->








    <script src="js/bootstrap.min.js"></script>                 
</body>
</html>