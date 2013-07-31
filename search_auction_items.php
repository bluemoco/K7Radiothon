<?php

include_once("config/connect.php");
//echo "<pre>";print_r($_POST);echo "</pre>";


/*
 * Data posted
 *  [town] => 0
  [timeleft] => asc/desc
  [priceSort] => asc/desc
  [bidSort] => asc/desc
  [itemName] =>
 */

$town = $_POST['town'];
$timeleft = $_POST['timeleft'];
$priceSort = $_POST['priceSort'];
$bidSort = $_POST['bidSort'];
$itemName = $_POST['itemName'];

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

$limit="";
/*if($condition==""){
    $limit="LIMIT 10";
}*/

//2013-05-23 10:30:00 Time format in mysql
$currentDateTime = date('Y-m-d H:i:s');

$getClosestToCloseItemQuery = "SELECT ai.*, IFNULL((SELECT MAX(AMOUNT) FROM bids b WHERE b.AucID=ai.AucID),0) as highest_bid,(SELECT COUNT(*) FROM bids b WHERE b.AucID=ai.AucID) as bidcount FROM `auctionitems` ai WHERE `CloseDateTime`>'" . $currentDateTime . "' " . $condition ." ".$orderBy." ".$limit;
//echo $getClosestToCloseItemQuery;
$getClosestToCloseItemQueryResult = mysql_query($getClosestToCloseItemQuery);
$count = 0;
$latestItemNearToClose = '<div class="row-fluid bottom-border" style="margin-bottom: 20px; padding-bottom:20px;">';
if (mysql_num_rows($getClosestToCloseItemQueryResult) == 0) {
    $latestItemNearToClose.="No record found";
} else {
    while ($item = mysql_fetch_array($getClosestToCloseItemQueryResult)) {
        if ($count % 3 == 0) {
            $latestItemNearToClose.='</div><div class="row-fluid bottom-border" style="margin-bottom: 20px; padding-bottom:20px;">';
        }

        $highest_bid = ($item['highest_bid'] != 0) ? "N$" . $item['highest_bid'] : "No bid placed";
        $imageName=($item['Photo']=='')?'big_logo.png':$item['Photo'];
        $imagePath = "uploads/" . $imageName;
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
}
$latestItemNearToClose.='</div>';



echo $latestItemNearToClose;
?>
