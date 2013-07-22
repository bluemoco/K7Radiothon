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
                        $('#msg').html(data);				     
                    },
                data:   (jQuery('#noteForm').serialize()),
                url:    "ajaxform.php"
            });
            return false;

        }
function chkRecover()
        {
            $('#msg').html('');
           
            if(document.getElementById('receptNumber').value == '')
            {
                alert("Please Enter Note");
                document.getElementById('receptNumber').focus();
                return false;		
            }	
            if(document.getElementById('phone').value == '')
            {
                alert("Please Enter Note");
                document.getElementById('phone').focus();
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

    </script>
    </head>

    <body>

        <div class="main-header">
            <?php include('header.php');
            include("common.php");
            include("session_active.php");
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
                                      $tablename="auctionitems as auc, bids";
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
                                        <td class="leftp15">$ <?php echo $userid['Amount'];?></td>
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
                                            <td class="leftp15"><?php echo $userid['ItemName'];?></td>
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
                                            <td><img src="uploads/<?php echo $userid['Photo'];?>"></td>
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
                                                    <label class="control-label" for="inputPassword">Money Recovered: </label>
                                                    <div class="controls">
                                                        <label class="checkbox">
                                                            <input type="checkbox" name="moneyRecover" id="moneyRecover"  value='1'> 
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Money Written Off: </label>
                                                    <div class="controls">
                                                        <label class="checkbox" >
                                                            <input type="checkbox" value='1' name="moneyWritten" id="moneyWritten">
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Receipt No:</label>
                                                    <div class="controls">
                                                        <input type="text" id="receptNumber" name="receptNumber">
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Client Phone:</label>
                                                    <div class="controls">
                                                        <input type="text" id="phone" name="phone">
                                                    </div>
                                                </div>

                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Contact Mode:</label>
                                                    <div class="controls">
                                                        <select name="contactMode" id="contactMode"> 
                                                            <option value="Telephone">Telephone</option>
                                                            <option value="SMS">SMS</option>
                                                            <option value="Email">Email</option>
                                                            <option value="Post">Post</option>

                                                        </select> 
                                                    </div>
                                                </div>

                                                
                                                <div class="control-group">
                                                    <label class="control-label" for="inputPassword">Note :</label>
                                                    <div class="controls">
                                                        <input type="text" id="note" name="note">
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
                                             
                                                <div class="control-group">
                                                    <label class="control-label1" for="inputPassword">Enter a new note about this transaction : </label>

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
                            <div class="colpn1">
                                <div class="pnid">1.</div>
                                <div class="pntitle">Entered By: Rosa Whalum on 8/5/2013  14:43</div>
                                <div class="pndesc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vel commodo ante, quis porta felis. Phasellus ac est eros. Maecenas fermentum, neque eu rutrum mollis, ipsum nisl varius velit.</div>
                            </div>

                            <div class="colpn2">
                                <div class="pnid">1.</div>
                                <div class="pntitle">Entered By: Rosa Whalum on 8/5/2013  14:43</div>
                                <div class="pndesc">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vel commodo ante, quis porta felis. Phasellus ac est eros. Maecenas fermentum, neque eu rutrum mollis, ipsum nisl varius velit.</div>
                            </div>
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