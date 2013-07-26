<?php
include("common.php");
include("session_active.php");
?>

<!doctype html>

<head>

    <?php default_js_css(); ?>

<!--<script>
$(document).ready(function(){  
 jQuery('.btn').removeClass('btn-primary');	 
 jQuery('#btn4').removeClass('btn-inverse');	
jQuery('#btn4').addClass('btn-primary');     
});
</script>-->
    <!--
    <script>
    $(document).ready(function(){
             
            $('.donor').click(function(){ 
                    if(confirm("Are you sure ?")) {
                            $.ajax({
                            'type' : 'POST',
                            'url' : "ajaxform.php?donnor="+this.value,
                            'success' : function(data) {
                                    window.location = "placebid.php";
                            }
                            })
                    }
                    
                    return false;
            });
    });
    </script>-->

    <script type="text/javascript">
        function del_user(id) {
            if(window.confirm('Are you sure you want to delete the user?'))
            {
                location.href='update_system_user.php?id='+id+'&act=delete';//save_contentpages.php?qs=delete_photo&id='+ id+'&is_ajax=1';
            }
        }
    </script>
</head>


<body>

    <div class="main-header">
        <?php include('header.php'); ?>
    </div>
    <div class="clearfix"></div>


    <div class="container">   
        <div class="subheads">System Users</div> 

        <div class="matter">
            <div class="fheading"><h1></h1></div>

            <div class="row-fluid">

                <!--                <div class="span8" style="width:676px">
                                    <div class="row-fluid">
                                        <form>
                                            <div class="input-append" style="margin-top:70px;">
                                                <form name="search" action="" method="get">
                                                    <input class="input-xxlarge" id="phone" name="phone" type="text" placeholder="Search Telephone Here..." value="<?php echo (isset($_GET['phone']) ? $_GET['phone'] : '') ?>">
                                                    <button class="btn btn-inverse" type="submit"><img src="images/find.png" alt="find"></button>
                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                </div>-->

                <div class="span4 left-border" style="width:200px">
                    <div class="row-fluid">
                        <div class="span6" style="margin-left:30px; width:145px">
                            <div class="text-center"><a href="update_system_user.php"> <h2>Add new User</h2>
                                    <img src="images/add-user.png" alt="add" width="80" height="200"></a>   </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
            <hr>
            <div class="row-fluid">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include('lib/pager.class.php');
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        } else {
                            $page = 1;
                        }

                        $q = "select * from admin";
                        $o__pager = new pager('admin', $page, NUM_PAGE, array(), $q);
                        $client = $o__pager->getQuery();
                        while ($arrsystemuser = mysql_fetch_assoc($client)):
                            ?> 
                            <tr>
                                <td><?php echo $arrsystemuser['id']; ?></td>
                                <td><?php echo $arrsystemuser['username']; ?></td>
                                <td><?php echo $arrsystemuser['password']; ?></td>
                                <td><?php echo $arrsystemuser['status']; ?></td>
                                <td>
                                    <a href="update_system_user.php?id=<?php echo $arrsystemuser['id']; ?>" ><img src="images/edit.png" ></a>
                                    <a onclick="del_user('<?=$arrsystemuser['id']; ?>')" style="cursor: pointer;"><img src="images/delete-icon.png" ></a>
                                </td>	

                            </tr>
                        <?php endwhile; ?>	

                    </tbody>
                </table>

                <div class="pagination pagination-right">
                    <ul>
                        <?php echo $o__pager->getPagerString('placebid.php' . $qurey_string); ?>
                    </ul>
                </div>

            </div>

            <!--section3-->
            <hr>

            <div class="clearfix"></div>

        </div>

        <!--section4-->

    </div>



</div>


<?php include('footer.php'); ?>

<!--/footer-->


<script src="js/bootstrap.min.js"></script>                 
</body>
</html>