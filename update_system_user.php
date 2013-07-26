<?php
include("common.php");
include("session_active.php");

if (isset($_GET['act']) && $_GET['act'] = 'delete' && isset($_GET['id'])) {
    mysql_query("delete from admin where id = " . $_GET['id']);
    echo "<script>window.location.href='system_user.php'</script>";
}


if (isset($_GET['id'])) {
    $user = mysql_query("select * from admin where id = " . $_GET['id']);
    $arrsystemuser = mysql_fetch_assoc($user);

    $username = $arrsystemuser['username'];
    $paassword = $arrsystemuser['password'];
    $status = $arrsystemuser['status'];
}
?>

<!doctype html>

<head>

    <?php default_js_css(); ?>	

<!--    <script>
        $(document).ready(function(){  
            jQuery('.btn').removeClass('btn-primary');	 
         
    <?php //if (isset($_SESSION['auc'])) {  ?>  jQuery('#btn2').removeClass('btn-inverse');	  jQuery('#btn2').addClass('btn-primary');  <?php //}  ?>
    <?php //if (isset($_SESSION['dnt']) || isset($_SESSION['cha'])) { ?>  jQuery('#btn3').removeClass('btn-inverse');	jQuery('#btn3').addClass('btn-primary'); <?php //} ?>
    <?php //if (isset($_SESSION['admin1'])) { ?>  jQuery('#btn4').removeClass('btn-inverse');	  jQuery('#btn4').addClass('btn-primary');  <?php //} ?>
     
                 });
    </script>-->
    <script>
        function chk()
        {
            $('#msg').html('');
            if(document.getElementById('Username').value == '')
            {
                alert("Please Enter Username");
                document.getElementById('Username').focus();
                return false;		
            }
            if(document.getElementById('Password').value == '')
            {
                alert("Please Enter Password");
                document.getElementById('Password').focus();
                return false;		
            }
            if(document.getElementById('Status').value == '')
            {
                alert("Please Enter Status");
                document.getElementById('Status').focus();
                return false;		
            }	
            $.ajax({
                type:     'post',
                dataType: 'html',
                success:   function(data)
                {				
                    if(data == "User added Successfully")
                    {						
                        window.setTimeout("location='system_user.php'",2000);
                    }			
                    $('#msg').html(data);				     
                },
                data:   (jQuery('#frm').serialize()),
                url:    "ajaxform.php"
            });
           
            return false;

        }

    </script>	
    <style type="text/css">
        .radio-div{
            width: 70px;
            float: left;
            padding: 10px;
        }
        .radio-div input[type="radio"]{
            margin-right: 5px;
            margin-top: -3px;
        }
    </style>

</head>


<body>

    <div class="main-header">
        <?php include('header.php'); ?>
    </div>
    <div class="clearfix"></div>

    <div class="container">  

        <div class="subheads">Update System User</div>

        <div class="matter">
            <div class="fheading"><h1><div style="text-align:center" id="msg" ></div></h1></div>
            <div class="row-fluid">
                <div class="span7">
                    <!--form-->
                    <form class="form-horizontal" name="frm" id="frm" onSubmit="return chk();">
                        <input type="hidden" name="systemuser" id="user" value="systemuser" >
                        <input type="hidden" name="hdnaction" id="hdnaction" value="<?php
        if (isset($_GET['id'])) {
            echo 'Update';
        } else {
            echo 'Save';
        }
        ?>" >
                        <input type="hidden" name="userid" id="userid" value="<?php echo $_GET['id']; ?>" >

                        <div class="control-group">
                            <label class="control-label" for="inputEmail">User Name</label>
                            <div class="controls"> 
                                <input type="text" id="Username" name="Username" value="<?php echo $username; ?>" >
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="inputPassword">Password</label>
                            <div class="controls">
                                <input type="text" id="Password" name="Password"  value="<?php echo $paassword; ?>">
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="inputPassword">Status</label>
                            <div class="controls">
                                <!--<input type="text" id="Status" name="Status"  value="<?php echo $status; ?>">-->
                                <? if ($status == 1) { ?>
                                    <div class="radio-div"><input type="radio" id="Status" name="Status" value="1" checked="checked" />Active</div>
                                    <div class="radio-div"><input type="radio" id="Status"name="Status" value="0" />Inactive</div>
                                <? } else if ($status == 0) { ?>    
                                    <div class="radio-div"><input type="radio" id="Status" name="Status" value="1" />Active</div>
                                    <div class="radio-div"><input type="radio" id="Status" name="Status" value="0" checked="checked" />Inactive</div>
                                <? } ?>    
                            </div>
                        </div>



                        <div class="control-group">
                            <div class="controls">                               
                                <button type="submit" class="btn btn-warning">Save</button> <button type="button" class="btn" onClick="window.location='new_user.php';">Clear</button>
                            </div>
                        </div>
                    </form>
                    <!--/form-->
                </div>
                <div class="span5"><img src="images/admin_icon.png" alt="tree"></div>

            </div>
            <div class="clearfix"></div>

            <hr>

        </div>

    </div>

    <?php include('footer.php'); ?>

    <!--/footer-->

  
    <script src="js/bootstrap.min.js"></script>                 
</body>
</html>