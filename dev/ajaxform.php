<?php
//include('phpmailer/class.phpmailer.php');
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
		   $qry_new = mysql_query("Select * from proxybidderinfo where Username='".$_REQUEST['em']."' AND Password ='".base64_encode($_REQUEST['ps'])."'");
		   $cnt_new = mysql_num_rows($qry_new);
		   
		   if($cnt_new > 0)
		   {
				$row = mysql_fetch_array($qry_new);
				
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
				$res['msg'] = "Login Failed";   
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


if($_REQUEST['systemuser'])
{
   if($_REQUEST['hdnaction'] == 'Update')
   { 
  	 $q = mysql_query("UPDATE admin SET username = '".$_REQUEST['Username']."', password = '".$_REQUEST['Password']."', status = '".$_REQUEST['Status']."' 
             WHERE `id` = '".$_REQUEST['userid']."'");
		
	 echo "User updated Successfully";
   }
   else
   {
	
	   $qry = mysql_query("Select * from admin where username = '".$_REQUEST['Username']."'");
	   $cnt = mysql_num_rows($qry);
	   
	   if($cnt == 0)
	   {
  		 $q =  mysql_query("insert into `admin`(username,password,status) 
		  values('".$_REQUEST['Username']."','".$_REQUEST['Password']."','".$_REQUEST['Status']."')");
		 
		  echo "User added Successfully";	
		  
	   }
	   else
	   {
		   echo "Thia User is already added";
	   }
	}
}

if($_REQUEST['recovernote'])
{
    $q =  mysql_query("insert into `notes`(ActivityType,ActivityID,Note,timestamp) values
        ('".$_REQUEST['activityType']."','".$_REQUEST['activityId']."','".$_REQUEST['recoverNote']."','".date('Y-m-d H:i:s')."')");
     echo "Note added Successfully";	
	
}


if($_REQUEST['recoverinfo'])
{
    $q =  mysql_query("insert into `mneyrecovrycontactlog`(ActivityType,ActivityID,Notes,TimeStamp,TelephoneNumber,ReceiptNo,ModeOfContact,ProxyID) values
        ('".$_REQUEST['activityType']."','".$_REQUEST['activityId']."','".$_REQUEST['note']."','".date('Y-m-d H:i:s')."'
            ,'".$_REQUEST['phone']."','".$_REQUEST['receptNumber']."','".$_REQUEST['contactMode']."','".$_REQUEST['proxyid']."'
               )");
     echo "Note added Successfully";	
	
}

if($_REQUEST['proxy'])
{
   $q =  mysql_query("insert into `proxybidderinfo`(Role,Fname,Lname,TownId,Email,Username,Password,TelephoneNumber) 
		  values('".$_REQUEST['role']."','".$_REQUEST['FirstName']."','".$_REQUEST['LastName']."','".$_REQUEST['TownID']."','".$_REQUEST['Email']."','".$_REQUEST['Username']."','".base64_encode($_REQUEST['Password'])."','".$_REQUEST['Phone']."')");
	
	
	if($_REQUEST['role'] == 1)
	{
		 $q =  mysql_query("insert into `admin`(username,password,status) values('".$_REQUEST['Username']."','".$_REQUEST['Password']."','1')");	
	}
    
	echo "User added Successfully";	
	
}


if($_REQUEST['bid'])
{
   $q =  mysql_query("insert into `bids`(AucID,Amount,TimeStamp,ProxyID,ReceiptInfo,Anonymous) 
		  values('".$_SESSION['bid']."','".$_REQUEST['Amount']."','".date("Y-m-d H:i:s")."','".$_SESSION['id']."','".$_SESSION['cid']."','".$_REQUEST['Anonymous']."')");
		 		   
   echo "Bid Placed Successfully";	
	
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

if($_REQUEST['donnor'])
{
   $qry1 = mysql_query("Select * from donnorinfo where `index` = '".$_REQUEST['donnor']."'");
   $cnt1 = mysql_num_rows($qry1);
   
   if($cnt1 == 0)
   { 
	 $qry = mysql_query("Select * from clientinfo where `index` = '".$_REQUEST['donnor']."'");
	 $row = mysql_fetch_assoc($qry);
	
	 $q =  mysql_query("insert into `donnorinfo`(`index`,Phone,FirstName,LastName, TownID , Email, TimeStamp) 
		  values('".$row['index']."','".$row['Phone']."','".$row['FirstName']."','".$row['LastName']."','".$row['TownID']."','".$row['Email']."',
		  '".date("Y-m-d H:i:s")."')");
   }
   else
   {
   		mysql_query("DELETE from donnorinfo WHERE `index` = '".$_REQUEST['donnor']."'");
   }
   
	
}



if($_REQUEST['forgot'])
{ 
	$nm = $_POST['em'];
	$qry=mysql_query("select * from proxybidderinfo where Email='$nm'");
    $user=mysql_num_rows($qry);
	$res=mysql_fetch_array($qry);
	if($user > 0)
	{
		
		$format="text/html";
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: ". $format ."; charset=iso-8859-1\r\n";
		$from = "steveamillion@gmail.com";
		$to = $_POST['em'];
		$subject = "Password Recovery";
		$content .= '<br>Email : '.$res['Username'];
	    $content .= '<br>Password : '.base64_decode($res['Password']);	 		
		$headers .= "From: $from\r\n";
		$state = @mail($to, $subject, $content, $headers);
		
		$jsn['msg'] = "Password Sent to your Email";   
		echo json_encode($jsn);
		exit;			
	}
	else
	{
		$jsn['msg'] = "Invalid Email Id";   
		echo json_encode($jsn);
		exit;	
	}
 
}


?>