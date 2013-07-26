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
	<!--Header-->
	<?php include('header.php');?>
	<!--/Header-->
    <div class="clearfix"></div>
   
   <div class="container">  
  
		<?php
		    $page="";
			switch($_GET['p']){
				case "register1": include('register1.php');break;
				case "register2": include('register2.php');break;
				case "register3": include('register3.php');break;
				case "register4": include('register4.php');break;
			
			}
			?>
   
   
   </div>
   
   
   
    <div class="clearfix"></div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Change Donor</h3>
  </div>
  <div class="modal-body">
   <div class="input-append">
  <input class="span6" id="appendedInputButton" type="text" placeholder="Search Here...">
  <button class="btn btn-inverse" type="button"><img src="images/find.png" alt="find"></button>
</div>
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
              </tbody>
            </table>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-warning">Save changes</button>
  </div>
</div>


    
    </div>
    
    
    <!--ribbon-->
<div class="ribbon">
<div class="container">
<h1>"Lorem Ipsum is simply dummy text of the printing and typesetting industry."</h1>
</div>
</div>
<!--/ribbon-->

<!--footer-->
	<?php include('footer.php'); ?>
<!--/footer-->










    <script src="js/bootstrap.min.js"></script>                 
</body>
</html>