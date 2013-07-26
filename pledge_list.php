<?php 
	include("common.php"); 
	include("session_active.php"); 
	
	if(isset($_GET['id']))
	{ 
		$qry = mysql_query("Select * from clientinfo as c ,town as t ,pledges as p WHERE c.TownID = t.TownID AND c.`index` = p.ReceiptInfo AND c.`index` ='".$_GET['id']."'");
	}
	
?>

<!doctype html>

<head>

<?php default_js_css(); ?>
	
<script>
$(document).ready(function(){  
	jQuery('.btn').removeClass('btn-primary');	 
 	 jQuery('#btn3').removeClass('btn-inverse');	  
	 jQuery('#btn3').addClass('btn-primary');
});
</script>

</head>


<body>

	<div class="main-header">
		<?php include('header.php'); ?>
    </div>
    <div class="clearfix"></div>
	
   
   <div class="container">   
   
   <div class="subheads">Pledge</div>
   
   <div class="matter">
   <div class="fheading"><h1></h1></div>
   
   <div class="clearfix"></div>
   <hr>
   <div class="row-fluid">
   <table class="table table-striped table-hover">
	  <thead>
		<tr>
		  <th>Telephone</th>
		  <th>User Name</th>
		  <th>Town</th>
		  <th>Donation Amount</th>
		</tr>
	  </thead>
	  <tbody>
	 <?php		
		 while ($arrclient = mysql_fetch_assoc($qry)):
	 ?> 
	 	<tr>
		  <td><?php echo $arrclient['Phone']; ?></td>		
		  <td><?php echo $arrclient['FirstName']. " " . $arrclient['LastName']; ?></td>
		  <td><?php echo $arrclient['TownName']; ?></td>
		  <td>$<?php echo $arrclient['Amount']; ?></td>		    
		</tr>
	 <?php endwhile; ?>	
	 
	  </tbody>
	</table>

   </div>
   
   <!--section3-->
   <hr>
    
  <div class="clearfix"></div>
   
   </div>
   
   <!--section4-->
   
   </div>


    
    </div>
    
  
<?php include('footer.php'); ?>

<!--/footer-->


    <script src="js/bootstrap.min.js"></script>                 
</body>
</html>