<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php")); 
}

if (!($user->role == "SYS" || $user->role == "OPS" || $user->role2 == "OPS+")) { 
     die(header("Location: form_view_sart.php"));
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

        <title> Form Edit SART </title>  
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Edit SART   </strong> </a>
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
                                <a href="form_view_sart.php"><i class="glyphicon glyphicon-fire"></i> Προβολή Κατάστασης Α/Δ </a>
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
                            <h1 class="page-header"> Επεξεργασία Εγγραφής Κατάστασης Α/Δ </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_edit_sart" class="form-horizontal" action="../php_functions/sart_edit.php" method="POST">   
                            
                            <div id="errorDiv">
                                <?php
                                if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
                                    unset($_SESSION['formAttempt']);
                                    print "Errors encountered<br />\n";
                                    foreach ($_SESSION['error'] as $error) {
                                        print $error . "<br />\n";
                                    } //end foreach
                                } else{
                                    //print " check for errors ";
                                }
                                ?>
                            </div>
                            

                            <div class="form-group">
                                <legend class="col-sm-2 control-label"> SART Information  </legend>

                            </div>    

                            <div id="errorDiv">
                                <?php
                                //print $myError;
                                //print $_SESSION['MyError'][0];
                                //print $_SESSION['MyError'][1];
                                ?>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> SART ID : </label>
                                <div class="col-sm-4">
                                    
                                    <select class="form-control"  id="sart_id" name="sart_id" required="sart_id" readonly >
                                        <option value="" selected disabled> sart_id </option>
                                        <?php
                                        require_once ("../php_functions/db_config/db_connect.php");
                                        $db = new DbMgmt;                                        
                                        $sql = "SELECT * FROM `sart` ";
                                        $sart_id = $db->runQuery($sql);
                                        while ($row_air = mysqli_fetch_array($sart_id)) {
                                            echo "<option value=\"" . $row_air['sart_id'] . "\">" . $row_air['sart_id'] . " -- ". $row_air['base'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>                                                        
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Base : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="base" name="base" required="base">
                                        <option value="" selected disabled> Base </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM `bases` ORDER BY `base_pri` ";
                                        $base = $db->runQuery($sql);
                                        while ($row_base = mysqli_fetch_array($base)) {
                                            echo "<option value=\"" . $row_base['base_name'] . "\">" . $row_base['base_name']  . "</option>";
                                        }
                                        $db->Close();  // the necessity is to be checked
                                        ?>                                        
                                    </select>
                                </div>
                            </div>
                                                                                    
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Weather : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="weather" name="weather" required="weather" >
                                        <option value="" selected disabled> Weather </option>                                         
                                        <option class="text-primary" value="BLUE"> BLUE </option>                                       
                                        <option class="text-primary" value="WHITE"> WHITE </option>
                                        <option class="text-primary" value="GREEN"> GREEN </option>
                                        <option class="text-primary" value="YELLOW"> YELLOW </option>
                                        <option class="text-primary" value="AMBER"> AMBER </option>
                                        <option class="text-primary" value="RED"> RED </option>
                                        <option class="text-primary" value="BLACK"> BLACK </option>
                                    </select>                                          
                                </div>
                            </div>
                                                                                                                                            
                             <div class="form-group">
                                <label class="col-sm-2 control-label"> Status : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="status" name="status" required="status" >
                                        <option value="" selected disabled> Status </option>                                         
                                        <option class="text-primary" value="NORMAL"> NORMAL </option>                                       
                                        <option class="text-primary" value="RESTRICTED"> RESTRICTED </option>
                                        <option class="text-primary" value="MANDATORY"> MANDATORY </option>
                                        <option class="text-primary" value="PROHIBITED"> PROHIBITED </option>                                        
                                    </select>                                          
                                </div>
                            </div>                                                                                                                                                                                   
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Rumway : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="runway" name="runway" class="form-control" placeholder="runway" required="runway">
                                    <span class="errorFeedback errorSpan" id="runwayError">runway should be only digits </span>
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
                                    <button type="submit" class="btn btn-default" id="submit" name="submit">Submit</button>
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

        <!-- Datepicker Theme -->
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/locales/bootstrap-datepicker.el.min.js"></script>
        <script type="text/javascript" src="../js/edit_sart.js"></script>



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
