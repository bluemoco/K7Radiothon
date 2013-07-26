<?php 
	include("common.php"); 
	include("session_active.php"); 
	
	if(isset($_GET['bid']))
	{
		$_SESSION['bid'] = $_GET['bid'];
		header("location:new_bid.php");	
	}
	
	//$client = mysql_query("select a.* , b.* , MAX(b.Amount) as amnt from auctionitems as a LEFT JOIN bids as b ON a.AucID = b.AucID WHERE a.AucID = '".$_SESSION['bid']."' Group by a.AucID");
	
	$client = mysql_query("select a.* , b.* , c.* , t.*,b.Anonymous as bid_Anonymous , b.Amount as amnt from auctionitems as a , bids as b , clientinfo as c , town as t 
	WHERE a.AucID = b.AucID AND b.ReceiptInfo = c.`index` AND c.TownID = t.TownID  AND a.AucID = '".$_SESSION['bid']."' ORDER BY b.Amount DESC LIMIT 1");
	
	$cnt = mysql_num_rows($client);
	
	if($cnt == 0 )
	{
		$client = mysql_query("select a.* , b.* , c.* , t.* ,b.Anonymous as bid_Anonymous, b.Amount as amnt from auctionitems as a , bids as b , clientinfo as c , town as t 
		WHERE c.TownID = t.TownID  AND a.AucID = '".$_SESSION['bid']."' ORDER BY b.Amount DESC LIMIT 1");
		$arr = mysql_fetch_assoc($client);		
	}
	else
	{	
		$arr = mysql_fetch_assoc($client);
	}
	
	
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

<script>
function chk()
{
	if(isNaN(document.getElementById('Amount').value) == true || document.getElementById('Amount').value == '')
	{
		alert("Please Enter Amount");
		document.getElementById('Amount').focus();
		return false;		
	}	
	else
		jQuery.ajax({
    			 type:     'post',
			     dataType: 'html',
  			     success:   function(data)
				 {				
				 	if(data == "Bid Placed Successfully")
					{						
						//window.setTimeout("location='bidlist.php'",2500);
						
					}			
					$('#msg').html(data);
					$('#Amount').val('');				     
				 },
   				 data:   (jQuery('#frm').serialize()),
   				 url:    "ajaxform.php"
  		 });
  		 return false;

}

</script>	
<style type="text/css">
    .form-horizontal .controls{
        line-height: normal;
        padding: 5px;
    }
</style>
</head>


<body>

<div class="main-header">
 <?php include('header.php'); ?>
   </div>
    <div class="clearfix"></div>
   
   <div class="container">  
   
   <div class="subheads">Enter New Bid</div>
   
   <div class="matter">
   <div class="fheading"><h1><div style="text-align:center" id="msg" ></div></h1></div>
   <div class="row-fluid">
   <div class="span7">
   <!--form-->
   <form class="form-horizontal">
  	
  <div class="control-group">
    <label class="control-label" for="inputEmail">Current Bid: </label>
    <div class="controls"><?php if($cnt != 0 ) { echo "$".$arr['amnt']; } ?>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Highest Bidder: </label>
    <div class="controls">
       <?php if($cnt != 0 ) { echo $arr['FirstName'] . " " .$arr['LastName']; } ?>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Expires on: </label>
    <div class="controls">
       <?php echo date("d/m/Y H:i:s" , strtotime($arr['CloseDateTime'])); ?>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">ReservePrice: </label>
    <div class="controls">$<?php echo $arr['ReservePrice']; ?>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Description: </label>
    <div class="controls">
       <?php echo $arr['Description']; ?>
    </div>
  </div>
  
  
</form>
   <!--/form-->
   </div>
   <?php
 //echo date("Y-m-d H:i:s")." ". date("Y-m-d H:i:s",  strtotime($arr['CloseDateTime']));
 //print(date("Y-m-d H:i:s",  strtotime($arr['CloseDateTime'])) < date("Y-m-d H:i:s"));
   if(isset($_SESSION['cid']) && date("Y-m-d H:i:s",  strtotime($arr['CloseDateTime'])) > date("Y-m-d H:i:s"))
   { ?>
   <!--right side-->
   <form name="frm" id="frm" method="post" onSubmit="return chk()">
   <input type="hidden" name="bid" id="bid" value="bid" >
   <div class="span5">
   
	   <h1 style="text-align:center">Making a bid</h1>
	   	<div class="text-center">
		   <img src="images/client.png" alt="client">
		   <h2>Client Details</h2>
		   <h2 class="text-error"><?php echo $_SESSION['name']; ?></h2>
		   <p class="text-info"><?php echo $_SESSION['town']; ?></p>
		   
		   <p><input type="checkbox" name="Anonymous" id="Anonymous" value="1" ><em>Wishes to stay anonymous</em> </p>
			 <span class="label"><input type="text" name="Amount" id="Amount" style="width:80px; margin-bottom:0px" > </span>
			 <div class="clearfix"></div>
			 <button type="submit" class="btn btn-warning">Save</button> <button type="button" class="btn" onClick="window.location='new_bid.php';">Clear</button>
		   </div>
	   
   </div>
   </form>
   <!--/right side-->
   <?php } else { ?>
   
    <div class="span5" style="border:1px solid #CCCCCC; line-height:15px">
   
	   <h1 style="text-align:center">Highest Bidder details</h1><hr>
		<?php if($cnt != 0 ) { ?>
		
		<div class="text-center">
		   <h2 class="text-error"><?php echo $arr['FirstName'] . " " .$arr['LastName']; ?></h2>
		   <p class="text-info"><?php echo $arr['TownName']; ?></p>
		   <p class="text-info"><?php echo $arr['Phone']; ?></p>
		   <p class="text-info"><?php echo $arr['Email']; ?></p>
		   <!--<p>Anonymous -- <?php echo "<pre>";print_r($arr);echo "</pre>";?></p>-->
		   <p> <?php echo ($_SESSION['an'] == 1 || $arr['bid_Anonymous']==1) ?'<em>Wishes to stay anonymous</em>':''; ?> </p>
		 <?php } else { ?>	
                   <div class="text-center">
		   <h2 class="text-error">No bid placed for this item</h2>
		    
                   <?php } ?>
           <div class="clearfix"></div>
			
		 </div>
	   
   </div>
   
   <?php } ?>
   </div>
   <div class="clearfix"></div>
 
    <hr>
   
   </div>
    
    </div>
   
 
<?php include('footer.php'); ?>


    <script src="js/bootstrap.min.js"></script>                 
</body>
</html>