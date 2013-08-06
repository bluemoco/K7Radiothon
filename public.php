<?php
include_once("config/connect.php");

//2013-05-23 10:30:00 Time format in mysql
$currentDateTime = date('Y-m-d H:i:s');



/*
 * Initialize variables with default value
 */
$town = 0;
$timeleft = "";
$priceSort = "";
$bidSort = "";
$itemName = "";
$qurey_string = "";
if(isset($_GET['town'])){
    $town = $_GET['town'];
    $timeleft = $_GET['timeleft'];
    $priceSort = $_GET['priceSort'];
    $bidSort = $_GET['bidSort'];
    $itemName = $_GET['itemName'];
    
    $qurey_string = "?town=".$town."&timeleft=".$timeleft."&priceSort=".$priceSort."&bidSort=".$bidSort."&itemName=".$itemName;
}


/*
 * Search Conditions
 */
$condition = "";
if ($town != 0) {//Check for town by its id
    $condition.= " AND TownID='" . $town . "'";
}
if($itemName!=""){
    $condition.=" AND ItemName REGEXP '".$itemName."'";
}

$orderByArray=array();
if($timeleft!=""){
    $orderByArray[0]="`CloseDateTime` ".$timeleft;
}
if($priceSort!=""){
    $orderByArray[1]="`startprice` ".$priceSort;
}
if($bidSort!=""){
    $orderByArray[2]="`bidcount` ".$bidSort;
}

if(!empty($orderByArray)){
    $orderBy="ORDER BY ".  implode(",", $orderByArray);
}



include('lib/pager.class.php');
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}

//$getClosestToCloseItemQuery = "SELECT ai.*, IFNULL((SELECT MAX(AMOUNT) FROM bids b WHERE b.AucID=ai.AucID),0) as highest_bid,(SELECT COUNT(*) FROM bids b WHERE b.AucID=ai.AucID) as bidcount FROM `auctionitems` ai WHERE `CloseDateTime`>'" . $currentDateTime . "'";
$getClosestToCloseItemQuery = "SELECT ai.*, IFNULL((SELECT MAX(AMOUNT) FROM bids b WHERE b.AucID=ai.AucID),0) as highest_bid,(SELECT COUNT(*) FROM bids b WHERE b.AucID=ai.AucID) as bidcount FROM `auctionitems` ai WHERE `CloseDateTime`>'" . $currentDateTime . "' " . $condition ." ".$orderBy;
//$getClosestToCloseItemQuery .= " ORDER BY ai.AucID DESC";

$o__pager = new pager('auctionitems', $page, 30, array(), $getClosestToCloseItemQuery);
$getClosestToCloseItemQueryResult = $o__pager->getQuery();


