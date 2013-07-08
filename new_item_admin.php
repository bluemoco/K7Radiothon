<?php 
	include("common.php"); 
	include("session_active.php"); 
	include('Imageresize.php'); 
$str = getAllDonnor(); 

if(isset($_POST['DonorID']))
{
	$ItemName = $_REQUEST['ItemName'];
	$TelephoneNumber =$_REQUEST['TelephoneNumber'];
	$CloseDateTime = $_POST['CloseDateTime'];
	$ReservePrice = $_POST['ReservePrice'];
	$startprice = $_POST['startprice'];
	$Description = $_POST['Description'];
	
	$o_q = mysql_query("select * from donnorinfo WHERE CONCAT(FirstName, ' ',LastName) = '".$_POST['DonorID']."'");
	$donor = mysql_fetch_array($o_q);
	
	$donorid = $donor['index']; 
	if(isset($donorid) != '' && trim($_POST['ItemName']) != '' && $_POST['CloseDateTime'] != '' && $_POST['ReservePrice'] != '' 
	&& $_POST['TelephoneNumber'] != '' && $_POST['startprice'] != ''  && $_POST['TownID'] != '') 
	{    
			
			$image_extension = end(explode(".",$_FILES['image']['name']));	
			if($image_extension =='jpg' || $image_extension =='jpeg' || $image_extension =='gif' || $image_extension == 'png' || $image_extension == 'JPG' || 
			$image_extension == 'JPEG' || $image_extension == 'GIF' || $image_extension == 'PNG')
			{		
				$image_name = date("is").str_replace(" ","_",$_FILES['image']['name']);
				move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/".$image_name);
				
				$image = new SimpleImage();
				$image->load("uploads/".$image_name);
				$image->resize("300", "221");
				$image->save("uploads/big_".$image_name);					
		    }		  		
					 
		 
			mysql_query("INSERT INTO auctionitems(DonorID, ItemName, Photo, LoaddateTime, CloseDateTime, startprice, ReservePrice, TelephoneNumber, ProxyID, TownID, 		                 Description,created) 
			VALUES('".$donorid."','".$_POST['ItemName']."','".$image_name."','".date("Y-m-d H:i:s")."',
			'".date("Y-m-d H:i:s" , strtotime($_POST['CloseDateTime']))."','".$_POST['startprice']."' ,'".$_POST['ReservePrice']."',
			'".$_POST['TelephoneNumber']."' , '".$_SESSION['id']."' , '".$_POST['TownID']."','".$_POST['Description']."' , '".date("Y-m-d")."')");
						
			$msg = "Item added successfully"; 
			?><script>window.location='new_bid.php?bid=<?php echo mysql_insert_id(); ?>'; </script><?php 
			 
			
	}
	else
	{
		$msg = "Enter All Fields!";			
	}
}


?>

<!doctype html>

<head>

<?php default_js_css(); ?>	
<script src="js/jquery-ui-1.8.5.custom.min.js"></script>
<link href="css/smoothness/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script src="js/jquery-ui-timepicker-addon.js"></script>
<?php autocomplete(); ?>
<script>
$(document).ready(function() {
    $("#DonorID").autocomplete({source : <?php echo $str ?>});        
	$(".dt-picker").datetimepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'd-m-yy',
		timeFormat: 'hh:mm',
		stepHour: 1,
		stepMinute: 5,
		stepSecond: 5,
		showSecond: false,
		hourGrid:   4,
		minuteGrid: 10
	});			
});
</script>


<script>
$(document).ready(function(){  
	 jQuery('.btn').removeClass('btn-primary');	 
 	 jQuery('#btn4').removeClass('btn-inverse');	  
	 jQuery('#btn4').addClass('btn-primary'); 
});
</script>

</head>


<body>

<div class="main-header">
 <?php include('header.php'); ?>
   </div>
    <div class="clearfix"></div>
   
   <div class="container">  
   
   <div class="subheads">Add Item </div>
   
   <div class="matter">
   <div class="fheading"><h1><div style="text-align:center"><?php echo $msg; ?></div></h1></div>
   <div class="row-fluid">
   <div class="span7">
   <!--form-->
   <form class="form-horizontal" name="frm" id="frm" method="post" enctype="multipart/form-data">   
	
  <div class="control-group">
    <label class="control-label" for="inputEmail">Donor</label>
    <div class="controls">
	  <input type="text" id="DonorID" name="DonorID" value="<?php echo $DonorID ?>">
		
	  
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Item Name</label>
    <div class="controls">
      <input type="text" id="ItemName" name="ItemName" value="<?php echo $ItemName; ?>" >
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="inputPassword">Phone</label>
    <div class="controls">
      <input type="text" id="TelephoneNumber" name="TelephoneNumber" value="<?php echo $TelephoneNumber; ?>" >
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">City</label>
    <div class="controls">
      <select id="TownID" name="TownID">
 		<?php
			$town = mysql_query("select * from town ORDER BY TownName ASC");
			while ($arrtown = mysql_fetch_assoc($town)) {
				?>	
				<option value="<?php echo $arrtown['TownID']; ?>" <?php echo ($TownID == $arrtown['TownID'])?'selected': '' ; ?> ><?php echo $arrtown['TownName']; ?></option>
				<?php
			}
			?>
	  </select>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Photo</label>
    <div class="controls">
      <input type="file" id="image" name="image" >
	  <img src="uploads/big_<?php echo $Photo; ?>" alt="" style="margin:10px 0 10px 0" >
	  <input type="hidden" name="hideimage" value="<?php echo $Photo; ?>" >
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Close Time</label>
    <div class="controls">
      <input type="text" id="CloseDateTime" name="CloseDateTime" class="dt-picker"   value="<?php echo $CloseDateTime; ?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Start Price</label>
    <div class="controls">
      <input type="text" id="startprice" name="startprice"  value="<?php echo $startprice; ?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Reserve Price</label>
    <div class="controls">
      <input type="text" id="ReservePrice" name="ReservePrice"  value="<?php echo $ReservePrice; ?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Description</label>
    <div class="controls">
		<textarea name="Description" id="Description" style="height:150px" ><?php echo $Description; ?></textarea>
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">     
      <button type="submit" class="btn btn-warning">Save</button> <button type="button" class="btn" onClick="window.location='new_item.php';">Clear</button>
    </div>
  </div>
</form>
   <!--/form-->
   </div>
   <div class="span5"><img src="images/tree-2.jpg" alt="tree"></div>
   
   </div>
   <div class="clearfix"></div>
 
    <hr>
   
   </div>
    
    </div>
   
<?php include('footer.php'); ?>

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