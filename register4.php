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
<div class="subheads">Registering Client</div>
   
   <div class="matter">
   <div class="fheading"><h1> <img src="images/info.png" alt="info"> You have successfully downloaded the internet!</h1></div>
		<div class="row-fluid">
		   <div class="span6">
		   <h1>TITLE H1</h1>
			<!--form-->
		   <form class="form-horizontal">
		  <div class="control-group">
			<label class="control-label" for="inputEmail"><a href="#myModal" data-toggle="modal">Change Donor</a></label>
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
			<div class="controls">
			  <label class="checkbox">
				<input type="checkbox"> Wishes to stay anonymous
			  </label>
			  
			</div>
		  </div>
		</form>
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
				<input type="checkbox">Admin
			  </label>
			   <label class="checkbox">
				<input type="checkbox">Money Capture
			  </label>
			  
			  <label class="checkbox">
				<input type="checkbox">Recovery
			  </label>
			</div>
		  </div>
		  </div>
		  
		  
		  </div>
		  
		   <!--form-->
		   <form class="form-horizontal">
		  <div class="control-group">
			<label class="control-label" for="inputEmail">Username</label>
			<div class="controls">
			  <input type="text" id="inputEmail">
			</div>
		  </div>
		  <div class="control-group">
			<label class="control-label" for="inputPassword">Password</label>
			<div class="controls">
			  <input type="password" id="inputPassword" >
			</div>
		  </div>
		  
		  <div class="control-group">
			<label class="control-label" for="inputPassword">Discription</label>
			<div class="controls">
			  <textarea name="" cols="" rows=""></textarea>
			</div>
		  </div>
		 
		  
		</form>


		   <!--/form-->
		   
		   </div>
		   
		  <div class="clearfix"></div>
		  <div class="text-center"> <button type="submit" class="btn btn-warning">Save</button> <button type="submit" class="btn">Clear</button> </div>
		   
		   </div>
   <div class="clearfix"></div>
   </div>
   
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