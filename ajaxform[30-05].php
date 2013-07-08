<?php
include("common.php");

if($_REQUEST['login'])
{
  
   $qry1 = mysql_query("Select * from admin where username='".$_REQUEST['em']."' AND password ='".$_REQUEST['ps']."'");
   $cnt1 = mysql_num_rows($qry1);
   
   if($cnt1 > 0)
   {   		 
			$row1 = mysql_fetch_array($qry1);
			
			$_SESSION['id'] = $row1['id'];
			$_SESSION['Username'] = $row1['username'];
			$_SESSION['login']="true";
			$_SESSION['sadmin']="true";
			$res['status'] = "success";
			$res['msg'] = "Login Successfully.. Redirecting";   
			echo json_encode($res);
			exit;
   }
   else
   {  
		   $qry = mysql_query("Select * from proxybidderinfo where Username='".$_REQUEST['em']."' AND Password ='".base64_encode($_REQUEST['ps'])."'");
		   $cnt = mysql_num_rows($qry);
		   
		   if($cnt > 0)
		   {
				$row = mysql_fetch_array($qry);
				
				$_SESSION['id'] = $row['ProxyID'];
				$_SESSION['Tell'] = $row['Tell'];
				$_SESSION['Username'] = $row['Username'];
				$_SESSION['TelephoneNumber'] = $row['TelephoneNumber'];
				$_SESSION['login']="true";
		  
				$res['status'] = "success";
				$res['msg'] = "Login Successfully.. Redirecting";   
				echo json_encode($res);
				exit;
				
		   }
		   else
		   {
			    $res['status'] = "Failed";
				$res['msg'] = "Login Faild";   
				echo json_encode($res);
				exit;
		   }
   }
   
   
}


if($_REQUEST['user'])
{
   if($_REQUEST['hdnaction'] == 'Update')
   { 
  	 $q = mysql_query("UPDATE clientinfo SET Phone = '".$_REQUEST['Phone']."', FirstName = '".$_REQUEST['FirstName']."', LastName = '".$_REQUEST['LastName']."',
	 StreetName = '".$_REQUEST['StreetName']."', HouseNumber = '".$_REQUEST['HouseNumber']."',POBox = '".$_REQUEST['POBox']."', TownID = '".$_REQUEST['TownID']."',
	 Email = '".$_REQUEST['Email']."', Anonymous = '".$_REQUEST['Anonymous']."', TimeStamp = '".date("Y-m-d")."' WHERE `index` = '".$_REQUEST['userid']."'");
		
	 $_SESSION['cid'] = $_REQUEST['userid'];
	 $_SESSION['name'] = $_REQUEST['FirstName']. " " . $_REQUEST['LastName'];
	 echo "User updated Successfully";
   }
   else
   {
	
	   $qry = mysql_query("Select * from clientinfo where Phone='".$_REQUEST['Phone']."'");
	   $cnt = mysql_num_rows($qry);
	   
	   if($cnt == 0)
	   {
  		 $q =  mysql_query("insert into `clientinfo`(Phone,FirstName,LastName,StreetName,HouseNumber,POBox,ProxyBidder,TownID,Email,Anonymous,TimeStamp) 
		  values('".$_REQUEST['Phone']."','".$_REQUEST['FirstName']."','".$_REQUEST['LastName']."','".$_REQUEST['StreetName']."','".$_REQUEST['HouseNumber']."',
		  '".$_REQUEST['POBox']."','".$_SESSION['id']."','".$_REQUEST['TownID']."','".$_REQUEST['Email']."','".$_REQUEST['Anonymous']."','".date("Y-m-d")."')");
		  
		  $_SESSION['cid'] = mysql_insert_id();
		  $_SESSION['name'] = $_REQUEST['FirstName']. " " . $_REQUEST['LastName'];
		   
		  echo "User added Successfully";	
		  
	   }
	   else
	   {
		   echo "Thia User is already added";
	   }
	}
}




if($_REQUEST['bid'])
{
   $q =  mysql_query("insert into `bids`(AucID,Amount,TimeStamp,ProxyID,ReceiptInfo,Anonymous) 
		  values('".$_SESSION['bid']."','".$_REQUEST['Amount']."','".date("Y-m-d H:i:s")."','".$_SESSION['id']."','".$_SESSION['cid']."','".$_REQUEST['Anonymous']."')");
		 		   
   echo "bid added Successfully";	
	
}


if($_REQUEST['pledge'])
{
   $q =  mysql_query("insert into `pledges`(ReceiptInfo,Amount,ProxyID,TimeStamp) 
		  values('".$_SESSION['cid']."','".$_REQUEST['Amount']."','".$_SESSION['id']."','".date("Y-m-d H:i:s")."')");
		 		   
   echo "Pledge added Successfully";	
	
}



if($_REQUEST['Challenge'])
{
   $q =  mysql_query("insert into `pledgechallenge`(Amount,ProxyID,TimeStamp,ReceiptInfo) 
		  values('".$_REQUEST['Amount']."','".$_SESSION['id']."','".date("Y-m-d H:i:s")."','".$_SESSION['cid']."')");
		 		   
   echo "Challenge added Successfully";	
	
}

if($_REQUEST['delete'])
{
	mysql_query("DELETE from clientinfo WHERE `index` = '".$_REQUEST['delete']."'");
}

?>