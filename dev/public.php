<?php
include_once("config/connect.php");

//2013-05-23 10:30:00 Time format in mysql
$currentDateTime = date('Y-m-d H:i:s');

//$getClosestToCloseItemQuery = "SELECT ai.*, IFNULL((SELECT MAX(AMOUNT) FROM bids b WHERE b.AucID=ai.AucID),0) as highest_bid,(SELECT COUNT(*) FROM bids b WHERE b.AucID=ai.AucID) as bidcount FROM `auctionitems` ai WHERE `CloseDateTime`>'" . $currentDateTime . "' ORDER BY `CloseDateTime` ASC LIMIT 10";

$getClosestToCloseItemQuery = "SELECT ai.*, IFNULL((SELECT MAX(AMOUNT) FROM bids b WHERE b.AucID=ai.AucID),0) as highest_bid,(SELECT COUNT(*) FROM bids b WHERE b.AucID=ai.AucID) as bidcount FROM `auctionitems` ai WHERE `CloseDateTime`>'" . $currentDateTime . "' LIMIT 10";
//echo $getClosestToCloseItemQuery;
$getClosestToCloseItemQueryResult = mysql_query($getClosestToCloseItemQuery);
$count = 0;
$latestItemNearToClose = '<div class="row-fluid bottom-border" style="margin-bottom: 20px; padding-bottom:20px;">';
while ($item = mysql_fetch_array($getClosestToCloseItemQueryResult)) {
    if ($count % 3 == 0 && $count != 0) {
        $latestItemNearToClose.='</div><div class="row-fluid bottom-border" style="margin-bottom: 20px; padding-bottom:20px;">';
    }

    $highest_bid = ($item['highest_bid'] != 0) ? "$" . $item['highest_bid'] : "No bid placed";
    $imagePath = "uploads/" . $item['Photo'];
    $tmpImage = "images/biltong.jpg";
    $latestItemNearToClose.='<div class="span4">
                        <div class="row-fluid">
                            <div class="span10">
                                <div class="text-center"> <h2 class="text-info">' . $item['ItemName'] . '</h2> 
                                    <h5 class="text-info1">' . $item['AucID'] . '</h5>
                                    <img src="' . $imagePath . '" class="thumbnail">
                                    <h5>Time Left</h5>  <h3 id="countdown' . $count . '"></h3>
                                    <h5 class="text-info">Highest Bid</h5>
                                    <h2 class="text-info">' . $highest_bid . '</h2>
                                </div>
                            </div>
                        </div>
                    </div>';
    $latestItemNearToClose.='<script type="text/javascript">
                        var austDay = new Date();
                        austDay = new Date("' . date("F d, Y H:i:s", strtotime($item['CloseDateTime'])) . '");
                        $("#countdown' . $count . '").countdown({until: austDay,format: "dHMS",compact: true});
                    </script>';

    $count++;
}
$latestItemNearToClose.='</div>';

