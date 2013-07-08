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


  <link  href="style.css" rel="stylesheet" media="screen">
  <link href="css/bootstrap.css" rel="stylesheet" media="screen">
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
   
   <div class="subheads">Placing a bid </div>
   
   <div class="matter">
   <div class="fheading"><h1> <img src="images/info.png" alt="info"> Currently bidding for Kabali Nadali</h1></div>
   
   <div class="row-fluid">
   <div class="span8">
    <div class="row-fluid">
   <!--form-->
   <div class="input-append" style="margin-top:70px;">
  <input class="input-xxlarge" id="appendedInputButton" type="text" placeholder="Search Here...">
  <button class="btn btn-inverse" type="button"><img src="images/find.png" alt="find"></button>
</div>
   <!--/form-->
   </div>
   </div>
   <div class="span4 left-border">
    <div class="row-fluid">
     <div class="span6" style="margin-left:60px;">
    <div class="text-center"><a href="#"> <h2>Add new User</h2>
     <img src="images/add-user.png" alt="add"></a>   </div>
   </div>
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
                 
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="#">123 456 789</a></td>
                  <td>Mark</td>
                  <td>Otto</td>
               
                </tr>
                <tr>
                    <td><a href="#">123 456 789</a></td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                 
                </tr>
                <tr>
                   <td><a href="#">123 456 789</a></td>
                  <td>Larry</td>
                  <td>the Bird</td>
                
                </tr>
                 <tr>
                    <td><a href="#">123 456 789</a></td>
                  <td>Jacob</td>
                  <td>Thornton</td>
                 
                </tr>
                <tr>
                   <td><a href="#">123 456 789</a></td>
                  <td>Larry</td>
                  <td>the Bird</td>
                
                </tr>
              </tbody>
            </table>
   
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