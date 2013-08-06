<?php
 include("common.php");
            include("session_active.php");
          
if(!isset($_GET['activity'], $_GET['id'])) { ?> <script> window.location='reports-generation.php';</script>  <?php }


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


        <link  href="style_new.css" rel="stylesheet" media="screen">
        <link href="css/bootstrap_new.css" rel="stylesheet" media="screen">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,700' rel='stylesheet' type='text/css'>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
        <style type="text/css">
            #msg{margin-left: 50px;font-size: 20px;font-weight: bolder;margin-top: 10px;}
             #msgNote{margin:10px 0px 10px 105px;font-size: 20px;font-weight: bolder;}
            .colpn1,.colpn2{line-height: normal !important;}
        </style>
        <script>
        function chk()
        {
            $('#msg').html('');
           
            if(document.getElementById('recoverNote').value == '')
            {
                alert("Please Enter Note");
                document.getElementById('recoverNote').focus();
                return false;		
            }	
            else
                jQuery.ajax({
                    type:     'post',
                    dataType: 'html',
                    success:   function(data)
                    {				
                        if(data == "Note added Successfully")
                        {						
                          //  window.setTimeout("location='system_user.php'",2000);
                        }			
                        $('#msgNote').html(data);				     
                    },
                data:   (jQuery('#noteForm').serialize()),
                url:    "ajaxform.php"
            });
            return false;

        }
function chkRecover()
        {
            $('#msg').html('');
           
           
            if(document.getElementById('phone').value == '')
            {
                alert("Please Enter Phone");
                document.getElementById('phone').focus();
                return false;		
            }
            if(document.getElementById('note').value == '')
            {
                alert("Please Enter Note");
                document.getElementById('note').focus();
                return false;		
            }
            else
                jQuery.ajax({
                    type:     'post',
                    dataType: 'html',
                    success:   function(data)
                    {				
                        if(data == "Recovery info added Successfully")
                        {						
                          //  window.setTimeout("location='system_user.php'",2000);
                        }			
                        $('#msg').html(data);				     
                    },
                data:   (jQuery('#recoverForm').serialize()),
                url:    "ajaxform.php"
            });
            return false;

        }

    $(document).ready(function() {
    $("#receptNumber").keyup(function() {
         var txtVal=$("#receptNumber").val();
         if(txtVal!=null && txtVal!="")
         {
           $('#moneyRecover').prop('checked', true);     
         }else
        {
            $('#moneyRecover').prop('checked', false);
        }
    });
$("#receptNumber").bind("change",function() {
         var txtVal=$("#receptNumber").val();
         if(txtVal!=null && txtVal!="")
         {
           $('#moneyRecover').prop('checked', true);     
         }else
        {
            $('#moneyRecover').prop('checked', false);
        }
    });
    });
</script>
    </head>

    <body>

        <div class="main-header">
            <?php include('header.php');
           
