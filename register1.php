<!doctype html><!-- simplified doctype works for all previous versions of HTML as well -->

<!-- Paul Irish's technique for targeting IE, modified to only target IE6, applied to the html element instead of body -->
<!--[if IE 6]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if (gt IE 6)|!(IE)]><!--><html lang="en" class="no-js"><!--<![endif]-->

<head>
	<!-- simplified character encoding -->
	<meta charset="utf-8">

	<title>
	Home
</title>


  <link  href="style_new.css" rel="stylesheet" media="screen">
  <link href="css/bootstrap_new.css" rel="stylesheet" media="screen">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
</head>

<body>

	<div class="main-header">
		<?php include('header.php'); ?>
    </div>
    <div class="clearfix"></div>
	
   
   <div class="container">  
<div class="subheads">Registering Client</div>
   
   <div class="matter">
   <div class="fheading"><h1> <img src="images/info.png" alt="info"> You have successfully downloaded the internet!</h1></div>
   
   <div class="row-fluid">
   <div class="span7">
   <!--form-->
   <form class="form-horizontal">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Phone</label>
    <div class="controls">
      <input type="text" id="inputEmail">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">First Name</label>
    <div class="controls">
      <input type="text" id="inputPassword" >
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Last Name</label>
    <div class="controls">
      <input type="text" id="inputPassword" >
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Street No.</label>
    <div class="controls">
      <input type="text" id="inputPassword" >
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Home No.</label>
    <div class="controls">
      <input type="text" id="inputPassword" >
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">P.O. Box</label>
    <div class="controls">
      <input type="text" id="inputPassword" >
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">City</label>
    <div class="controls">
      <select>
  <option>City Name1</option>
  <option>City Name2</option>
  <option>City Name3</option>
  <option>City Name4</option>
  <option>City Name5</option>
</select>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Email</label>
    <div class="controls">
      <input type="email" id="inputPassword" >
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">
      <label class="checkbox">
        <input type="checkbox"> Wishes to stay anonymous
      </label>
      <button type="submit" class="btn btn-warning">Save</button> <button type="submit" class="btn">Clear</button>
    </div>
  </div>
</form>
   <!--/form-->
   </div>
   <div class="span5"><img src="images/tree.jpg" alt="tree"></div>
   
   </div>
   <div class="clearfix"></div>
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










    <script src="js/bootstrap.min.js"></script>                 
</body>
</html>

  