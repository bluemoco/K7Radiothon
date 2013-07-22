<?php 
	include("common.php"); 
	include("session_active.php");
	
	if(isset($_GET['id']))
	{ 
		$_SESSION['cid'] = $_GET['id'];
		$qry = mysql_query("Select * from clientinfo as c ,  town as t WHERE c.TownID = t.TownID AND c.`index` ='".$_SESSION['cid']."'");
		$row = mysql_fetch_array($qry);		
		$_SESSION['name'] = $row['FirstName']. " " . $row['LastName'];
		$_SESSION['town'] = $row['TownName'];
		$_SESSION['an'] = $row['Anonymous'];		
		header("location:itemlist.php");	
	}
	
	if(isset($_GET['rst']))
	{ 
		unset($_SESSION['cid']);
		unset($_SESSION['admin']);
		unset($_SESSION['name']);
		unset($_SESSION['town']);
		unset($_SESSION['an']);
		header("location:itemlist.php");	 
	}
	
	if(isset($_GET['admin']))
	{ 
		$_SESSION['admin'] = $_GET['admin'];
		header("location:itemlist.php");
	}
	
	
?>

<!doctype html>

<head>

<?php default_js_css(); ?>	

	
<script>
$(document).ready(function(){  
	 jQuery('.btn').removeClass('btn-primary');	 
	 
	  <?php if(isset($_SESSION['admin'])) { ?>  jQuery('#btn4').removeClass('btn-inverse');	  jQuery('#btn4').addClass('btn-primary');  <?php } else { ?>
      jQuery('#btn2').removeClass('btn-inverse');	  jQuery('#btn2').addClass('btn-primary'); <?php } ?>
});
</script>

</head>


<body>

	<div class="main-header">
		<?php include('header.php'); ?>
    </div>
    <div class="clearfix"></div>
	
   
   <div class="container">   
   
   <div class="subheads">Placing a bid </div>
   
   <div class="matter">
   <div class="fheading"><h1><?php  if(isset($_SESSION['name'])) { echo 'You have selected:'.$_SESSION['name'];} ?></h1></div>
   
   <div class="row-fluid">
   <div class="span8">
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
   
   <?php if(isset($_SESSION['admin'])) { ?>
   <div class="span4 left-border">
    <div class="row-fluid">
     <div class="span6" style="margin-left:60px;">
    <div class="text-center"><a href="new_item.php"> <h2>Add new Item</h2>
     <img src="images/biltong.jpg" alt="add"></a>   </div>
   </div>
   </div>
   </div>
   <?php } ?>
   </div>
   <div class="clearfix"></div>
   <hr>
   <div class="row-fluid">
   <table class="table table-striped table-hover">
	  <thead>
		<tr>
		  <th>Telephone</th>
		  <th>Item Name</th>
		  <th>Town</th>
		  <th>current bid</th>
		 <?php if(isset($_SESSION['admin'])) { echo '<th>Edit</th>'; } ?>
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
					$q = "select a.*, t.* from auctionitems as a LEFT JOIN town as t ON a.TownID = t.TownID ";
			$qurey_string = "";
			if(isset($_GET['phone'])) {
				$q .= "WHERE a.TelephoneNumber like '%".$_GET['phone']."%'";
				$qurey_string = "?phone=".$_GET['phone'];
			} 
			$q .= " ORDER BY a.AucID DESC";

			$o__pager = new pager('auctionitems', $page, NUM_PAGE ,array(), $q);
			$client = $o__pager->getQuery();			 

		 while ($arrclient = mysql_fetch_assoc($client)):
		 
		 $client1 = mysql_query("select a.* , b.* , c.* , t.* , MAX(b.Amount) as amnt from auctionitems as a , bids as b , clientinfo as c , town as t 
	WHERE a.AucID = b.AucID AND b.ReceiptInfo = c.index AND c.TownID = t.TownID  AND a.AucID = '".$arrclient['AucID']."' Group by a.AucID");
	
	$arr = mysql_fetch_assoc($client1);
	
	 ?> 
	 	<tr>
		  <td><a href="new_bid.php?bid=<?php echo $arrclient['AucID']; ?>"><?php echo $arrclient['TelephoneNumber']; ?></a></td>
		  <td><?php echo $arrclient['ItemName']; ?></td>
		  <td><?php echo $arrclient['TownName']; ?></td>	   
		  <td>$<?php echo $arr['amnt']; ?></td>	   
		  <?php if(isset($_SESSION['admin'])) { ?> <td><a href="new_item.php?id=<?php echo $arrclient['AucID']; ?>" ><img src="images/edit.png" ></a></td>	<?php } ?>
		</tr>
	 <?php endwhile; ?>	
	  </tbody>
	</table>
   <div class="pagination pagination-right">
		<ul>
		<?php echo $o__pager->getPagerString('itemlist.php'.$qurey_string); ?>
		</ul>
	</div>
   </div>
   
   <!--section3-->
   <hr>
    
  <div class="clearfix"></div>
   
   </div>
   
   <!--section4-->
   
   </div>


    
    </div>
    
    
    <!--ribbon-->
<div class="ribbon">
<div class="container">
<h1>"Lorem Ipsum is simply dummy text of the printing and typesetting industry."</h1>
</div>
</div>
<!--/ribbon-->

<!--footer-->
<div class="footer">
	<?php include('footer.php'); ?>
</div>
<!--/footer-->

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