?>
        </div>
        <div class="clearfix"></div>


        <div class="container">   

            <div class="subheads">Recovery Activity</div>

            <div class="matter">
                <div class="fheading"><h1> RECOVER FOR <?php echo $_GET['activity']." ".":"." ".$_GET['id']; ?></h1></div>

                <div class="row-fluid" style="  border-bottom: 3px solid #eeeeee; margin-bottom: 20px; padding-bottom: 10px;">
                    <div class="table-title"> CONTRIBUTION INFO :</div>
                    <div class="span7 ">
                        <div class="row-fluid">

                            <div class="user-detail">
                                <?php
                                    $activity=$_GET['activity'];
                                    switch ($activity)
                                    {
                                    case "Bid":
                                      $tablename="bids";
                                      $tblId="BidID";
                                      $condition=" and auc.AucID=tbl.AucID";
                                      break;
                                    case "Pledge":
                                      $tablename="pledgechallenge";
                                      $tblId="ChallengeID";
                                      $condition='';
                                      break;
                                    case "Donation":
                                      $tablename="pledges";
                                      $tblId="PledgeID";
                                      $condition='';
                                      break;
                                    }
                                    if( $tablename=="bids"){
                                        $tablename="auctionitems as auc, bids";
                                    }
                                    //$q= "select * from ".$tablename." where ".$tblId."=".$_GET['id'];     
                                    $query="SELECT * 
                                    FROM clientinfo AS cl, ".$tablename." AS tbl, proxybidderinfo pbi
                                    WHERE cl.`index` = tbl.ReceiptInfo
                                    AND tbl.ProxyID = pbi.ProxyID 
                                    AND ".$tblId."=".$_GET['id'].$condition;
                                    
                                    $userid=mysql_fetch_array(mysql_query($query));
                                   
                                  
                                    
                                ?>
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="30%" rowspan="7"><img src="images/RecoveryOperation.jpg" alt="add"></td>
                                        <td width="21%"><h2 align="right">Client Name:</h2></td>
                                        <td width="49%" class="leftp15"><?php echo $userid['FirstName']." ".$userid['LastName'];?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">Proxy Bidder:</h2></td>
                                        <td class="leftp15"><?php echo $userid['Fname']." ".$userid['Lname'];?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">Date:</h2></td>
                                        <td class="leftp15"><?php echo date('d/m/Y - H:i', strtotime($userid['TimeStamp']));?></td>
                                    </tr>
                                    <tr>
                                        <td><h2 align="right">Amount:</h2></td>
                                        <td class="leftp15">N$ <?php echo $userid['Amount'];?></td>
                                    </tr>
                                    <?php
                                    if ($_GET['activity'] == 'Bid') {
                                        ?>
                                        <tr>
                                            <td><h2 align="right">Expired On:</h2></td>
                                            <td class="leftp15"><?php echo date('d/m/Y - H:i', strtotime($userid['CloseDateTime']));?></td>
                                        </tr>
                                        <tr>
                                            <td><h2 align="right">Item:</h2></td>
                                            <td class="leftp15" style="line-height: normal;"><?php echo $userid['ItemName'];?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td><h2 align="right">Phone:</h2></td>
                                        <td class="leftp15"><?php echo $userid['TelephoneNumber'];?></td>
                                    </tr>
                                </table>


                            </div>

                        </div>
                    </div>
                    <div class="span4">
                        <div class="row-fluid">

                            <div class="user-detail">
                                <?php
                                if ($_GET['activity'] == 'Bid') {
                                    ?>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td><img style="width:320px;" src="uploads/<?php if($userid['Photo']==""){echo "VerticalLogo.png";}else{echo $userid['Photo'];}?>"></td>
                                        </tr>
                                        <tr>
                                            <td><h2 align="center"><?php echo $userid['ItemName'];?></h2></td>
                                        </tr>
                                    </table>
    <?php
}
?>
                            </div>

                        </div>
                    </div>
                </div>


                <div class="clearfix"></div>

                <div class="row-fluid" style="  border-bottom: 3px solid #eeeeee; margin-bottom: 20px; padding-bottom: 10px;">
                    <div class="table-title"> RECOVERY INFO :</div>
                    <div class="span7 ">
                        <div class="row-fluid">

                            <div class="user-detail">
<?php
 if( $tablename=="auctionitems as auc, bids"){
    $tablename="bids";
}

 $qry = mysql_query("Select * from mneyrecovrycontactlog mn, ".$tablename." tbl
     where mn.ActivityType = '".$_GET['activity']."' and
         tbl.".$tblId." = mn.ActivityId and
         mn.ActivityId='".$_GET['id']."'") or die(mysql_error());
    $cnt = mysql_num_rows($qry);
    if($cnt > 0)
    {
        $recoveryDetail=mysql_fetch_array($qry);     
              $moneyRecover=$recoveryDetail['MoneyRecovered'];
        $moneyWritenOff=$recoveryDetail['MoneyWrittenOff'];
        $receipt=$recoveryDetail['ReceiptNo'];
        $phone=$recoveryDetail[3];
        $contactMode=$recoveryDetail['ModeOfContact'];  
        $note=$recoveryDetail['Notes'];          
    }  else {
        $moneyRecover="";
        $moneyWritenOff="";
        $receipt="";
        $phone="";
        $contactMode="";  
        $note="";      
    }
?>
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="30%"><img src="images/recoverinfo_img.jpg" alt="add"></td>
                                        <td colspan="2">
                                            <form class="form-horizontal" name="recoverForm" id="recoverForm"  onSubmit="return chkRecover()">
                                                <input type="hidden" name="recoverinfo" id="recoverinfo" value="recoverinfo" >
                                                <input type="hidden" name="activityType" id="activityType" value="<?php echo $_GET['activity'];?>" >
                                                <input type="hidden" name="activityId" id="activityId" value="<?php echo $_GET['id'];?>" >
                                                <input type="hidden" name="proxyid" id="proxyid" value="<?php echo $userid['ProxyID'];?>" >
                                             <div class="control-group">
                                                <div id="msg"></div>
                                                 </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Money Recovered: </label>
                                                    <div class="controls">
                                                        <label class="checkbox">    
                                                            <input type="radio"  <?php if($moneyRecover==1){echo "checked";}?> name="moneyRecover" id="moneyRecover"  value='moneyRecover'> 
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Money Written Off: </label>
                                                    <div class="controls">
                                                        <label class="checkbox" >
                                                            <input type="radio"  <?php if($moneyRecover==1){echo "checked";}?> value='moneyWritten' name="moneyRecover" id="moneyWritten">
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Receipt No:</label>
                                                    <div class="controls">
                                                        <input type="text" value="<?php echo $receipt;?>" id="receptNumber" name="receptNumber">
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Client Phone:</label>
                                                    <div class="controls">
                                                        <input type="text" value="<?php echo $phone;?>" id="phone" name="phone">
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Contact Mode:</label>
                                                    <div class="controls">
                                                        <select name="contactMode" id="contactMode"> 
                                                            <option value="Telephone" <?php if($contactMode=="Telephone"){echo "selected";}?> >Telephone</option>
                                                            <option value="SMS" <?php if($contactMode=="SMS"){echo "selected";}?> >SMS</option>
                                                            <option value="Email" <?php if($contactMode=="Email"){echo "selected";}?>  >Email</option>
                                                            <option value="Post"  <?php if($contactMode=="Post"){echo "selected";}?>>Post</option>

                                                        </select> 
                                                    </div>
                                                </div>

                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Note :</label>
                                                    <div class="controls">
                                                        <input type="text" value="<?php echo $note;?>" id="note" name="note">
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="control-group">

                                                    <div class="controls">
                                                        <button type="submit" class="btn btn-warning">Save</button>    
                                                    </div>
                                                </div>
                                            </form>

                                        </td>
                                    </tr>
                                </table>


                            </div>

                        </div>
                    </div>

                </div>
















                <div class="row-fluid" style="  margin-bottom: 20px; padding-bottom: 10px;">
                    <div class="table-title"> NOTES :</div>
                    <div class="span11">
                        <div class="row-fluid">

                            <div class="user-detail">

                                <table width="100%" border="0">
                                    <tr>
                                        <td width="30%"><img src="images/notes.jpg" alt="add"></td>
                                        <td colspan="2">
                                            <form class="form-horizontal" id="noteForm" name="noteForm" onSubmit="return chk()">
                                                <input type="hidden" name="recovernote" id="recovernote" value="recovernote" >
                                                <input type="hidden" name="activityType" id="activityType" value="<?php echo $_GET['activity'];?>" >
                                                <input type="hidden" name="activityId" id="activityId" value="<?php echo $_GET['id'];?>" >
                                                 <input type="hidden" name="proxyId" id="proxyId" value="<?php echo $_SESSION['id'];?>" >
                                             
                                                <div class="control-group">
                                                   
                                                    <label class="control-label1" for="inputPassword">Enter a new note about this transaction : </label>
                                                     <div id="msgNote"></div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label2">
                                                        <textarea class="textin" cols="" id="recoverNote" name="recoverNote" rows=""></textarea></label>

                                                </div>
                                                <div class="control-group">

                                                    <div class="control-label2">
                                                        <button type="submit" class="btn btn-warning">Save</button>    
                                                    </div>
                                                </div>
                                            </form>

                                        </td>
                                    </tr>
                                </table>




                            </div>

                            <div class="table-stitle"> PAST NOTES :</div>
                           <?php 
                            $qry = mysql_query("Select * from proxybidderinfo pr, notes nt
                                            where nt.ProxyID = pr.ProxyID and
                                            nt.ActivityID=".$_GET['id']." and nt.ActivityType='".$_GET['activity']."'") or die(mysql_error());
   $count=1;
   if(mysql_num_rows($qry)>0)
   {
        while($note=mysql_fetch_array($qry))
        {
            $class="colpn1";
            if($count%2==0)
            {
                $class="colpn2";
            }
        ?>
                            <div class="<?php echo $class;?>">
                                <div class="pnid"><?php echo $count;?>.</div>
                                <div class="pntitle">Entered By: <?php echo $note["Fname"]. " ".$note["Lname"];?> on <?php echo date('d/m/Y  H:i', strtotime($note['timestamp']));?></div>
                                <div class="pndesc"><?php echo $note["Note"];?></div>
                            </div>
<?php
$count++;
}
   }
 else {
     ?>
       <div class="colpn2">
                                <div class="pnid"></div>
                                <div class="pntitle">No Record Found</div>
                                <div class="pndesc"></div>
                            </div>
<?php }?>
                            
                        </div>
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



<!--footer-->

<?php include('footer.php'); ?>

<!--/footer-->










<script src="js/bootstrap.min.js"></script>                 
</body>
</html>