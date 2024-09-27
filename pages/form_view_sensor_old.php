<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
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
        
        <?php
        // The following is used to force the browser to clear cashe every time the page is loaded  
        echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/style_view_sensor.css?v=" .rand() . "\">" );        
        ?>

        <title> Form Edit Sensor </title> 
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        
        
        <link rel="stylesheet" type="text/css"  href="../styles/form_view_sensor.css">

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

            <div id="header">
                <h1> 2o AKE / Μοίρα Επιχειρήσεων </h1>
            </div> <!-- end header -->
            <div id="menu">
                <ul>
                    <a href="./logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout </a>
                    <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>                    
                                        
                </ul>
            </div> <!-- end menu -->   
            
            
            <!-- Navigation -->
            <!--  -->
<!--            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> View / Edit Sensor Status  </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; "> DashBoard </strong> </a>
                     <a class="navbar-brand" href="logout.php"> <strong style="color: #720e9e; "> Log Out </strong> </a>
                </div>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="./logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout </a>
                            </li>
                            <li class="sidebar-search">

                                 /input-group 
                            </li>
                            <li>
                                <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>

                        </ul>
                    </div>
                     /.sidebar-collapse 
                </div>
                 /.navbar-static-side 
            </nav>-->

            <!-- /# page wrapper -->   
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"> Προβολή RADAR Status </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center">
                                        <strong> Προβολή RADAR Status - <?php echo date("j - m - Y"); ?></strong>
                                    </div>
