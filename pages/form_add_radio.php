<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role2 == "ROIP+")) { 
     die(header("Location: dashboard.php"));
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

        <title> Form Insert New Radio </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Insert New Radio   </strong> </a>
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
                                <a href="admin_dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Admin Dashboard</a>
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
                            <h1 class="page-header"> Εισαγωγή Νέου Ασυρμάτου (Radio) </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_radio" class="form-horizontal" action="../php_functions/radio_insert.php" method="POST">   
                            
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
                                <legend class="col-sm-2 control-label"> Radio Information  </legend>

                            </div>    

                            <div id="errorDiv">
                                <?php
                                //print $myError;
                                //print $_SESSION['MyError'][0];
                                //print $_SESSION['MyError'][1];
                                ?>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Radio Name : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="radio_name" name="radio_name" class="form-control" placeholder="radio_name" required="radio_name">
                                    <span class="errorFeedback errorSpan" id="radio_nameError">Radio Name  should be only capital letters </span>
                                </div>
                            </div>                                                        

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Radio type : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="radio_type" name="radio_type" required="radio_type" required="radio_type">
                                        <option value="" selected disabled> Radio type </option>
                                        <option class="text-primary" value="RS"> R/S </option>  
                                        <option class="text-primary" value="MXF"> MXF </option>
                                        <option class="text-primary" value="URC"> URC </option>
                                        <option class="text-primary" value="JOTRON"> JOTRON </option>
                                        <option class="text-primary" value="HARRIS"> HARRIS </option>
                                        <option class="text-primary" value="other"> Other </option>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΘΕΣΗ : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="location" name="location" required="location">
                                        <option value="" selected disabled> location </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM `units` ORDER BY `unit_id` ";
                                        $loc = $db->runQuery($sql);
                                        while ($row_loc = mysqli_fetch_array($loc)) {
                                            echo "<option value=\"" . $row_loc['unit_name'] . "\">" . $row_loc['unit_name'] . " -- " . $row_loc['unit_loc'] . "</option>";
                                        }
                                        $db->Close();  // the necessity is to be checked
                                        ?>                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> BAND : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="band" name="band" required="band">
                                        <option value="" selected disabled> Radio Band </option>
                                        <option class="text-primary" value="UHF"> UHF </option>  
                                        <option class="text-primary" value="VHF"> VHF </option>  
                                        <option class="text-primary" value="V/UHF"> VHF / UHF </option>
                                        <option class="text-primary" value="HF"> HF </option>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> GUARD Receiver : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="guard" name="guard" required="guard">
                                        <option value="" selected disabled> Guard Receiver </option>
                                        <option class="text-primary" value="No"> No </option>
                                        <option class="text-primary" value="Yes UHF"> Yes UHF </option>  
                                        <option class="text-primary" value="Yes VHF"> Yes VHF </option>  
                                        <option class="text-primary" value="Yes V/UHF"> Yes VHF / UHF </option>                                        
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> MPA Capable : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="mpa" name="mpa" required="mpa">
                                        <option value="" selected disabled> MPA Capable </option>
                                        <option class="text-primary" value="No"> No </option>
                                        <option class="text-primary" value="Yes"> Yes </option>                                                                            
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> CONTROL Unit : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="control" name="control" required="control">
                                        <option value="" selected disabled> Control Unit </option>
                                        <option class="text-primary" value="1ΑΚΕ"> 1ΑΚΕ </option>
                                        <option class="text-primary" value="1ΑΚΕ-SP"> 1ΑΚΕ-SP </option>
                                        <option class="text-primary" value="2ΑΚΕ"> 2ΑΚΕ </option>
                                        <option class="text-primary" value="2ΑΚΕ-SP"> 2ΑΚΕ-SP </option>
                                        <option class="text-primary" value="ΕΚΑΕ"> ΕΚΑΕ </option>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> STATUS : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="status" name="status" required="status">
                                        <option value="" selected disabled> Radio Status </option>
                                        <option class="text-primary" value="ΕΝ/ΕΝ"> ΕΝ/ΕΝ </option>  
                                        <option class="text-primary" value="ΕΚ/ΕΝ"> ΕΚ/ΕΝ </option>  
                                        <option class="text-primary" value="ΕΚ/ΛΕΙΤ"> ΕΚ/ΛΕΙΤ </option>                                        
                                    </select>                                          
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Reason : </label>
                                <div class="col-sm-4">
                                    <textarea  id="reason" name="reason" class="form-control" rows="2" placeholder="Reason"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Actions : </label>
                                <div class="col-sm-4">
                                    <textarea  id="action" name="action" class="form-control" rows="1" placeholder="action"></textarea>
                                </div>
                            </div>                           

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΗΜΕΡΟΜΗΝΙΑ : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="tbc" name="tbc" class="form-control date datepicker" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
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
        <script type="text/javascript" src="../js/insert_radio.js"></script>



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
