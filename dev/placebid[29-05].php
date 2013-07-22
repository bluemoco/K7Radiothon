<?php 
	include("common.php"); 
	include("session_active.php"); 
	unset($_SESSION['bid']);
	unset($_SESSION['cid']); 
	unset($_SESSION['admin']);
	
	if(isset($_GET['dnt']))
	{ 
		$_SESSION['dnt'] = $_GET['dnt'];
		unset($_SESSION['auc']);
		unset($_SESSION['admin1']);
		unset($_SESSION['cha']);    
		header("location:placebid.php");	 
	}
	
	if(isset($_GET['cha']))
	{ 
		$_SESSION['cha'] = $_GET['cha'];
		unset($_SESSION['auc']);
		unset($_SESSION['admin1']);  
		unset($_SESSION['dnt']);  
		header("location:placebid.php");	 
	}
	
	if(isset($_GET['auc']))
	{ 
		$_SESSION['auc'] = $_GET['auc'];
		unset($_SESSION['dnt']); 
		unset($_SESSION['cha']); 
		unset($_SESSION['admin1']); 
		header("location:placebid.php");	 
	}		
	if(isset($_GET['admin1']))
	{ 
		$_SESSION['admin1'] = $_GET['admin1'];
		unset($_SESSION['dnt']); 
		unset($_SESSION['cha']); 
		unset($_SESSION['auc']);
		header("location:placebid.php");
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
$(document).ready(function(){
	 
	$('.delete-link').click(function(){
		if(confirm("Are you sure ?")) {
			$.ajax({
			'type' : 'POST',
			'url' : "ajaxform.php?delete="+this.id,
			'success' : function(data) {
				window.location = "placebid.php";
			}
			})
		}
		
		return false;
	});
});
</script>
</head>


<body>

	<div class="main-header">
		<?php include('header.php'); ?>
    </div>
    <div class="clearfix"></div>
	
   
   <div class="container">   
   
   <div class="subheads">Placing a bid </div>
   
   <div class="matter">
   <div class="fheading"><h1></h1></div>
   
   <div class="row-fluid">
   <div class="span8">
    <div class="row-fluid">
   <!--form-->
   <div class="input-append" style="margin-top:70px;">
   <form name="search" action="" method="get">
  <input class="input-xxlarge" id="phone" name="phone" type="text" placeholder="Search Telephone Here..." value="<?php echo (isset($_GET['phone']) ? $_GET['phone'] : '') ?>">
  <button class="btn btn-inverse" type="submit"><img src="images/find.png" alt="find"></button>
 </form>
</div>
   <!--/form-->
   </div>
   </div>
   <div class="span4 left-border">
    <div class="row-fluid">
     <div class="span6" style="margin-left:60px;">
    <div class="text-center"><a href="new_user.php"> <h2>Add new User</h2>
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
		  <th>User Name</th>
		  <th>Town</th>
		  <?php if(isset($_SESSION['admin1'])) { echo '<th>Edit</th> <th>Delete</th>'; } ?>
		</tr>
	  </thead>
	  <tbody>
	 <?php
			include('lib/pager.class.php');
			if(isset($_GET['page'])) {
				$page = $_GET['page'];
			} else {
				$page = 1;
			}
			
			$q = "select * from clientinfo as c LEFT JOIN town as t ON c.TownID = t.TownID ";
			$qurey_string = "";
			if(isset($_GET['phone'])) {
				$q .= "WHERE c.Phone like '%".$_GET['phone']."%'";
				$qurey_string = "?phone=".$_GET['phone'];
			} 
			$q .= " ORDER BY c.index DESC";
			
			$o__pager = new pager('clientinfo', $page, NUM_PAGE ,array(), $q);
			$client = $o__pager->getQuery();			 
		 while ($arrclient = mysql_fetch_assoc($client)):
	 ?> 
	 	<tr>
		<?php
		if(isset($_SESSION['dnt'])) { ?>
		<td><a href="new_pledge.php?id=<?php echo $arrclient['index']; ?>"><?php echo $arrclient['Phone']; ?></a></td>
		<?php } else if(isset($_SESSION['cha'])) { ?> 
		<td><a href="new_challenge.php?id=<?php echo $arrclient['index']; ?>"><?php echo $arrclient['Phone']; ?></a></td>
		<?php } else { ?>
		<td><a href="itemlist.php?id=<?php echo $arrclient['index']; ?>"><?php echo $arrclient['Phone']; ?></a></td>
		<?php } ?>	
		
		  <td><?php echo $arrclient['FirstName']. " " . $arrclient['LastName']; ?></td>
		  <td><?php echo $arrclient['TownName']; ?></td>
		  <?php if(isset($_SESSION['admin1'])) { ?> 
		  <td><a href="new_user.php?id=<?php echo $arrclient['index']; ?>" ><img src="images/edit.png" ></a></td>	
		  <td><a href="#" id="<?php echo $arrclient['index']; ?>" class="delete-link" >Delete</a></td>	
		  <?php } ?>	   
		</tr>
	 <?php endwhile; ?>	
	 
	  </tbody>
	</table>
   
	 	<div class="pagination pagination-right">
		<ul>
		<?php echo $o__pager->getPagerString('placebid.php'.$qurey_string); ?>
		</ul>
	</div>

   </div>
   
   <!--section3-->
   <hr>
    
  <div class="clearfix"></div>
   
   </div>
   
   <!--section4-->
   
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