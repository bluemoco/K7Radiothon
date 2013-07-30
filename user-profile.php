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
            <?php
            include("common.php");
            include("session_active.php");
            include('header.php');
            ?>
        </div>
        <div class="clearfix"></div>


        <div class="container">   

            <div class="subheads">User Activity Profile</div>

            <?php
            include('lib/pager.class.php');
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            } else {
                echo "<script>window.location.href='home.php'</script>";
            }
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }
            $q = "SELECT * FROM `clientinfo` WHERE `index` = " . $id;
            $o__pager = new pager('clientinfo', $page, NUM_PAGE, array(), $q);
            $client = $o__pager->getQuery();
            $arrclient = mysql_fetch_array($client);
            ?>

            <div class="matter">
                <div class="fheading"><h1> User: <?php echo $arrclient['FirstName'] . " " . $arrclient['LastName']; ?></h1></div>

                <div class="row-fluid" style="  border-bottom: 3px solid #eeeeee; margin-bottom: 20px;">
                    <div class="span8 right-border">
                        <div class="row-fluid">

                            <div class="user-detail">

                                <table width="100%" border="0">
                                    <tr>
                                        <td width="30%" rowspan="6"><img src="images/user-profile.jpg" alt="add"></td>
                                        <td width="21%"><h2 align="right">Name:</h2></td>
                                        <td width="49%" class="leftp15"><?php echo $arrclient['FirstName'] . " " . $arrclient['LastName']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">Email:</h2></td>
                                        <td class="leftp15"><?php echo $arrclient['Email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">Street No:</h2></td>
                                        <td class="leftp15"><?php echo $arrclient['StreetName']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">House No:</h2></td>
                                        <td class="leftp15"><?php echo $arrclient['HouseNumber']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">P.O.BOX:</h2></td>
                                        <td class="leftp15"><?php echo $arrclient['POBox']; ?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">Phone:</h2></td>
                                        <td class="leftp15"><?php echo $arrclient['Phone']; ?></td>
                                    </tr>
                                </table>


                            </div>

                        </div>
                    </div>
<?php
// bids
$q = "SELECT * 
FROM  `bids` a
WHERE  `ReceiptInfo` =  " . $id."
AND Amount = ( 
SELECT MAX(Amount) 
FROM bids b
WHERE b.BidID = a.`BidID`)";
$clientBids = mysql_query($q);
$clientTotalBids = mysql_num_rows($clientBids);


// pledgechallenges
$q = "SELECT * FROM `pledgechallenge` WHERE `ReceiptInfo` = " . $id;
$clientPledges = mysql_query($q);
$clientTotalPledges = mysql_num_rows($clientPledges);
// $clientPledgeDetails = mysql_fetch_array($clientPledges);
// Donation
$q = "SELECT * FROM `pledges` WHERE `ReceiptInfo` = " . $id;
$clientDonations = mysql_query($q);
$clientTotalDonations = mysql_num_rows($clientDonations);
//   $clientDonationDetails = mysql_fetch_array($clientDonations);
?>
                    <div class="span4">
                        <div class="row-fluid">

                            <div class="user-detail leftp50">
                                <table width="100%" border="0">
                                    <tr>
                                        <td><h2 align="right">Total Bids :</h2></td>
                                        <td class="leftp15"><?php echo $clientTotalBids; ?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">Total Pledges :</h2></td>
                                        <td class="leftp15"><?php echo $clientTotalPledges; ?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">Total Donations :</h2></td>
                                        <td class="leftp15"><?php echo $clientTotalDonations; ?></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="clearfix"></div>

                <div class="row-fluid">

                    <div class="table-title">BID PLACED : <span class="cb"><?php echo $clientTotalBids; ?></span></div>





                    <table class="table table-striped table-hover">


                        <thead>
                            <tr>
                                <th class="bgrey">Item ID</th>
                                <th class="bgrey">Item Name</th>
                                <th class="bgrey">Bid Date</th>
                                <th class="bgrey">Start Price</th>
                                <th class="bgrey">Amount</th>
                                <th class="bgrey">Proxy</th>
                            </tr>
                        </thead>






                        <tbody>


<?php
$clientBids = mysql_query("SELECT * 
FROM auctionitems AS a, bids AS b, proxybidderinfo pbi
WHERE a.AucID = b.AucID
AND b.ProxyID = pbi.ProxyID 
AND b.ReceiptInfo = " . $id."
AND Amount = ( 
SELECT MAX(Amount) 
FROM bids c WHERE b.BidID = c.`BidID`)");

while ($clientBidDetails = mysql_fetch_array($clientBids)) {
    ?>
                                <tr> 
                                    <td><a href="recover-activity.php?id=<?php echo $clientBidDetails['BidID']; ?>&activity=Bid"><?php echo $clientBidDetails['AucID']; ?></a></td>
                                    <td><?php echo $clientBidDetails['ItemName']; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($clientBidDetails['LoaddateTime'])); ?></td>
                                    <td><?php echo $clientBidDetails['startprice']; ?></td>
                                    <td><?php echo $clientBidDetails['startprice']; ?></td>
                                    <td><?php echo $clientBidDetails['Fname']." ".$clientBidDetails['Lname']; ?></td>
                                </tr>
    <?php
}
?>

                        </tbody>
                    </table>
                    <hr> 
                    
<!--                    
                    <div class="table-title">PLEDGES MADE : <span class="cb"><?php echo $clientTotalPledges; ?></span></div>
                    <table class="table table-striped table-hover">


                        <thead>
                            <tr>
                                <th class="bgrey">Challenge ID</th>
                                <th class="bgrey">Amount</th>
                                <th class="bgrey">Proxy</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
$clientpledges = mysql_query("SELECT * 
FROM  pledgechallenge AS pl, proxybidderinfo pbi
WHERE pl.ProxyID = pbi.ProxyID
AND pl.ReceiptInfo = " . $id);

while ($clientpledgesDetails = mysql_fetch_array($clientpledges)) {
?>
        <tr>
           <td><a href="recover-activity.php?id=<?php echo $clientpledgesDetails['ChallengeID']; ?>&activity=Pledge"><?php echo $clientpledgesDetails['ChallengeID'];?></a></td>
           <td><?php echo $clientpledgesDetails['Amount'];?></td>
           <td><?php echo $clientpledgesDetails['Fname']." ".$clientpledgesDetails['Lname'];?></td>                              
       </tr>
<?php
}
    ?>


                           
                        </tbody>
                    </table>



                    <hr> -->
                    <div class="table-title">DONATIONS MADE : <span class="cb"><?php echo $clientTotalDonations; ?></span></div>





                    <table class="table table-striped table-hover">


                        <thead>
                            <tr>
                                <th class="bgrey">Donation ID</th>
                                <th class="bgrey">Amount</th>
                                <th class="bgrey">Proxy</th>
                            </tr>
                        </thead>
                        <tbody>

                                <?php
                                $clientDonations = mysql_query("SELECT * 
                                FROM  pledges AS pl, proxybidderinfo pbi
                                WHERE pl.ProxyID = pbi.ProxyID
                                AND pl.ReceiptInfo = " . $id);

                                while ($clientDonationDetails = mysql_fetch_array($clientDonations)) {
                                   ?>
                             <tr >
                                <td><a href="recover-activity.php?id=<?php echo $clientDonationDetails['PledgeID']; ?>&activity=Donation"><?php echo $clientDonationDetails['PledgeID'];?></a></td>
                                <td><?php echo $clientDonationDetails['Amount'];?></td>
                                <td><?php echo $clientDonationDetails['Fname']." ".$clientDonationDetails['Lname'];?></td>                               
                            </tr> 
<?php
}
?>

                                                     
                        </tbody>
                    </table>






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
<!--<div class="ribbon">
    <div class="container">
        <h1>"Lorem Ipsum is simply dummy text of the printing and typesetting industry."</h1>
    </div>
</div>-->
<!--/ribbon-->

<!--footer-->

<?php include('footer.php'); ?>

<!--/footer-->

<!--Feet-->


<!--/Feet-->








<script src="js/bootstrap.min.js"></script>                 
</body>
</html>