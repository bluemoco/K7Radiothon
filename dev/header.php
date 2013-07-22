<style>
.loo:hover { text-decoration:none; }
</style>
<div class="container">

	<a href="#" class="logo"></a>
 
 <!--login form-->
 <div class="login-bg" style="width:auto">

   <p class="sign-p">
   <?php if(isset($_SESSION['id'])) { ?> Welcome : <a href="#" ><?php echo $_SESSION['Username']; ?></a>
   <?php } else { ?> <a href="index.php">Login</a></p> <?php } ?>

 </div>
<style>
body { line-height:0px;}

</style>  <!--login form-->
  
  
    <div class="clearfix"></div>
    <div class="row-fluid" style="margin-top:0px">
   
     <?php if(isset($_SESSION['id'])) { ?> 
	  <a  class="btn btn-large span2 btn-inverse" href="home.php" id="btn1">Home</a>
     <div class="btn-group  span2">
                <a class="btn btn-inverse dropdown-toggle btn-large span12" id="btn2" data-toggle="dropdown" href="#">Auction <span class="caret"></span></a>
                <ul class="dropdown-menu drp2">
                  <li><a href="auction_bid.php">Place bid</a></li>
                  <li><a href="itemlist_all.php">Look up items</a></li>                
                </ul>
     </div>
       
 <!--  <div class="btn-group  span2">
		<a class="btn btn-inverse dropdown-toggle btn-large span12" id="btn3" data-toggle="dropdown" href="#">Donation <span class="caret"></span></a>
		<ul class="dropdown-menu drp2">
		  <li><a href="placebid.php?dnt=dnt">Pledges</a></li>
		  <li><a href="placebid.php?cha=cha">Challenges</a></li>                 
		</ul>
   </div>
   -->
   <a  class="btn btn-large span2 btn-inverse" href="donation_bid.php" id="btn3">Donation</a>
   <a  class="btn btn-large span2 btn-inverse" href="challenge_bid.php" id="btn33">Challenges</a>
	  <?php if(isset($_SESSION['sadmin'])) { ?>
   <div class="btn-group  span2">
		<a class="btn btn-inverse dropdown-toggle btn-large span12" id="btn4" data-toggle="dropdown" href="#">Admin <span class="caret"></span></a>
		<ul class="dropdown-menu drp2">
		  <li><a href="placebid.php">Manage User</a></li>
		  <li><a href="placebid_admin.php">Manage Items</a></li>                            	  
                  <li><a href="system_user.php">Manage System User</a></li>             
                  <li><a href="new_system_user.php?admin=admin">Client Registration</a></li>
                  <li><a href="reports-generation.php">Reports Generation</a></li>
		</ul>
    </div>
	   <?php } ?>
	   
	   
        <!--<a  class="btn btn-inverse btn-large span2" href="#">Dashboard</a>-->
     <a  class="btn btn-danger btn-large span2" href="logout.php"><i class="icon-share icon-white"> </i> Logout</a> <?php } ?>
    </div>
   </div>