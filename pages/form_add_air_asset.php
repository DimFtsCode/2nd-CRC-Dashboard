<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role2 == "OPS+")) { 
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

        <title> Form Insert New Air Asset </title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Insert New Air Asset   </strong> </a>
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
                            <h1 class="page-header"> Εισαγωγή Νέας Εγγραφής Ετοιμότητας Α/Φ </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_air_asset" class="form-horizontal" action="../php_functions/air_asset_insert.php" method="POST">   
                            
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
                                <legend class="col-sm-2 control-label"> Air Asset Information  </legend>

                            </div>    

                            <div id="errorDiv">
                                <?php
                                //print $myError;
                                //print $_SESSION['MyError'][0];
                                //print $_SESSION['MyError'][1];
                                ?>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Base : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="base" name="base" required="base">
                                        <option value="" selected disabled> Air Base </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM `bases` ORDER BY `base_id` ";
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
                                <label class="col-sm-2 control-label">Squadron : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="squadron" name="squadron" required="squadron">
                                        <option value="" selected disabled> Squadron </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM `squadrons` ORDER BY `sq_id` ";
                                        $sq = $db->runQuery($sql);
                                        while ($row_sq = mysqli_fetch_array($sq)) {
                                            echo "<option value=\"" . $row_sq['sq_name'] . "\">" . $row_sq['sq_name']  . "</option>";
                                        }
                                        $db->Close();  // the necessity is to be checked
                                        ?>                                        
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Number of Fighters : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="numof" name="numof" required="numof" required="aftype">
                                      <?php
                                        for ($arx = 1; $arx < 10; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                                                                                                                                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Fighter's Type : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="aftype" name="aftype" required="aftype">
                                        <option value="" selected disabled> Fighter's Type </option>
                                        <option class="text-primary" value="F-16"> F-16 </option>
                                        <option class="text-primary" value="RAFALE"> RAFALE </option>
                                        <option class="text-primary" value="F-4"> F-4 </option>
                                        <option class="text-primary" value="M-2000"> M-2000 </option>
                                        <option class="text-primary" value="M-2000-5"> M-2000-5 </option>
                                        <option class="text-primary" value="MIG-29"> MIG-29 </option>
                                        <option class="text-primary" value="F-15"> F-15 </option>
                                        <option class="text-primary" value="AEW"> AEW </option>
                                    </select>                                          
                                </div>
                            </div>
                                                                                          
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Call Sign : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="callsign" name="callsign" class="form-control" placeholder="Call Sign" required="callsign">
                                    <span class="errorFeedback errorSpan" id="callsignError">Call Sign  should be only capital letters </span>
                                </div>
                            </div>         
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> IFF MODE#1 : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="iff1" name="iff1" class="form-control" placeholder="IFF MODE#1" required="iff1">
                                    <span class="errorFeedback errorSpan" id="iff1Error">IFF MODE#1 should be only digits </span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> IFF MODE#3 : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="iff3" name="iff3" class="form-control" placeholder="IFF MODE#3" required="iff3">
                                    <span class="errorFeedback errorSpan" id="iff3Error">IFF MODE#3 should be only digits </span>
                                </div>
                            </div>
                                 
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Readiness Status : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="status" name="status" required="status" >
                                        <option value="" selected disabled> Fighter's Status </option>
                                        <option class="text-primary" value="2'"> R/S 2' </option>  
                                        <option class="text-primary" value="5'"> R/S 5' </option>
                                        <option class="text-primary" value="10'"> R/S 10' </option>
                                        <option class="text-primary" value="15'"> R/S 15' </option>
                                        <option class="text-primary" value="30'"> R/S 30' </option>
                                        <option class="text-primary" value="60'"> R/S 60' </option>
                                        <option class="text-primary" value="120'"> R/S 120' </option>
                                        <option class="text-primary" value="4 hours"> R/S 4 Hours  </option>
                                        <option class="text-primary" value="AIRBORNE">AIRBORNE</option>
                                        <option class="text-primary" value="STBY"> ΑΛΛΑΓΗΣ </option>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> DAY or NIGHT : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="daynight" name="daynight" required="daynight">
                                        <option value="" selected disabled> DAY or NIGHT </option>
                                        <option class="text-primary" value="DAY"> DAY </option>  
                                        <option class="text-primary" value="NIGHT"> NIGHT </option> 
                                        <option class="text-primary" value="24H"> 24 Hours </option>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> NATIONAL / NATO / DELTA : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="scope" name="scope" required="scope">
                                        <option value="" selected disabled> NATIONAL/ NATO/ DELTA </option>
                                        <option class="text-primary" value="NATIONAL"> NATIONAL </option>  
                                        <option class="text-primary" value="NATO"> NATO </option> 
                                        <option class="text-primary" value="DELTA"> DELTA </option> 
                                    </select>                                          
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Track Number : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="track" name="track" class="form-control" placeholder="Track Number" required="track">
                                    <span class="errorFeedback errorSpan" id="trackError">Track Number Sign  should be only capital letters </span>
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
        <script type="text/javascript" src="../js/add_air_asset.js"></script>



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
