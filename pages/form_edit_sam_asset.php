<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role == "SAM" || $user->role2 == "SAM+" || $user->role3 == "SAM" )) { 
     die(header("Location: form_view_sam_asset.php"));
 }
 
?>
<!DOCTYPE html>
<html lang="en"> 

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Form Edit Sam Asset </title> 
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper"> 

            <!-- Navigation -->
            <!--  -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Edit  Sam Asset  </strong> </a>
                </div>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="./logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout </a>
                            </li>
                            <li class="sidebar-search">

                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            
                             <li>
                                </br>
                            </li>
                            
                            <li>
                                <a href="form_view_sam_asset.php"><i class="glyphicon glyphicon-fire"></i> Προβολή Ετοιμοτήτων Κ/Β </a>
                            </li>
                            <li>
<!--                                <a href="admin_dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Admin Dashboard</a>-->
                            </li>

                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- /# page wrapper -->   
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"> Επεξεργασία Ετοιμοτήτων Κ/Β</h1>                             
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_edit_sam_asset" class="form-horizontal" action="../php_functions/sam_asset_edit.php" method="POST">                            

                            <div class="form-group">
                                <legend class="col-sm-2 control-label"> SAM Asset Information  </legend>
                                 
                            </div> 
                            
                            <div>
<!--                                <button type="button" id="btn_delete" name ="btn_delete" style="background-color: yellow" style="font-size: larger"> Delete Record </button>-->
                                <span id="delete_btn" style="background-color: yellow"> You must select an SAM Asset prior to EDIT it ! </span>                                                            
                            </div>    

                            <div id="errorDiv">
                                <?php
                                if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) { 
                                    unset($_SESSION['formAttempt']);
                                    print "Errors encountered<br />\n";
                                    foreach ($_SESSION['error'] as $error) {
                                        print $error . "<br />\n";
                                    } //end foreach
                                } //end if
                                ?>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> SAM Asset ID : </label>
                                <div class="col-sm-4">
                                    
                                    <select class="form-control"  id="sam_id" name="sam_id" required="sam_id" readonly >
                                        <option value="" selected disabled> sam_id </option>
                                        <?php
                                        require_once ("../php_functions/db_config/db_connect.php");
                                        $db = new DbMgmt;                                        
                                        $sql = "SELECT * FROM `samstatus` ORDER BY weapon_pri ASC ";
                                        $sam_id = $db->runQuery($sql);
                                        while ($sam_row = mysqli_fetch_array($sam_id)) {
                                            echo "<option value=\"" . $sam_row['sam_id'] . "\">" . $sam_row['sam_id'] . " -- ".  $sam_row['weapon'] . " -- ". $sam_row['samunit'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>              
                            
                                                                               
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Location : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="location" name="location" class="form-control" placeholder="Location" required="location">
                                    <span class="errorFeedback errorSpan" id="locationError">Location  should be only capital letters </span>
                                </div>
                            </div>         
                                                                                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Status : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="status" name="status" required="status" >
                                        <option value="" selected disabled> SAM Status Select </option>
                                        <option class="text-primary" value="RS-1"> RS-1 </option>
                                        <option class="text-primary" value="RS-2"> RS-2 </option>
                                        <option class="text-primary" value="RS-3"> RS-3 </option>
                                        <option class="text-primary" value="RS-4"> RS-4 </option>
                                        <option class="text-primary" value="RS-4A"> RS-4A </option>
                                        <option class="text-primary" value="RS-5"> RS-5 </option>
                                        <option class="text-primary" value="RS-5A"> RS-5A </option>
                                        <option class="text-primary" value="RS-5B"> RS-5B </option>
                                        <option class="text-primary" value="RS-6"> RS-6 </option>
                                        <option class="text-primary" value="RS-7"> RS-7 </option>
                                        <option class="text-primary" value="RS-8"> RS-8 </option>
                                        <option class="text-primary" value="RS-9"> RS-9 </option>
                                        <option class="text-primary" value="RS-11"> RS-11 </option>
                                        <option class="text-primary" value="RS-12"> RS-12 </option>
                                        <option class="text-primary" value="RS-0"> RS-0 </option>
                                    </select>                                          
                                </div>
                            </div>
                                                                     
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Remarks : </label>
                                <div class="col-sm-4">
                                    <textarea  id="remark" name="remark" class="form-control" rows="2" placeholder="Remarks"></textarea>
                                </div>
                            </div>                                                                                                                            
                                                                                            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" class="btn btn-default" id="submit" name="submit"> Update SAM Asset</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        
                                        
        <!-- jQuery -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>
        
        <script type="text/javascript" src="../js/edit_sam_asset.js"></script> 

        <!-- Datepicker Theme -->
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/locales/bootstrap-datepicker.el.min.js"></script>

        <script type="text/javascript">
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                clearBtn: true,
                language: "el",
                orientation: "top right",
                calendarWeeks: true,
                autoclose: true,
                todayHighlight: true

            });
        </script>
    </body>

</html>
