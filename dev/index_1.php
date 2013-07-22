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
	if(document.getElementById('ps').value == '')
	{
		alert("Please Enter Password");
		document.getElementById('ps').focus();
		return false;		
	}
	
	else
		jQuery.ajax({
    			 type:     'post',
			     dataType: 'html',
  			     success:   function(data)
				 {				
				 	if(data == "Login Successfully.. Redirecting")
					{
						window.setTimeout("location='home.php'",2500);
					}			
					$('#msg').html(data);				     
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
    <input type="hidden" name="login" id="login" value="user" >
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
      <input type="text" id="em" placeholder="Email" name="em">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <input type="password" id="ps" name="ps" placeholder="Password">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
    <p><a href="#">Forgot Password?</a></p>
     <!-- <label class="checkbox">
        <input type="checkbox"> Remember me
      </label>-->
      <button type="submit" class="btn btn-warning ">Sign in</button>
    </div>
  </div>
</form>
   </div>
   </div>
   
   
   
    <div class="clearfix"></div>

    
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