<?php 
	include("common.php"); 
	if(isset($_SESSION['id'])) { header("location:home.php"); }
?>

<!doctype html>

<head>

<?php default_js_css(); ?>	

<script>
function chk()
{
	if(document.getElementById('em').value == '')
	{
		alert("Please Enter Valid Email");
		document.getElementById('em').focus();
		return false;		
	}
	else
		jQuery.ajax({
    			 type:     'post',
			     dataType: 'json',
  			     success:   function(data)
				 {		
				 	$('#msg').html(data.msg);				     
					$('#em').val('');
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
   
   <div class="matter">
   <div class="fheading"><h1><div style="text-align:center" id="msg" ></div></h1></div>
    
   <div class="login">
   <form class="form-horizontal" name="frm" id="frm" onSubmit="return chk()">
   <input type="hidden" name="forgot" id="forgot" value="forgot" >				
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
      <input type="text" id="em" placeholder="Email" name="em">
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">
    <p><a href="index.php">Login?</a></p>
     <!-- <label class="checkbox">
        <input type="checkbox"> Remember me
      </label>-->
      <button type="submit" class="btn btn-warning ">Send</button>
    </div>
  </div>
</form>
   </div>
   </div>
   
   
   
    <div class="clearfix"></div>

    
    </div>
    
  

<!--footer-->
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