<?php

include("common.php");
include("session_active.php");


$startdate = date("Y-m-d H:i:s", strtotime($_POST['startdate']));
$enddate = date("Y-m-d H:i:s", strtotime($_POST['enddate']));
$status = $_POST['status'];
$proxy = $_POST['proxy'];
$contactmode = $_POST['contactmode'];

$timeStampCondition = ' AND p.`TimeStamp`>"' . $startdate . '" AND p.`TimeStamp`<"' . $enddate . '"';
$bidTimeStampCondition = ' AND b.`TimeStamp`>"' . $startdate . '" AND b.`TimeStamp`<"' . $enddate . '"';

$proxyCondtion = "";
$bidProxyCondition = "";
$statusCondition = "";
$bidStatusCondition = "";
if ($proxy != "") {
    $proxyCondtion = " AND p.ProxyID='" . $proxy . "'";
    $bidProxyCondition = " AND b.proxyID='" . $proxy . "'";
}
if ($status != "") {
    $statusCondition = " AND p." . $status . "='1'";
    $bidStatusCondition = " AND b." . $status . "='1'";
}


if($contactmode !="") {
    
    $contactCondition=" AND m.ModeOfContact='".$contactmode."'";
    
    //Pledge Query
    $pledgeQuery = "(Select *,'Pledge' as type from clientinfo as c ,town as t ,pledgechallenge  as p,proxybidderinfo a,mneyrecovrycontactlog m WHERE c.TownID = t.TownID AND c.`index` = p.ReceiptInfo AND p.ProxyID=a.ProxyID AND m.ActivityType='Pledge' AND m.ActivityId=p.ChallengeID" . $timeStampCondition . $proxyCondtion . $statusCondition .$contactCondition. ")";
    //$reportQuery.="UNION ALL";
    //Donation Query
    $donationQuery.="(Select *,'Donation' as type from clientinfo as c ,town as t ,pledges as p, proxybidderinfo a,mneyrecovrycontactlog m WHERE c.TownID = t.TownID AND c.`index` = p.ReceiptInfo AND p.ProxyID=a.ProxyID AND m.ActivityType='Donation' AND m.ActivityId=p.PledgeID" . $timeStampCondition . $proxyCondtion . $statusCondition .$contactCondition. ")";
    //$reportQuery.="UNION ALL";
    //Bid Query
    $bidQuery.="(Select *,'Bid' as type from  bids as b , clientinfo as c , town as t,proxybidderinfo a,mneyrecovrycontactlog m WHERE  b.ReceiptInfo = c.index AND c.TownID = t.TownID AND b.ProxyID=a.ProxyID AND m.ActivityType='Bid' AND m.ActivityId=b.BidID " . $bidTimeStampCondition . $bidProxyCondition . $bidStatusCondition .$contactCondition. ")";
} else {
//Pledge Query
    $pledgeQuery = "(Select *,'Pledge' as type from clientinfo as c ,town as t ,pledgechallenge  as p,proxybidderinfo a WHERE c.TownID = t.TownID AND c.`index` = p.ReceiptInfo AND p.ProxyID=a.ProxyID " . $timeStampCondition . $proxyCondtion . $statusCondition . ")";
//$reportQuery.="UNION ALL";
//Donation Query
    $donationQuery.="(Select *,'Donation' as type from clientinfo as c ,town as t ,pledges as p, proxybidderinfo a WHERE c.TownID = t.TownID AND c.`index` = p.ReceiptInfo AND p.ProxyID=a.ProxyID " . $timeStampCondition . $proxyCondtion . $statusCondition . ")";
//$reportQuery.="UNION ALL";
//Bid Query
    $bidQuery.="(Select *,'Bid' as type from  bids as b , clientinfo as c , town as t,proxybidderinfo a WHERE  b.ReceiptInfo = c.index AND c.TownID = t.TownID AND b.ProxyID=a.ProxyID " . $bidTimeStampCondition . $bidProxyCondition . $bidStatusCondition . ")";
}
//echo $bidQuery;
//echo $reportQuery;
$pledgeQueryResult = mysql_query($pledgeQuery);
$donationQueryResult = mysql_query($donationQuery);
$bidQueryResult = mysql_query($bidQuery);


$dataTableData = "";
while ($report = mysql_fetch_array($pledgeQueryResult)) {
    $status=($report['MoneyRecovered']==1)?'Money Recovered':(($report['MoneyWrittenOff']==1)?'Money Written Off':'-');
    $dataTableData.="['" . $report['ChallengeID'] . "','" . $report['type'] . "','" . $report['FirstName'] . " " . $report['LastName'] . "','" . $report['Amount'] . "','" . $report['Fname'] . " " . $report['Lname'] . "','" . $status . "'],";
}
while ($report = mysql_fetch_array($donationQueryResult)) {
    $status=($report['MoneyRecovered']==1)?'Money Recovered':(($report['MoneyWrittenOff']==1)?'Money Written Off':'-');
    $dataTableData.="['" . $report['PledgeID'] . "','" . $report['type'] . "','" . $report['FirstName'] . " " . $report['LastName'] . "','" . $report['Amount'] . "','" . $report['Fname'] . " " . $report['Lname'] . "','" . $status . "'],";
}
while ($report = mysql_fetch_array($bidQueryResult)) {
    $status=($report['MoneyRecovered']==1)?'Money Recovered':(($report['MoneyWrittenOff']==1)?'Money Written Off':'-');
    $dataTableData.="['" . $report['BidID'] . "','" . $report['type'] . "','" . $report['FirstName'] . " " . $report['LastName'] . "','" . $report['Amount'] . "','" . $report['Fname'] . " " . $report['Lname'] . "','" . $status . "'],";
}
$dataTableData = substr($dataTableData, 0, -1);
//$script='<script type="text/javascript">
$script = 'var aDataSet = [' . $dataTableData . '];
$("#dynamic").html( "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" class=\"display table table-striped table-hover\" id=\"example\"></table>" );
$("#example").dataTable({
    "sPaginationType": "full_numbers",
    "bFilter": false,
    "bLengthChange": true,
    "bSort": true,
    "bInfo": true,
    "aaData": aDataSet,
    "oLanguage": {
        "oPaginate": {
            "sFirst": "<<",
            "sLast": ">>",
            "sNext": ">",
            "sPrevious": "<"
        }
    },
    "aoColumns": [
        { "sTitle" : "Id" },
        { "sTitle" : "Type" },
        { "sTitle" : "Contributor" },
        { "sTitle" : "Amount" },
        { "sTitle" : "Proxy" },
        { "sTitle" : "Status" }
    ],
    "fnRowCallback": function( nRow, aData, iDisplayIndex ) {
        $("td:eq(5)", nRow).html("<a href=\'recover-activity.php?id=" + aData[0] + "&activity="+aData[1]+"\'>" +
            aData[5] + "</a>");
        return nRow;
    }
});';
//</script>';

echo $script;
//echo "alert('hello');";
?>