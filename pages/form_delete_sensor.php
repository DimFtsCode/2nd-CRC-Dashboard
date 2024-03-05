<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role2 == "ADP+")) { 
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

        <title> Form Delete Sensor </title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Delete Sensor   </strong> </a>
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
                            <h1 class="page-header"> Διαγραφή sensor RADAR  </h1>                             
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_edit_sensor" class="form-horizontal" action="../php_functions/sensor_delete.php" method="POST">                            

                            <div class="form-group">
                                <legend class="col-sm-2 control-label"> Sensor Information  </legend>
                                 
                            </div> 
                            
                             <div>
<!--                                <button type="button" id="btn_delete" name ="btn_delete" style="background-color: yellow" style="font-size: larger"> Delete Record </button>-->
                                <span id="delete_btn" style="background-color: red"> You must select a Sensor prior to DELETE it ! </span>                                                         
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
                                <label class="col-sm-2 control-label"> Sensor ID : </label>
                                <div class="col-sm-4">
                                    
                                    <select class="form-control"  id="sensor_id" name="sensor_id" required="sensor_id" readonly >
                                        <option value="" selected disabled> sensor_id </option>
                                        <?php
                                        require_once ("../php_functions/db_config/db_connect.php");
                                        $db = new DbMgmt;
                                        //$sql = "SELECT `sensor_id` FROM `sensor` ";
                                        $sql = "SELECT * FROM `sensor` ";
                                        $sensor_id = $db->runQuery($sql);
                                        while ($row_sensor = mysqli_fetch_array($sensor_id)) {
                                            echo "<option value=\"" . $row_sensor['sensor_id'] . "\">" . $row_sensor['sensor_id'] . " -- ". $row_sensor['sensor_name'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>                                                        

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Sensor Name : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="sensor_name" name="sensor_name" class="form-control" placeholder="sensor_name" required="sensor_name" readonly>
                                    <span class="errorFeedback errorSpan" id="sensor_nameError">Sensor Name  should be only Capital LETTERS, numbers and chars -, /  </span>
                                </div>
                            </div>   
                            
<!--                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Sensor type : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="sensor_type" name="sensor_type" required="sensor_type" required="sensor_type" readonly>
                                        <option value="" selected disabled> Sensor type </option>
                                        <option class="text-primary" value="SR"> SR </option>  
                                        <option class="text-primary" value="SSR"> SSR </option>  
                                    </select>                                          
                                </div>
                            </div>                                                                                                                                                                  -->

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" class="btn btn-default" id="submit" name="submit" style="font-size: x-large" > Delete Sensor </button>
                                     <span id="delete_btn" style="background-color: red"> Are you sure ?? DELETE the Sensor ?? </span>
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
        
        <script type="text/javascript" src="../js/delete_sensor.js"></script> 

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
