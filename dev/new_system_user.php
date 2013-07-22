<?php 
	include("common.php"); 
	include("session_active.php"); 
	

if(isset($_GET['admin']))
	{ 
		$_SESSION['admin'] = $_GET['admin'];
		?>	<script> window.location='new_system_user.php';</script> <?php  
		//header("location:itemlist.php");
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
	if(document.getElementById('Username').value == '')
	{
		alert("Please Enter Username");
		document.getElementById('Username').focus();
		return false;		
	}	
	if(document.getElementById('Password').value == '')
	{
		alert("Please Enter Password");
		document.getElementById('Password').focus();
		return false;		
	}	
	else
		jQuery.ajax({
    			 type:     'post',
			     dataType: 'html',
  			     success:   function(data)
				 {				
				 						
						window.setTimeout("location='new_system_user.php'",2500);
				
					$('#msg').html(data);				     
				 },
   				 data:   (jQuery('#frm').serialize()),
   				 url:    "ajaxform.php?Username="+$('#Username').val()+"&Password="+$('#Password').val()
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
   <div class="span7" style="width:425px">
   <!--form-->
   <form class="form-horizontal" name="frm" id="frm" onSubmit="return chk()">
   <input type="hidden" name="proxy" id="proxy" value="proxy" >
		
  <div class="control-group">
    <label class="control-label" for="inputEmail">Phone</label>
    <div class="controls">
      <input type="text" id="Phone" name="Phone" >
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">First Name</label>
    <div class="controls">
      <input type="text" id="FirstName" name="FirstName" >
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Last Name</label>
    <div class="controls">
      <input type="text" id="LastName" name="LastName"  >
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
				<option value="<?php echo $arrtown['TownID']; ?>" ><?php echo $arrtown['TownName']; ?></option>
				<?php
			}
			?>
	  </select>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Email</label>
    <div class="controls">
      <input type="email" id="Email" name="Email" >
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">      
      <button type="submit" class="btn btn-warning">Save</button> <button type="button" class="btn" onClick="window.location='new_user.php';">Clear</button>
    </div>
  </div>
   <!--/form-->
   </div>
   <div class="span6">
   
    <div class="text-center"> <h2>User Roles</h2></div>
   
   <div class="row-fluid">
  
   <div class="span7">
    <div class="text-center">
   <img src="images/users.png" alt="client">
  
   </div>
   </div>
   
   
   <div class="span5">
   <div class="control-group">
    <div class="controls" style="margin-top:20px;">
     <label class="checkbox">
        <input type="radio" name="role" id="role" checked="checked" value="1">&nbsp;Admin
      </label>
       <label class="checkbox">
        <input type="radio" name="role"  id="role" value="2">&nbsp;Money Capture
      </label>
      
      <label class="checkbox">
        <input type="radio" name="role"  id="role" value="3">&nbsp;Recovery
      </label>
    </div>
  </div>
  </div>
  
  </form>

  </div>
  
   <!--form-->
   <form class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Username</label>
    <div class="controls">
      <input type="text" id="Username" name="Username">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <input type="password" id="Password"  name="Password">
    </div>
  </div>
   
</form>


   <!--/form-->
   
   </div>
   
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