$townComboQuery = "SELECT * FROM  `town` ";
$townComboQueryResult = mysql_query($townComboQuery);
$townCombo = '<select class=" inpt" name="town">';
$townCombo.='<option value="0">Select City</option>';
while ($town = mysql_fetch_array($townComboQueryResult)) {
    $townCombo.='<option value="' . $town['TownID'] . '">' . $town['TownName'] . '</option>';
}
$townCombo.='</select>';
?>

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

        <link  href="css/jquery.countdown.css" rel="stylesheet" />
        <link  href="style_new.css" rel="stylesheet" media="screen">

        <link href="css/bootstrap_new.css" rel="stylesheet" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <script type="text/javascript" src="js/jquery.countdown.min.js" ></script>
        <style type="text/css">
            #countdown { width: 240px; height: 45px; }
            .span10 .text-center h5:nth-of-type(2),.span10 .text-center h5:nth-of-type(3) {
                margin-bottom: -10px;
            }
            .thumbnail{height: 170px;}
        </style>
        <script type="text/javascript">
            function search(){
                $("#auction_items").html("<img src='images/loading.gif' style='margin-left:210px;'/>");
                $.ajax({
                    type: "POST",
                    url: "search_auction_items.php",
                    data: $("#searchForm").serialize(),
                    success: function(response)
                    {				
                        $("#auction_items").html(response);   
                    }
                });
            }
            $(document).ready(function(){
                $("input[type='reset']").on("click", function(event){

                    event.preventDefault();
                    // stops the form from resetting after this function

                    $(this).closest('form').get(0).reset();
                    // resets the form before continuing the function
                    
                    search();

                });
            });
        </script>
    </head>

    <body>
        <?php include('header.php'); ?>

        <div class="clearfix"></div>


        <div id="bannerp">
            <img src="images/bannerp.png"> </div>


        <div class="container">  

            <div class="matter">
                <div class="fheading">
                    <h1>ITEMS OPEN FOR BIDDING</h1></div>

                <div class="row-fluid" style="margin-bottom: 20px;">
                    <div class="span9">
                        <div class="row-fluid">
                            <div class="table-title">FILTER BY :</div>

                            <form class="form-horizontal" id="searchForm">

                                <div class="control-group">
                                    <label class="control-label" for="town">Town:</label>
                                    <div class="controls">
                                        <?= $townCombo; ?>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="timeleft">Time Left: </label>
                                    <div class="controls1">
                                        <select class=" inpd1" name="timeleft">
                                            <option value="">Select Time Left</option>
                                            <option value="asc">Least time left</option>
                                            <option value="desc">Most Time Left</option>
                                        </select> 
                                    </div>
                                    <label class="control-label3" for="price" style="width:70px;">Item Price: </label>
                                    <div class="controls1">
                                        <select class=" inpd1" name="priceSort">
                                            <option value="">Select Price Sort</option>
                                            <option value="asc">Lowest To Highest</option>
                                            <option value="desc">Highest to lowest</option>
                                        </select> 
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="bids">Bids:</label>
                                    <div class="controls">
                                        <select class=" inpt" name="bidSort">
                                            <option value="">Select bid activity</option>
                                            <option value="asc">Least bids</option>
                                            <option value="desc">Most Bids</option> 
                                        </select> 
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="itemname">Enter Item Name:</label>
                                    <div class="controls">
                                        <input class="inpt1" type="text" id="itemName" name="itemName" > 
                                    </div>
                                </div>

                                <div class="control-group">

                                    <div class="controls">
                                        <input type="button" class="btn btn-success" onclick="search();" value="Search" />
                                        <input type="reset" class="btn btn-info" value="Reset" />  
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div id="auction_items">
                    <?= $latestItemNearToClose; ?>
                </div>
                <div id="countdown" class="countdown"></div>

                <!--                <div class="row-fluid bottom-border" style="margin-bottom: 20px; padding-bottom:20px;">
                                    <div class="span4">
                                        <div class="row-fluid">
                                            <div class="span10">
                                                <div class="text-center"> <h2 class="text-info">Kidu Bilton</h2> 
                                                    <h5 class="text-info1">02154</h5>
                                                    <img src="images/biltong.jpg" class="thumbnail">
                                                    <h5>Time Left</h5>  <h2>24 : 12 : 10</h2>
                                                    <h5 class="text-info">Highest Bid</h5>
                                                    <h2 class="text-info">$33</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="span4">
                                        <div class="row-fluid">
                                            <div class="span10">
                                                <div class="text-center"> <h2 class="text-info">Kidu Bilton</h2> 
                                                    <h5 class="text-info1">02154</h5>
                                                    <img src="images/biltong.jpg" class="thumbnail">
                                                    <h5>Time Left</h5>  <h2>24 : 12 : 10</h2>
                                                    <h5 class="text-info">Highest Bid</h5>
                                                    <h2 class="text-info">$33</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="span4">
                                        <div class="row-fluid">
                                            <div class="span10">
                                                <div class="text-center"> <h2 class="text-info">Kidu Bilton</h2> 
                                                    <h5 class="text-info1">02154</h5>
                                                    <img src="images/biltong.jpg" class="thumbnail">
                                                    <h5>Time Left</h5>  <h2>24 : 12 : 10</h2>
                                                    <h5 class="text-info">Highest Bid</h5>
                                                    <h2 class="text-info">$33</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row-fluid" style="margin-bottom: 20px;">
                                    <div class="span4">
                                        <div class="row-fluid">
                                            <div class="span10">
                                                <div class="text-center"> <h2 class="text-info">Kidu Bilton</h2> 
                                                    <h5 class="text-info1">02154</h5>
                                                    <img src="images/biltong.jpg" class="thumbnail">
                                                    <h5>Time Left</h5>  <h2>24 : 12 : 10</h2>
                                                    <h5 class="text-info">Highest Bid</h5>
                                                    <h2 class="text-info">$33</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span4">
                                        <div class="row-fluid">
                                            <div class="span10">
                                                <div class="text-center"> <h2 class="text-info">Kidu Bilton</h2> 
                                                    <h5 class="text-info1">02154</h5>
                                                    <img src="images/biltong.jpg" class="thumbnail">
                                                    <h5>Time Left</h5>  <h2>24 : 12 : 10</h2>
                                                    <h5 class="text-info">Highest Bid</h5>
                                                    <h2 class="text-info">$33</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span4">
                                        <div class="row-fluid">
                                            <div class="span10">
                                                <div class="text-center"> <h2 class="text-info">Kidu Bilton</h2> 
                                                    <h5 class="text-info1">02154</h5>
                                                    <img src="images/biltong.jpg" class="thumbnail">
                                                    <h5>Time Left</h5>  <h2>24 : 12 : 10</h2>
                                                    <h5 class="text-info">Highest Bid</h5>
                                                    <h2 class="text-info">$33</h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
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
            <div class="container">

                <div class="row-fluid">
                    <!--posts-->
                    <div class="span4 br-right">
                        <h2>Company Information</h2>

                        <p>Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula.
                            Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ullamcorper nulla non metus auctor fringilla. </p>          


                    </div>
                    <!--/posts-->

                    <!--map-->
                    <div class="span4 br-left">
                        <h2>Links</h2>

                        <ul class="unstyled">
                            <li><a href="#">Lorem ipsum dolor sit amet</a></li>
                            <li><a href="#">Consectetur adipiscing elit</a></li>
                            <li><a href="#">Integer molestie lorem at massa</a></li>
                            <li><a href="#">Facilisis in pretium nisl aliquet</a></li>
                            <li><a href="#">Nulla volutpat aliquam velit</a></li>
                        </ul>


                    </div>
                    <!--/map-->

                    <div class="span4 br-left2">
                        <h2>Contact Information</h2>

                        <address>
                            <strong>Company Name.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>

                        <address>
                            <strong>Full Name</strong><br>
                            <a href="mailto:#">first.last@example.com</a>
                        </address>
                    </div>

                </div>
                <div class="clearfix">


                </div>
            </div>
            <div class="clearfix"></div>





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