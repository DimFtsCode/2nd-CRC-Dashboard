<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role == "OPS" || $user->role2 == "OPS+")) {
     die(header("Location: form_view_air_asset.php"));
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

        <title> Form Edit Air Static Data </title> 
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
        
         <!-- timepicker-wvega css -->
        <link href="../bower_components/jquery-timepicker-wvega/jquery.timepicker.css" rel="stylesheet">

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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Edit Air Static Data  </strong> </a>
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
                                <a href="form_view_air_asset.php"><i class="glyphicon glyphicon-fire"></i> Προβολή Ετοιμοτήτων Α/Φ </a>
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
                            <h1 class="page-header"> Επεξεργασία Επιπλέον Στοιχείων Ετοιμοτήτων </h1>                             
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_edit_air_static" class="form-horizontal" action="../php_functions/air_static_edit.php" method="POST">                            

                            <div class="form-group">
                                <legend class="col-sm-2 control-label">  Air Static Data  </legend>
                                 
                            </div> 
                            
                            <div>
<!--                                <button type="button" id="btn_delete" name ="btn_delete" style="background-color: yellow" style="font-size: larger"> Delete Record </button>-->
<!--                                <span id="delete_btn" style="background-color: yellow"> You must select an Air Asset prior to EDIT it ! </span>                                                            -->
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
                                <label class="col-sm-2 control-label"> ΕΘΝΙΚΗ RAMROD : </label>
                                <div class="col-sm-4">
                                    <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM airstatic WHERE static_id=1 ";
                                        $qry = $db->runQuery($sql);
                                         $row_res = mysqli_fetch_array($qry); 
                                            
                                            echo  "<input type=\"text\" id=\"gr_ramrod\" name=\"gr_ramrod\" class=\"form-control\"  required=\"gr_ramrod\" value=".  $row_res['gr_ramrod'] . ">";
                                            echo "<span class=\"errorFeedback errorSpan\" id=\"gr_ramrodError\">GR RAMROD  should be only capital letters </span>";
                                        $db->Close();  // the necessity is to be checked
                                        ?>                                          
<!--                                    <span class="errorFeedback errorSpan" id="gr_ramrodError">GR RAMROD  should be only capital letters </span>-->
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> NATO RAMROD : </label>
                                <div class="col-sm-4">
                                    <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM airstatic WHERE static_id=1 ";
                                        $qry = $db->runQuery($sql);
                                         $row_res = mysqli_fetch_array($qry); 
                                                                                        
                                            echo  "<input type=\"text\" id=\"nato_ramrod\" name=\"nato_ramrod\" class=\"form-control\"  required=\"nato_ramrod\" value=".  $row_res['nato_ramrod'] . ">";
                                      
                                        $db->Close();  // the necessity is to be checked
                                        ?>                                          
                                    <span class="errorFeedback errorSpan" id="nato_ramrodError">NATO RAMROD  should be only capital letters </span>
                                </div>
                            </div>         
                                                                                                                                                               
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Air Policing : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="air_policing" name="air_policing" required="air_policing">
                                        <option value="" selected disabled> Air Policing </option>
                                        <option class="text-primary" value="EAGLE EAST"> EAGLE EAST </option>
                                        <option class="text-primary" value="EAGLE WEST"> EAGLE WEST </option>                                        
                                    </select>                                          
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label class="col-sm-2 control-label"> ΠΡΩΤΟ ΦΩΣ : </label>
                                <div class="input-group date col-sm-2" >
                                    <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM airstatic WHERE static_id=1 ";
                                        $qry = $db->runQuery($sql);
                                         $row_res = mysqli_fetch_array($qry); 
                                                                                        
                                            echo  "<input type=\"text\" id=\"sunrise\" name=\"sunrise\" class=\"form-control time timepicker\"  required=\"sunrise\" value=".  $row_res['sunrise'] . ">";
                                      
                                        $db->Close();  // the necessity is to be checked
                                        echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-time\"></i></span>"
                                        ?>                                       
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> ΤΕΛΕΥΤΑΙΟ ΦΩΣ : </label>
                                <div class="input-group date col-sm-2" >
                                    <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM airstatic WHERE static_id=1 ";
                                        $qry = $db->runQuery($sql);
                                         $row_res = mysqli_fetch_array($qry); 
                                                                                        
                                            echo  "<input type=\"text\" id=\"sunset\" name=\"sunset\" class=\"form-control time timepicker\"  required=\"sunset\" value=".  $row_res['sunset'] . ">";
                                      
                                        $db->Close();  // the necessity is to be checked
                                        
                                         echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-time\"></i></span>"
                                        ?>                                       
                                </div>
                            </div>                                                        
                                                                                          
                             <div class="form-group">
                                <label class="col-sm-2 control-label"> ΕΘΝΙΚΑ ΣΧΟΛΙΑ : </label>
                                <div class="col-sm-4">
                                    <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM airstatic WHERE static_id=1 ";
                                        $qry = $db->runQuery($sql);
                                         $row_res = mysqli_fetch_array($qry); 
                                         $gr_remark =  $row_res['gr_remark'];
                                            
                                            //echo  "<input type=\"text\" id=\"gr_remark\" name=\"gr_remark\" class=\"form-control\"  required=\"gr_remark\" value=".  $row_res['gr_remark'] . ">";
                                            echo "<textarea id=\"gr_remark\" name=\"gr_remark\" class=\"form-control\" rows=\"2\" required=\"gr_remark\"  >$gr_remark</textarea>";
                                      
                                        $db->Close();  // the necessity is to be checked
                                        ?>                                          
                                    <span class="errorFeedback errorSpan" id="gr_remarkError">Remarks should be only capital letters </span>
                                </div>
                            </div>       
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> NATO COMMENTS : </label>
                                <div class="col-sm-4">
                                    <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM airstatic WHERE static_id=1 ";
                                        $qry = $db->runQuery($sql);
                                         $row_res = mysqli_fetch_array($qry); 
                                          $nato_remark =  $row_res['nato_remark'];   
                                            echo "<textarea id=\"nato_remark\" name=\"nato_remark\" class=\"form-control\" rows=\"2\" required=\"nato_remark\"  >$nato_remark</textarea>";
                                            //echo  "<textarea id=\"natoramrod\" name=\"natoramrod\" class=\"form-control\" rows=\"2\" required=\"natoramrod\">   $row_res['nato_remark']  </textarea>";
                                      
                                        $db->Close();  // the necessity is to be checked
                                        ?>                                          
                                    <span class="errorFeedback errorSpan" id="nato_remarkError">Remarks should be only capital letters </span>
                                </div>
                            </div>         
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> DELTA COMMENTS : </label>
                                <div class="col-sm-4">
                                    <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM airstatic WHERE static_id=1 ";
                                        $qry = $db->runQuery($sql);
                                         $row_res = mysqli_fetch_array($qry); 
                                          $delta_remark =  $row_res['delta_remark'];   
                                            echo "<textarea id=\"delta_remark\" name=\"delta_remark\" class=\"form-control\" rows=\"2\" required=\"delta_remark\"  >$delta_remark</textarea>";
                                            //echo  "<textarea id=\"natoramrod\" name=\"natoramrod\" class=\"form-control\" rows=\"2\" required=\"natoramrod\">   $row_res['nato_remark']  </textarea>";
                                      
                                        $db->Close();  // the necessity is to be checked
                                        ?>                                          
                                    <span class="errorFeedback errorSpan" id="delta_remarkError">Remarks should be only capital letters </span>
                                </div>
                            </div>        
                                                                                                                                                                                                                                                  
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" class="btn btn-default" id="submit" name="submit"> Update Air Static Data</button>
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
        
        <script type="text/javascript" src="../js/edit_air_static.js"></script> 

        <!-- Datepicker Theme -->
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/locales/bootstrap-datepicker.el.min.js"></script>
        
         <!-- Timepicker -->
        <script type="text/javascript" src="../bower_components/jquery-timepicker-wvega/jquery.timepicker.js"></script>

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
        
        <script type="text/javascript">            
            $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 1,
            defaultTime: '6',
            dynamic: false,
            dropdown: true,
            scrollbar: true
            });
        </script>
        
        
    </body>

</html>
