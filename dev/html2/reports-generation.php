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

  <link href="css/datepicker.css" rel="stylesheet">
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
   
   <div class="subheads">Reports & Report Generation</div>
   
   <div class="matter">
   <div class="fheading"><h1> User: Kabali Nadali</h1></div>
   
   <div class="row-fluid" style="margin-bottom: 20px;">
   <div class="span7">
    <div class="row-fluid">
<div class="table-title">SORT BY :</div>
   <div class="user-detail"></div>

  <form class="form-horizontal">
     
     
       <div class="control-group">
    <label class="control-label" for="inputPassword">Dates: </label>
    <div class="controls">
     <div class="input-append date" id="dp1" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
				<input class="inpd" size="16" type="text" value="12-02-2012" readonly>
				<span class="add-on"><i class="icon-calendar"></i></span>
			  </div>
               
               
                    <div class="input-append date" id="dp2" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
				<input class="inpd" size="16" type="text" value="12-02-2012" readonly>
				<span class="add-on"><i class="icon-calendar"></i></span>
			  </div>
    </div>
  </div>
  
    <div class="control-group">
    <label class="control-label" for="inputPassword">Status:</label>
    <div class="controls">
      <select class=" inpt">
  <option>Money Recovered</option>

 </select> 
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">Proxy:</label>
    <div class="controls">
      <select class=" inpt">
 <option>Select Proxy Admin</option> 

 </select> 
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Contact Mode:</label>
    <div class="controls">
      <select class=" inpt">
  <option>Text Message</option>

 </select> 
    </div>
  </div>
  
    <div class="control-group">
    
    <div class="controls">
   <button type="submit" class="btn btn-success">Search</button>    <button type="reset" class="btn btn-info">Reset</button>  
    </div>
    </div>
    </form>
 


   </div>
   </div>
  
  
  
   <div class="span4" style="margin-top:70px;">
    <div class="row-fluid">
   
      <img src="images/reports.jpg"> </div></div>
   
  
   </div>
   

    
   <div class="clearfix"></div>
   
   
   
   
   
   
   
   
   <div class="row-fluid">
   
   
   

   
   
   
   <table class="table table-striped table-hover">
               
                         
<thead>
                <tr>
                  <th class="bgrey"> Id</th>
                  <th class="bgrey">Type</th>
                  <th class="bgrey">Contributor</th>
                  <th class="bgrey">Amount</th>
                  <th class="bgrey">Proxy</th>
                  <th class="bgrey">Status</th>
                </tr>
              </thead>
              
     
               
   
               
               
               <tbody>

              
             
                <tr >
                  <td><a href="#">8172</a></td>
                    <td>Donation</td>
                  <td>Kabali Ndali</td>
                  <td>N$ 4,567</td>
                   <td>Johny Whalum</td>
                  <td>Written Off</td>
               
                </tr>
                <tr>
                    <td><a href="#">8172</a></td>
                  <td>BID</td>
                  <td>Kabali Ndali</td>
                  <td>N$ 4,567</td>
                  <td>Johny Whalum</td>
                   <td>Pending</td>
                </tr>
                
                   <tr >
                  <td><a href="#">8172</a></td>
                    <td>Donation</td>
                  <td>Kabali Ndali</td>
                  <td>N$ 4,567</td>
                   <td>Johny Whalum</td>
                  <td>Written Off</td>
               
                </tr>
                <tr>
                    <td><a href="#">8172</a></td>
                  <td>BID</td>
                  <td>Kabali Ndali</td>
                  <td>N$ 4,567</td>
                  <td>Johny Whalum</td>
                   <td>Pending</td>
                </tr>
                   <tr >
                  <td><a href="#">8172</a></td>
                    <td>Donation</td>
                  <td>Kabali Ndali</td>
                  <td>N$ 4,567</td>
                   <td>Johny Whalum</td>
                  <td>Written Off</td>
               
                </tr>
                <tr>
                    <td><a href="#">8172</a></td>
                  <td>BID</td>
                  <td>Kabali Ndali</td>
                  <td>N$ 4,567</td>
                  <td>Johny Whalum</td>
                   <td>Pending</td>
                </tr>
              </tbody>
            </table>
   
   
   
   
   
   
   
   
   
   
      <div class="pagination" style="float:right;">
  <ul>
    <li><a href="#">&lt;&lt;</a></li>
    <li><a href="#">&lt;</a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">&gt;</a></li>
    <li><a href="#">&gt;&gt;</a></li>
  </ul>
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



<script src="js/bootstrap-datepicker.js"></script>
	<script>
	if (top.location != location) {
    top.location.href = document.location.href ;
  }
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker({
				format: 'mm-dd-yyyy'
			});
			$('#dp2').datepicker();
			$('#dp3').datepicker();
			$('#dp3').datepicker();
			$('#dpYears').datepicker();
			$('#dpMonths').datepicker();
			
			
			var startDate = new Date(2012,1,20);
			var endDate = new Date(2012,1,25);
			$('#dp4').datepicker()
				.on('changeDate', function(ev){
					if (ev.date.valueOf() > endDate.valueOf()){
						$('#alert').show().find('strong').text('The start date can not be greater then the end date');
					} else {
						$('#alert').hide();
						startDate = new Date(ev.date);
						$('#startDate').text($('#dp4').data('date'));
					}
					$('#dp4').datepicker('hide');
				});
			$('#dp5').datepicker()
				.on('changeDate', function(ev){
					if (ev.date.valueOf() < startDate.valueOf()){
						$('#alert').show().find('strong').text('The end date can not be less then the start date');
					} else {
						$('#alert').hide();
						endDate = new Date(ev.date);
						$('#endDate').text($('#dp5').data('date'));
					}
					$('#dp5').datepicker('hide');
				});

        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
		});
	</script>




    <script src="js/bootstrap.min.js"></script>                 
</body>
</html>