<!--                                    <div class="panel-heading text-center">
                                        <strong> Debug  - <?php // echo $_SESSION['MyError'][0];  echo $_SESSION['MyError'][1]; echo $_SESSION['MyError'][2];echo $_SESSION['MyError'][3];?></strong>
                                    </div>-->
                                    <div class="panel-body">
                                        <div class="dataTables_wrapper">
                                            <?php
                                            //require_once '../php_functions/Cvutils/utils.php';
                                            require_once '../php_functions/db_config/db_connect.php';
                                            $class = "table";
                                            $headArray = array("ID", "SENSOR NAME", "TYPE", "STATUS", "REASON", "ACTIONS", "End DATE", "USER reg", "DATE reg",);
                                            $head = count($headArray);
                                            $sql = "SELECT `sensor_id`, `sensor_name`, `sensor_type`, `status`, `reason`, `action`, `tbc`, `user_reg`, `date_reg` FROM `sensor` ORDER BY `sensor`.`sensor_id` ASC";
                                            $db = new DbMgmt;                                             
                                            $res = $db->runQuery($sql);
                                            echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_radar\">";
                                            echo "<caption class=\"text-center \"> Προβολή RADAR Status </caption>";
                                            echo "<thead>";
                                            echo "<tr class=\"table_head\">";
                                            for ($i = 0; $i < $head; $i++) {
                                                echo "<th>" . $headArray[$i] . "</th>";
                                            }
                                            echo "</tr>";
                                            echo "</thead>";

                                            echo "<tbody>";
                                            while ($row_radar = mysqli_fetch_array($res)) {
                                                $loop_var = 0;
                                                echo "<tr>";
                                                //echo "<td class=\"sensor_id\"> <a href=\"./rafale.html\">" . $row_radar['sensor_id'] . " </a> </td>"; 
                                                //echo "<button type=\"button\" class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$subject_id_parse[$loop_var]" . " \">Update</button>";
                                                $sensor_id_parse[$loop_var] = $row_radar['sensor_id'];
                                                
                                                if ($user->admin == 0 || $user->admin == NULL) {
                                                    echo "<td class=\"sensor_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_radar['sensor_id'] . "  </a> </td>";
                                                } elseif ($user->admin == 1) {
                                                    echo "<td class=\"sensor_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$sensor_id_parse[$loop_var]" . " \" >" . $row_radar['sensor_id'] . "  </a> </td>";
                                                }
                                                //echo "<td class=\"sensor_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_radar['sensor_id'] . "  </a> </td>";
                                                //echo "<td class=\"sensor_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$sensor_id_parse[$loop_var]" . " \" >" . $row_radar['sensor_id'] . "  </a> </td>";                                                 
                                                echo "<td class=\"sensor_name\">" . $row_radar['sensor_name'] . "</td>";
                                                echo "<td class=\"sensor_type\"> " . $row_radar['sensor_type'] . "</td>";
                                                echo "<td class=\"status\">" . $row_radar['status'] . "</td>";
                                                echo "<td>" . $row_radar['reason'] . "</td>";
                                                echo "<td>" . $row_radar['action'] . " </strong> </td>";
                                                echo "<td>" . $row_radar['tbc'] . "</td>";
                                                echo "<td>" . $row_radar['user_reg'] . "</td>";
                                                echo "<td>" . $row_radar['date_reg'] . "</td>";                                                
                                                echo "</tr>";
                                                $loop_var = $loop_var + 1;
                                            }

                                            echo "</tbody>";

                                            echo "</table>";
                                            
                                            //table($class, $headArray, $res);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid --> 
            </div>

        </div>
        <!-- /#wrapper -->
        
        
        <!-- Modal Start Update Sensor  NEW !! -->
        <?php
        //require_once '../php_functions/db_config/db_connect.php';
        $sql_update_sensor = "SELECT `sensor_id`, `sensor_name`, `sensor_type`, `status`, `reason`, `action`, `tbc`, `user_reg`, `date_reg` FROM `sensor` ORDER BY `sensor`.`sensor_id` ASC";
        $db1 = new DbMgmt;
        $qry_update_sensor = $db1->runQuery($sql_update_sensor);
        while ($row_update_sensor = mysqli_fetch_array($qry_update_sensor)) {
            $loop_var = 0;
            $sensor_id_parse[$loop_var] = $row_update_sensor['sensor_id'];

            //Update Modal
            echo "<div class=\"modal fade\" id=\"update" . $sensor_id_parse[$loop_var] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";
            echo "<div class=\"modal-dialog\">\n";
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> Update Sensor </h3>\n";
            //modal header
            echo "</div>\n";
            $sensor_id_update = $row_update_sensor['sensor_id'];
            $sensor_name_update = $row_update_sensor['sensor_name'];
            $sensor_type_update = $row_update_sensor['sensor_type'];
            $status_update = $row_update_sensor['status'];
            $reason_update = $row_update_sensor['reason'];
            $action_update = $row_update_sensor['action'];
            $date_update = $row_update_sensor['tbc'];
            
            
            //echo "Sensor ID : " . $sensor_id_update;
            $_SESSION['MyError'][1] = $sensor_id_update;
            $_SESSION['MyError'][3] ="NO-USER";
            //echo "<input class=\"hidden\" id=\"sensor_id\" name=\"sensor_id\" value=\"" . $sensor_id_update . "\">\n";
            
                                                                                                                              
            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"updateSensorForm\" name=\"updateSensorForm\" action=\"../php_functions/sensor_update.php\" method=\"POST\">\n";
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\">Update Sensor Status : " . $sensor_name_update . " / " . $sensor_type_update . "</label>\n";
            echo "</div>\n";
            
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Sensor ID </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"sensor\" name=\"sensor\" class=\"form-control input-group-lg\" value=\"" . $sensor_id_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";

            /*
             * Select
             */
            echo "<div class=\"form-group form-group-sm\">\n";
            echo "<div class=\"col-sm-2\">\n";
            echo "<label class=\"col-sm-2 control-label\">Status</label>\n";
            echo "</div>\n";
            echo "<div class=\"col-sm-4\">\n";
            echo "<select class=\"col-sm-8 form-control\" id=\"status\" required=\"status\" name=\"status\">\n";
            echo "<option value=\"\" selected disabled> Sensor Status </option>";
            echo "<option class=\"text-primary\" value=\"ΕΝ/ΕΝ\"> ΕΝ/ΕΝ </option>";
            echo "<option class=\"text-primary\" value=\"ΕΚ/ΕΝ\"> ΕΚ/ΕΝ </option>"; 
            echo "<option class=\"text-primary\" value=\"ΕΚ/ΛΕΙΤ\"> ΕΚ/ΛΕΙΤ </option>";
            echo "<option class=\"text-primary\" value=\"LIMITED\"> LIMITED </option>";
            echo "<option selected=\"selected\" value=\" ". $status_update ."\"> $status_update </option>";
            echo "</select>\n";
            echo "</div>\n";
            echo "</div>\n";
            /*
             * End here
             */
            //Select ends here:



            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">Αιτία </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"reason\" name=\"reason\" class=\"form-control input-group-lg\" placeholder=\"Αιτία - Λόγος\" value=\"" . $reason_update . "\">";
            echo "</div>\n";
            echo "</div>\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">Ενέργειες </label>\n";
            echo "<div class=\"col-sm-10\">";            
            echo "<textarea id=\"action\" name=\"action\" class=\"form-control\" rows=\"2\" placeholder=\"Ενέργειες\">$action_update</textarea>";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">End Date</label> ";
            echo "<div  class=\"input-group date col-sm-4\" > ";
            echo "<input type=\"text\" id=\"end_date\"  name=\"end_date\" class=\"form-control date datepicker\" value=\" " .$date_update ."\"> ";
            echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-calendar\"></i></span> ";
            echo "</div>\n";
            echo "</div>\n";

            echo "</div>";
            //Modal Body
            echo "</div>";
            echo "<div class=\"modal-footer\">";
            echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
            echo "<button type=\"submit\" id=\"update\" class=\"btn btn-primary\">Update</button>";
            echo "</form>";                                                

            //Modal Footer
            echo "</div>";

            // modal content
            echo "</div>";

            // modal dialog
            echo "</div>";

            //modal end
            echo "</div>";
            //$loop_var = $loop_var + 1;
        }
        ?>
        
        
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
        
        <!--  <script type="text/javascript" src="../js/insert_personnel.js"></script>  -->
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
        
        <!-- Change the background color of certain fields -->
        <script src="../js/form_view_sensor.js"></script>
        
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
        
       <script>
            $(document).ready(function () {
                $("#view_radar").DataTable({
                    responsive: true,
                    "pageLength": 50 
                });
            }); 
        </script> 
                        
        
        
    </body>

</html>