//$getClosestToCloseItemQuery = "SELECT ai.*, IFNULL((SELECT MAX(AMOUNT) FROM bids b WHERE b.AucID=ai.AucID),0) as highest_bid,(SELECT COUNT(*) FROM bids b WHERE b.AucID=ai.AucID) as bidcount FROM `auctionitems` ai WHERE `CloseDateTime`>'" . $currentDateTime . "' LIMIT 0,30";
//$getClosestToCloseItemQueryResult = mysql_query($getClosestToCloseItemQuery);
$count = 0;
$latestItemNearToClose = '<div class="row-fluid bottom-border" style="margin-bottom: 20px; padding-bottom:20px;">';
while ($item = mysql_fetch_array($getClosestToCloseItemQueryResult)) {
    if ($count % 3 == 0 && $count != 0) {
        $latestItemNearToClose.='</div><div class="row-fluid bottom-border" style="margin-bottom: 20px; padding-bottom:20px;">';
    }

    $highest_bid = ($item['highest_bid'] != 0) ? "N$" . $item['highest_bid'] : "No bid placed";
    $imageName = ($item['Photo'] == '') ? 'VerticalLogo.png' : $item['Photo'];
    $imagePath = "uploads/" . $imageName;
    $tmpImage = "images/biltong.jpg";
    $titleItem=$item['ItemName'];
    $shortTitleItem=substr($item['ItemName'],0,35);
    $additionalDots=($titleItem==$shortTitleItem)?'':'..';
    $latestItemNearToClose.='<div class="span4">
                        <div class="row-fluid">
                            <div class="span10">
                                <div class="text-center"> <h2 class="text-info item_title" title="'.$titleItem.'">' . $shortTitleItem .$additionalDots.'</h2> 
                                    <h5 class="text-info1">' . $item['AucID'] . '</h5>
                                    <img src="' . $imagePath . '" class="thumbnail">
                                    <h5>Time Left</h5>  <h3 id="countdown' . $count . '"></h3>
                                    <h5 class="text-info">Highest Bid</h5>
                                    <h2 class="text-info">' . $highest_bid . '</h2>
                                    <a class="toggle" href="javascript:void(0);">View Details</a> 
                                    <div class="item_desc">' . $item['Description'] . '</div>
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

/*
 * Town combo
 */
$townComboQuery = "SELECT * FROM  `town` ";
$townComboQueryResult = mysql_query($townComboQuery);
$townCombo = '<select class=" inpt" name="town">';
$townCombo.='<option value="0">Select City</option>';
while ($townRow = mysql_fetch_array($townComboQueryResult)) {
    $selected="";
    if($town==$townRow['TownID']){$selected="selected";}
    $townCombo.='<option value="' . $townRow['TownID'] . '" '.$selected.'>' . $townRow['TownName'] . '</option>';
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
        <script src="js/tooltips.js"></script>
        <link href='css/tooltips.css' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery.countdown.min.js" ></script>
        <style type="text/css">
            #countdown { width: 240px; height: 45px; }
            .span10 .text-center h5:nth-of-type(2),.span10 .text-center h5:nth-of-type(3) {
                margin-bottom: -10px;
            }
            .thumbnail{height: 170px;}
            .item_desc{line-height: 20px;
                       padding: 3px;
                       font-size: 14px;
                       display: none;
                       margin-top: 15px;
            }
            a.toggle {
                margin-top: 15px;
                clear: both;
                display: block;
            }
            .login-bg{display: none;}
            .item_title{min-height: 60px;}
        </style>
        <script type="text/javascript">
            
            $(document).ready(function(){
                $("input[type='reset']").on("click", function(event){

                    event.preventDefault();
                    // stops the form from resetting after this function

                    $(this).closest('form').get(0).reset();
                    // resets the form before continuing the function
                    
                    $(this).closest('form').get(0).submit();

                });
            });
        </script>
    </head>

    <body>
        <?php include('header.php'); ?>

        <div class="clearfix"></div>


        <div id="bannerp">
            <img src="images/bannerp.jpg"> </div>


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
                                            <option value="asc" <? if($timeleft=="asc"){echo "selected";} ?>>Least time left</option>
                                            <option value="desc"<? if($timeleft=="desc"){echo "selected";} ?>>Most Time Left</option>
                                        </select> 
                                    </div>
                                    <label class="control-label3" for="price" style="width:70px;">Item Price: </label>
                                    <div class="controls1">
                                        <select class=" inpd1" name="priceSort">
                                            <option value="">Select Price Sort</option>
                                            <option value="asc" <? if($priceSort=="asc"){echo "selected";} ?>>Lowest To Highest</option>
                                            <option value="desc" <? if($priceSort=="desc"){echo "selected";} ?>>Highest to lowest</option>
                                        </select> 
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="bids">Bids:</label>
                                    <div class="controls">
                                        <select class=" inpt" name="bidSort">
                                            <option value="">Select bid activity</option>
                                            <option value="asc" <? if($bidSort=="asc"){echo "selected";} ?>>Least bids</option>
                                            <option value="desc" <? if($bidSort=="desc"){echo "selected";} ?>>Most Bids</option> 
                                        </select> 
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="itemname">Enter Item Name:</label>
                                    <div class="controls">
                                        <input class="inpt1" type="text" id="itemName" name="itemName" value="<?=$itemName; ?>" > 
                                    </div>
                                </div>

                                <div class="control-group">

                                    <div class="controls">
                                        <input type="submit" class="btn btn-success" onclick="search();" value="Search" />
                                        <input type="reset" class="btn btn-info" value="Reset" />  
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>



                <div id="auction_items">
                    <?=$latestItemNearToClose; ?>
                </div>

                <div class="pagination pagination-right">
                    <ul>
                        <?php echo $o__pager->getPagerString('public.php' . $qurey_string); ?>
                    </ul>
                </div>
                <div id="countdown" class="countdown"></div>

               
            </div>
            <div class="clearfix"></div>
        </div>
        

        <!--footer-->

        <?php include('footer.php'); ?>
        <!--/footer-->

        
        <script type="text/javascript">
            $(function()
            {
                $(".toggle").click(function() 
                {  
                    // hides children divs if shown, shows if hidden 
                    $(this).next().toggle("medium",function() {
                        // Animation complete.
                        if($(this).prev().html()=='View Details'){
                            $(this).prev().html('Hide Details');
                        } else {
                            $(this).prev().html('View Details');
                        }
                    }); 
                }); 
                $("#auction_items h2[title]").tooltips();
            });
        </script>
        <script src="js/bootstrap.min.js"></script>                 
    </body>
</html>