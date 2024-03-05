<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role == "SAM" || $user->role3 == "SAM")) { 
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

        <title> Form Edit SAM Static Data </title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Edit SAM Static Data  </strong> </a>
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
                                <a href="form_view_sam_asset.php"><i class="glyphicon glyphicon-fire"></i> Προβολή Ετοιμοτήτων SAM / SHORAD </a>
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
                            <h1 class="page-header"> Επεξεργασία Ετοιμοτήτων Α/Α ΟΠΛΩΝ - STINGER - ΟΣΑ-ΑΚ  </h1>                             
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_edit_sam_static" class="form-horizontal" action="../php_functions/sam_static_edit.php" method="POST">                            

                            <div class="form-group">
                                <legend class="col-sm-2 control-label">  Ετοιμοτήτες Α/Α ΟΠΛΩΝ - STINGER - ΟΣΑ-ΑΚ  </legend>
                                 
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
                                <label class="col-sm-2 control-label"> SAM Asset ID : </label>
                                <div class="col-sm-4">
                                    
                                    <select class="form-control"  id="static_id" name="static_id" required="static_id" readonly >
                                        <option value="" selected disabled> static_id </option>
                                        <?php
                                        require_once ("../php_functions/db_config/db_connect.php");
                                        $db = new DbMgmt;                                        
                                        $sql = "SELECT * FROM `samstatic` ORDER BY static_id ASC ";
                                        $sam_id = $db->runQuery($sql);
                                        while ($sam_row = mysqli_fetch_array($sam_id)) {
                                            echo "<option value=\"" . $sam_row['static_id'] . "\">" . $sam_row['static_id'] . " -- ".  $sam_row['system'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>            
    
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> RS1 : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="rs1" name="rs1" required="rs1" >
                                      <option class="text-primary" value=" "> NULL </option> 
                                      <?php
                                        $percent = " %";                                        
                                        for ($arx = 0; $arx < 101; $arx++) {
                                            echo "<option value=\"" . $arx . $percent . "\">" . $arx . $percent . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>                                                        
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> RS4 : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="rs4" name="rs4" required="rs4" >
                                      <option class="text-primary" value=" "> NULL </option>  
                                      <?php                                        
                                        for ($arx = 0; $arx < 101; $arx++) {
                                            echo "<option value=\"" . $arx . $percent . "\">" . $arx . $percent . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> RS4A : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="rs4a" name="rs4a" required="rs4a" >
                                      <option class="text-primary" value=" "> NULL </option>  
                                      <?php                                        
                                        for ($arx = 0; $arx < 101; $arx++) {
                                            echo "<option value=\"" . $arx . $percent . "\">" . $arx . $percent . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> RS5 : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="rs5" name="rs5" required="rs5" >
                                      <option class="text-primary" value=" "> NULL </option>  
                                      <?php                                        
                                        for ($arx = 0; $arx < 101; $arx++) {
                                           echo "<option value=\"" . $arx . $percent . "\">" . $arx . $percent . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> RS5A : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="rs5a" name="rs5a" required="rs5a" >
                                      <option class="text-primary" value=" "> NULL </option>
                                      <?php
                                        for ($arx = 0; $arx < 101; $arx++) {
                                            echo "<option value=\"" . $arx . $percent . "\">" . $arx . $percent . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> RS5B : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="rs5b" name="rs5b" required="rs5b" >
                                      <option class="text-primary" value=" "> NULL </option>  
                                      <?php
                                        for ($arx = 0; $arx < 101; $arx++) {
                                            echo "<option value=\"" . $arx . $percent . "\">" . $arx . $percent . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> RS6 : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="rs6" name="rs6" required="rs6" >
                                      <option class="text-primary" value=" "> NULL </option>  
                                      <?php
                                        for ($arx = 0; $arx < 101; $arx++) {
                                            echo "<option value=\"" . $arx . $percent . "\">" . $arx . $percent . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> RS11 : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="rs11" name="rs11" required="rs11" >
                                      <option class="text-primary" value=" "> NULL </option>  
                                      <?php
                                        for ($arx = 0; $arx < 101; $arx++) {
                                            echo "<option value=\"" . $arx . $percent . "\">" . $arx . $percent . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> RS12 : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="rs12" name="rs12" required="rs12" >
                                      <option class="text-primary" value=" "> NULL </option>
                                      <?php
                                        for ($arx = 0; $arx < 101; $arx++) {
                                            echo "<option value=\"" . $arx . $percent . "\">" . $arx . $percent . "</option>\n";
                                        }
                                        ?>
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
                                    <button type="submit" class="btn btn-default" id="submit" name="submit"> Update SAM Static Readiness </button>
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
        
        <script type="text/javascript" src="../js/edit_sam_static.js"></script> 

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
