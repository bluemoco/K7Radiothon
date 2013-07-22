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
   
   <div class="subheads">Visual Reports</div>
   
   <div class="matter">
   <div class="fheading"><h1> </h1></div>
   
   <div class="row-fluid" style="  border-bottom: 3px solid #eeeeee; margin-bottom: 30px;">
   <div class="span10">
    <div class="row-fluid">
<div class="table-title">FINANCE SUMMERY : </div>
   <div class="user-detail">

  <table width="100%" border="0">
  <tr>
    <td width="30%" rowspan="4" valign="middle" align="center"><img src="images/visualreport.jpg" alt="add"></td>
    <td width="21%"><h2 align="right">Total Received:</h2></td>
    <td width="49%" class="leftp15"><strong>$5,678,5444</strong></td>
  </tr>
  <tr>
    <td><h2 align="right">Total Pending:</h2></td>
    <td class="leftp15"><strong>$1,222,2674</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td class="leftp15">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0">
      <tr>
        <td width="25%">&nbsp;</td>
        <td width="5%" bgcolor="#F60">&nbsp;</td>
        <td width="70%"><span align="left" class="corange">Total Received From Donations:</span>&nbsp;&nbsp;<strong>$105,555</strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td bgcolor="#F60">&nbsp;</td>
        <td><span class="corange">Total Pending From Donations:</span>&nbsp;&nbsp;<strong>$55,555</strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td bgcolor="#7030a0">&nbsp;</td>
        <td><span class="cviolet">Total Received From Bids:</span>&nbsp;&nbsp;<strong>$105,555</strong></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td bgcolor="#7030a0">&nbsp;</td>
        <td><span class="cviolet">Total Pending From Bids:</span>&nbsp;&nbsp;<strong>$55,555</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td bgcolor="#00b050">&nbsp;</td>
        <td><span class="cgreen">Total Received From Pledges:</span>&nbsp;&nbsp;<strong>$105,555</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td bgcolor="#00b050">&nbsp;</td>
        <td><span class="cgreen">Total Pending From Pledges:</span>&nbsp;&nbsp;<strong>$55,555</strong></td>
        </tr>
    </table>      <h2 align="right">&nbsp;</h2></td>
    </tr>
  </table>

  
</div>

   </div>
   </div>
  
   </div>
   

   <div class="clearfix"></div>
   
     <div class="row-fluid" style="  border-bottom: 3px solid #eeeeee; margin-bottom: 30px;">
   
   <div class="table-title">TOTALS BY CONTRIBUTION TYPE :</div>
   <div class="user-detail">
   
   <div id="gr">
   <div class="grcol1"><h2>Donations Total:</h2></div>

<div class="grcol2">
<div class="progress progress-danger progress-striped">
  <div class="bar" style="width: 79%"><strong style="float:right;">$79036</strong></div>
</div>
</div>

  <div class="grcol1"><h2>Bids Total:</h2></div>

   <div class="grcol2"> <div class="progress progress-info progress-striped">
  <div class="bar" style="width: 40%"><strong style="float:right;">$40000</strong></div>
</div></div>
    
    
      <div class="grcol1"><h2> Pledges Total:</h2> </div>
    
    <div class="grcol2"><div class="progress progress-success progress-striped">
  <div class="bar" style="width: 97%"><strong style="float:right;">$97265</strong></div>
</div></div>

 <div class="grcol3"></div>

</div>

   </div>
   

   </div>
   
   
   
   
    <div class="clearfix"></div>
   
   
   
    <div class="row-fluid" style="margin-bottom: 20px;">
   
   <div class="table-title">RECOVERED TOTALS BY CONTRIBUTION TYPE :</div>
   <div class="user-detail">
   
   <div id="gr">
   <div class="grcol1"><h2>Donations Total:</h2></div>

<div class="grcol2">
<div class="progress progress-danger progress-striped">
  <div class="bar" style="width: 79%"><strong style="float:right;">$79036</strong></div>
</div>
</div>

  <div class="grcol1"><h2>Bids Total:</h2></div>

   <div class="grcol2"> <div class="progress progress-info progress-striped">
  <div class="bar" style="width: 40%"><strong style="float:right;">$40000</strong></div>
</div></div>
    
    
      <div class="grcol1"><h2> Pledges Total:</h2> </div>
    
    <div class="grcol2"><div class="progress progress-success progress-striped">
  <div class="bar" style="width: 97%"><strong style="float:right;">$97265</strong></div>
</div></div>

 <div class="grcol3"></div>

</div>

   </div>
   

   </div>
   
   <!--section3-->

   

   <!--/form-->
   
   </div>
   
  <div class="clearfix"></div>
  
   
   </div>
   
   <!--section4-->
 
  
   
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
</div></p>
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