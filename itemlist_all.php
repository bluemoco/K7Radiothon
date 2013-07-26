<?php 
	include("common.php"); 
	include("session_active.php");
	
	unset($_SESSION['cid']);
	unset($_SESSION['admin']);
	unset($_SESSION['name']);
	unset($_SESSION['town']);
	unset($_SESSION['an']);

?>

<!doctype html>

<head>

<?php default_js_css(); ?>	

	
<script>
$(document).ready(function(){  
	 jQuery('.btn').removeClass('btn-primary');	 	 
     jQuery('#btn2').removeClass('btn-inverse');
	 jQuery('#btn2').addClass('btn-primary');
});
</script>

</head>


<body>

	<div class="main-header">
		<?php include('header.php'); ?>
    </div>
    <div class="clearfix"></div>
	
   
   <div class="container">   
   
   <div class="subheads">Item List </div>
   
   <div class="matter">
   <div class="fheading"><h1><?php  if(isset($_SESSION['name'])) { echo 'You have selected:'.$_SESSION['name'];} ?></h1></div>
   
   <div class="row-fluid">
   <div class="span8" style="width:676px">
    <div class="row-fluid">
   <!--form-->
   <div class="input-append" style="margin-top:70px;">
   <form name="search" action="" method="get">
  <input class="input" id="phone" name="phone" type="text" placeholder="Search Telephone Here..." value="<?php echo (isset($_GET['phone']) ? $_GET['phone'] : '') ?>">&nbsp;&nbsp;&nbsp;
  <select name="town" id="town" >
  <option value="">--Select Town--</option>
  <?php 
  $o_q = mysql_query('SELECT * FROM town');
  while($town = mysql_fetch_assoc($o_q)):
  ?>
  
  <option value="<?php echo $town['TownID'] ?>" <?php echo ($town['TownID'] == $_GET['town']) ?"selected" :"" ?>><?php echo $town['TownName'] ?></option>
  <?php endwhile; ?>
  </select>
    
	  <input class="input" id="item" name="item" type="text" placeholder="Search Item Here..." value="<?php echo (isset($_GET['item']) ? $_GET['item'] : '') ?>">&nbsp;&nbsp;&nbsp;
  <button class="btn btn-inverse" type="submit"><img src="images/find.png" alt="find"></button>
  </form>
</div>
   <!--/form-->
   </div>
   </div>
  
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
		  <th>Reserve Price</th>
		  <th>current bid</th>
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
			if(isset($_GET['phone']) && trim($_GET['phone']) != "") {
				$q .= "WHERE a.TelephoneNumber like '%".$_GET['phone']."%'";
				$qurey_string = "?phone=".$_GET['phone'];
			} 
			if(isset($_GET['item']) && trim($_GET['item']) != "") {
				$q .=( (substr_count($q, 'WHERE') == 1)  ? " AND ": "WHERE " )."a.ItemName like '%".$_GET['item']."%'";
				$qurey_string .= ((substr_count($qurey_string, '?') == 1)  ? "&": "?" )."item=".$_GET['item'];
			} 
			if(isset($_GET['town']) && trim($_GET['town']) != "") {
				$q .= ((substr_count($q, 'WHERE') == 1)  ? " AND ": "WHERE " )."t.TownID = ".$_GET['town'];
				$qurey_string .= ((substr_count($qurey_string, '?') == 1)  ? "&": "?" )."town=".$_GET['town'];
			} 
			
			$q .= " ORDER BY a.AucID DESC";
			
			$o__pager = new pager('auctionitems', $page, NUM_PAGE ,array(), $q);
			$client = $o__pager->getQuery();			 

		 while ($arrclient = mysql_fetch_assoc($client)):
		 
		 $client1 = mysql_query("select a.* , b.* , c.* , t.* , MAX(b.Amount) as amnt from auctionitems as a , bids as b , clientinfo as c , town as t 
	WHERE a.AucID = b.AucID AND b.ReceiptInfo = c.index AND c.TownID = t.TownID  AND a.AucID = '".$arrclient['AucID']."' Group by a.AucID");
	
	$arr = mysql_fetch_assoc($client1);
	if($arr['amnt'] > 0 ) { 
		$amn = $arr['amnt']; 
	} else {
		$amn = "0.00";
	}
	 ?> 
	 	<tr>
		  <td><a href="new_bid.php?bid=<?php echo $arrclient['AucID']; ?>"><?php echo $arrclient['TelephoneNumber']; ?></a></td>
		  <td><?php echo $arrclient['ItemName']; ?></td>
		  <td><?php echo $arrclient['TownName']; ?></td>	   
		  <td>$<?php echo $arrclient['ReservePrice']; ?></td>
		  <td>$<?php if($amn == 0.00) { echo $arrclient['startprice']; } else { echo $amn; }; ?></td>	   
		</tr>
	 <?php endwhile; ?>	
	  </tbody>
	</table>
   <div class="pagination pagination-right">
		<ul>
		<?php echo $o__pager->getPagerString('itemlist_all.php'.$qurey_string); ?>
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
    
	<?php include('footer.php'); ?>









    <script src="js/bootstrap.min.js"></script>                 
</body>
</html>