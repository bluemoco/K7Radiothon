<?php 
	include("common.php"); 
	include("session_active.php"); 
	


if(isset($_GET['id']))
{
	$item = mysql_query("select * from clientinfo as c , town as t WHERE c.TownID = t.TownID AND c.index = '".$_GET['id']."'");
	$arritem = mysql_fetch_assoc($item);
	
	$Phone = $arritem['Phone'];
	$FirstName = $arritem['FirstName'];
	$LastName =$arritem['LastName'];
	$TownID = $arritem['TownID'];
	$StreetName = $arritem['StreetName'];
	$HouseNumber = $arritem['HouseNumber'];
	$POBox = $arritem['POBox'];
	$Email = $arritem['Email'];
	$Anonymous = $arritem['Anonymous'];
	
}		
?>

<!doctype html>

<head>

<?php default_js_css(); ?>	
	
<script>
$(document).ready(function(){  
	 jQuery('.btn').removeClass('btn-primary');	 
	 
	 <?php if(isset($_SESSION['auc'])) { ?>  jQuery('#btn2').removeClass('btn-inverse');	  jQuery('#btn2').addClass('btn-primary');  <?php } ?>
	 <?php if(isset($_SESSION['dnt']) || isset($_SESSION['cha'])) { ?>  jQuery('#btn3').removeClass('btn-inverse');	jQuery('#btn3').addClass('btn-primary'); <?php } ?>
	 <?php if(isset($_SESSION['admin1'])) { ?>  jQuery('#btn4').removeClass('btn-inverse');	  jQuery('#btn4').addClass('btn-primary');  <?php } ?>
     
});
</script>
<script>
function chk()
{
	$('#msg').html('');
	if(isNaN(document.getElementById('Phone').value) == true || document.getElementById('Phone').value == '')
	{
		alert("Please Enter phone");
		document.getElementById('Phone').focus();
		return false;		
	}
	if(document.getElementById('FirstName').value == '')
	{
		alert("Please Enter First Name");
		document.getElementById('FirstName').focus();
		return false;		
	}
	if(document.getElementById('LastName').value == '')
	{
		alert("Please Enter Last Name");
		document.getElementById('LastName').focus();
		return false;		
	}	
	if(checkemail(document.getElementById('Email').value) == false || document.getElementById('Email').value=="")
	{
		alert("Please Enter Valid Email");
		document.getElementById('Email').focus();
		return false;		
	}	
	if(document.getElementById('TownID').value == '')
	{
		alert("Please Select City");
		document.getElementById('TownID').focus();
		return false;		
	}	
	else
		jQuery.ajax({
    			 type:     'post',
			     dataType: 'html',
  			     success:   function(data)
				 {				
				 	if(data == "User added Successfully")
					{						
						window.setTimeout("location='placebid.php'",2000);
					}			
					$('#msg').html(data);				     
				 },
   				 data:   (jQuery('#frm').serialize()),
   				 url:    "ajaxform.php"
  		 });
  		 return false;

}

function checkemail(strMail){
 var str=strMail;
 var filter=/^.+@.+\..{2,3}$/

 if (filter.test(str))
    testresults=true
 else {   
    testresults=false
}
 return (testresults)
}
</script>	

</head>


<body>

<div class="main-header">
 <?php include('header.php'); ?>
   </div>
    <div class="clearfix"></div>
   
   <div class="container">  
   
   <div class="subheads">Registering Client</div>
   
   <div class="matter">
   <div class="fheading"><h1><div style="text-align:center" id="msg" ></div></h1></div>
   <div class="row-fluid">
   <div class="span7">
   <!--form-->
   <form class="form-horizontal" name="frm" id="frm" onSubmit="return chk()">
   <input type="hidden" name="user" id="user" value="user" >
   <input type="hidden" name="hdnaction" id="hdnaction" value="<?php if(isset($_GET['id'])) { echo 'Update'; } else { echo 'Save'; } ?>" >
   <input type="hidden" name="userid" id="userid" value="<?php echo $_GET['id']; ?>" >
		
  <div class="control-group">
    <label class="control-label" for="inputEmail">Phone</label>
    <div class="controls">
      <input type="text" id="Phone" name="Phone" value="<?php echo $Phone; ?>" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">First Name</label>
    <div class="controls">
      <input type="text" id="FirstName" name="FirstName"  value="<?php echo $FirstName; ?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Last Name</label>
    <div class="controls">
      <input type="text" id="LastName" name="LastName"  value="<?php echo $LastName; ?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Street No.</label>
    <div class="controls">
      <input type="text" id="StreetName" name="StreetName"  value="<?php echo $StreetName; ?>">
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Home No.</label>
    <div class="controls">
      <input type="text" id="HouseNumber" name="HouseNumber"  value="<?php echo $HouseNumber; ?>" >
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">P.O. Box</label>
    <div class="controls">
      <input type="text" id="POBox" name="POBox"  value="<?php echo $POBox; ?>" >
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
    <label class="control-label" for="inputPassword">Email</label>
    <div class="controls">
      <input type="email" id="Email" name="Email"  value="<?php echo $Email; ?>">
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">
      <label class="checkbox">
        <input type="checkbox" name="Anonymous" id="Anonymous" value="1" <?php echo ($Anonymous == 1)?'checked': '' ; ?>  > Wishes to stay anonymous
      </label>
      <button type="submit" class="btn btn-warning">Save</button> <button type="button" class="btn" onClick="window.location='new_user.php';">Clear</button>
    </div>
  </div>
</form>
   <!--/form-->
   </div>
   <div class="span5"><img src="images/tree.jpg" alt="tree"></div>
   
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