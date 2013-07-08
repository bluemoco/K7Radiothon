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
		header("location:new_pledge.php");	
	}
	$qry = mysql_query("Select * from clientinfo as c ,  town as t WHERE c.TownID = t.TownID AND c.`index` ='".$_SESSION['cid']."'");
	$arr = mysql_fetch_array($qry);	
	
	
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
				 	if(data == "Pledge added Successfully")
					{						
						//window.setTimeout("location='pledgelist.php'",2500);
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
</head>


<body>

<div class="main-header">
 <?php include('header.php'); ?>
   </div>
    <div class="clearfix"></div>
   
   <div class="container">  
   
   <div class="subheads">Placing Pledge</div>
   
   <div class="matter">
   <div class="fheading"><h1><div style="text-align:center" id="msg" ></div></h1></div>
   <div class="row-fluid">
  
   <form name="frm" id="frm" method="post" onSubmit="return chk()">
   <input type="hidden" name="pledge" id="pledge" value="pledge" >
    <div class="span5" style="border:1px solid #CCCCCC">
   
	   <h1 style="text-align:center">Client Details</h1><hr>
	   	<div class="text-center" style="line-height:15px">
		   <h2 class="text-error"><?php echo $arr['FirstName'] . " " .$arr['LastName']; ?></h2>
		   <p class="text-info"><?php echo $arr['TownName']; ?></p>
		   <p class="text-info"><?php echo $arr['Phone']; ?></p>
		   <p class="text-info"><?php echo $arr['Email']; ?></p>
		   
		   <p> <?php echo ($_SESSION['an'] == 1)?'<em>Wishes to stay anonymous</em>':''; ?> </p>
		    <span class="label"><input type="text" name="Amount" id="Amount" style="width:80px; margin-bottom:0px" > </span>
			 <div class="clearfix"></div>
			 <button type="submit" class="btn btn-warning">Save</button> <button type="button" class="btn">Clear</button>
		
		 </div>	   
   </div>
   </form>
   </div>
   <div class="clearfix"></div>
 
    <hr>
   
   </div>
    
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