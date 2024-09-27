<?php
require_once("../php_functions/functions.inc");
$user = new User;
//if (!$user->isLoggedIn) {
//    die(header("Location: login.php"));
//}
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
        echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_radio2.css?v=" .rand() . "\">" );        
        ?>

        <title> Form View / Edit Radios </title>  
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        
        
        <link rel="stylesheet" type="text/css"  href="../styles/form_view_radio.css">

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
        <div id="container">
            <div id="header" style="background-color: #f2aa25">
                <h1> 2o AKE / Μοίρα Επιχειρήσεων -- Προβολή Status Ασυρμάτων Βορείου Τομέα</h1>
            </div> <!-- end header -->
            <div id="menu">
                <ul>
<!--                    <li><a href="./logout.php"> Logout </a></li>
                    <li><a href="dashboard.php"> Dashboard</a> </li>-->
                    <li><a href="./Unit_Status0.php"> Unit Status</a> </li>

                </ul>
            </div> <!-- end menu -->          

            <div id="mainContainer">


                <div id="content">
                    <div class="container-fluid">
                        <div class="row">
<!--                            <div class="col-lg-12">
                                <h1 class="page-header"> Προβολή RADAR Status </h1>
                            </div>-->
                            <!-- /.col-lg-12 -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">
                                            <strong> Προβολή Status Ασυρμάτων - <?php echo date("j - m - Y"); ?></strong>
                                        </div>
                                        <!--                                    <div class="panel-heading text-center">
                                                                                <strong> Debug  - <?php // echo $_SESSION['MyError'][0];  echo $_SESSION['MyError'][1]; echo $_SESSION['MyError'][2];echo $_SESSION['MyError'][3]; ?></strong>
                                                                            </div>-->
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper"> 
                                                <?php
                                                
                                                require_once '../php_functions/db_config/db_connect.php';
                                                $class = "table";
                                                $headArray = array("SN", "ID", "NAME", "TYPE", "LOC", "BAND", "GUARD", "MPA", "CTRL", "STATUS", "REASON / REMARKS", "ACTIONS", "DATE", "by_USER", "DATE_REG",);
                                                $head = count($headArray);
                                                $myControl = "1ΑΚΕ";
                                                //$sql = "SELECT `sensor_id`, `sensor_name`, `sensor_type`, `status`, `reason`, `action`, `tbc`, `user_reg`, `date_reg` FROM `sensor` ORDER BY `sensor`.`sensor_id` ASC";
                                                $sql = "SELECT * FROM radio WHERE radio.control ='{$myControl}' ORDER BY radio.radio_id ASC"; 
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $serial = 1;
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_radio\">";
                                                echo "<caption class=\"text-center \"> Προβολή Status Ασυρμάτων </caption>";
                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head; $i++) {
                                                    echo "<th>" . $headArray[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";

                                                echo "<tbody>";
                                                while ($row_radio = mysqli_fetch_array($res)) {
                                                    $loop_var = 0;
                                                    echo "<tr>";
                                                    //echo "<td class=\"sensor_id\"> <a href=\"./rafale.html\">" . $row_radar['sensor_id'] . " </a> </td>"; 
                                                    //echo "<button type=\"button\" class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$subject_id_parse[$loop_var]" . " \">Update</button>";
                                                    $radio_id_parse[$loop_var] = $row_radio['radio_id'];
                                                    
                                                    echo "<td class=\"serial\">" . $serial . "</td>";    
                                                    //if ($user->role == "SYS" || $user->role == "COM" ) {
                                                    //    echo "<td class=\"sensor_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$radio_id_parse[$loop_var]" . " \" >" . $row_radio['radio_id'] . "  </a> </td>";
                                                    //} else {                                                        
                                                        echo "<td class=\"sensor_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_radio['radio_id'] . "  </a> </td>";
                                                    //}
                                                    //echo "<td class=\"sensor_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_radar['sensor_id'] . "  </a> </td>";
                                                    //echo "<td class=\"sensor_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$sensor_id_parse[$loop_var]" . " \" >" . $row_radar['sensor_id'] . "  </a> </td>";                                                                                                     
                                                    echo "<td class=\"radio_name\">" . $row_radio['radio_name'] . "</td>";
                                                    echo "<td class=\"radio_type\"> " . $row_radio['radio_type'] . "</td>";
                                                    echo "<td class=\"location\"> " . $row_radio['location'] . "</td>";
                                                    echo "<td class=\"band\"> " . $row_radio['band'] . "</td>";
                                                    echo "<td class=\"guard\"> " . $row_radio['guard'] . "</td>";
                                                    echo "<td class=\"mpa\"> " . $row_radio['mpa'] . "</td>";
                                                    echo "<td class=\"control\"> " . $row_radio['control'] . "</td>";                                                    
                                                    
                                                    echo "<td class=\"status\">" . $row_radio['status'] . "</td>";
                                                    echo "<td class=\"reason\">" . $row_radio['reason'] . "</td>";
                                                    echo "<td class=\"action\">" . $row_radio['action'] . " </strong> </td>";
                                                    echo "<td class=\"tbc\">" . $row_radio['tbc'] . "</td>";
                                                    echo "<td class=\"user_reg\">" . $row_radio['user_reg'] . "</td>";
                                                    echo "<td class=\"date_reg\">" . $row_radio['date_reg'] . "</td>";
                                                    echo "</tr>";
                                                    $loop_var = $loop_var + 1;
                                                    $serial = $serial + 1 ;
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

            </div> <!-- end content -->



        </div> <!-- end mainContainer -->
    </div> <!-- end container -->

            
        <!-- Modal Start Update Sensor  NEW !! -->
        <?php
        //require_once '../php_functions/db_config/db_connect.php';
        //$sql_update_sensor = "SELECT `sensor_id`, `sensor_name`, `sensor_type`, `status`, `reason`, `action`, `tbc`, `user_reg`, `date_reg` FROM `sensor` ORDER BY `sensor`.`sensor_id` ASC";
        $sql_update_radio = "SELECT * FROM `radio` ORDER BY `radio`.`radio_id` ASC";
        $db1 = new DbMgmt;
        $qry_update_radio = $db1->runQuery($sql_update_radio);
        while ($row_update_radio = mysqli_fetch_array($qry_update_radio)) {
            $loop_var = 0;
            $radio_id_parse[$loop_var] = $row_update_radio['radio_id'];

            //Update Modal
            echo "<div class=\"modal fade\" id=\"update" . $radio_id_parse[$loop_var] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";
            echo "<div class=\"modal-dialog\">\n";
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> Update Radio </h3>\n";
            //modal header
            echo "</div>\n";
            $radio_id_update = $row_update_radio['radio_id'];
            $radio_name_update = $row_update_radio['radio_name'];
            $radio_type_update = $row_update_radio['radio_type'];
            
            $location_update = $row_update_radio['location'];
            $band_update = $row_update_radio['band'];
            $guard_update = $row_update_radio['guard'];
            $mpa_update = $row_update_radio['mpa'];
            $control_update = $row_update_radio['control'];
                                                
            $status_update = $row_update_radio['status'];
            $reason_update = $row_update_radio['reason'];
            $action_update = $row_update_radio['action'];
            $date_update = $row_update_radio['tbc'];
            
            
            //echo "Sensor ID : " . $sensor_id_update;
            $_SESSION['MyError'][1] = $sensor_id_update;
            $_SESSION['MyError'][3] ="NO-USER";
            //echo "<input class=\"hidden\" id=\"sensor_id\" name=\"sensor_id\" value=\"" . $sensor_id_update . "\">\n";
            
                                                                                                                              
            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"updateRadioForm\" name=\"updateRadioForm\" action=\"../php_functions/radio_update.php\" method=\"POST\">\n";
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\">Update Radio Status : " . $radio_name_update . " / " . $radio_type_update . "</label>\n";
            echo "</div>\n";
            
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Radio ID </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"radio\" name=\"radio\" class=\"form-control input-group-lg\" value=\"" . $radio_id_update . "\" readonly >";
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
            echo "<option value=\"\" selected disabled> Radio Status </option>";
            echo "<option class=\"text-primary\" value=\"ΕΝ/ΕΝ\"> ΕΝ/ΕΝ </option>";
            echo "<option class=\"text-primary\" value=\"ΕΚ/ΕΝ\"> ΕΚ/ΕΝ </option>"; 
            echo "<option class=\"text-primary\" value=\"ΕΚ/ΛΕΙΤ\"> ΕΚ/ΛΕΙΤ </option>";
            echo "<option class=\"text-primary\" value=\"LIMITED\"> LIMITED </option>";
            //echo "<option selected=\"selected\" value=\" ". $status_update ."\"> $status_update </option>";
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
            echo "<input type=\"text\" id=\"tbc\"  name=\"tbc\" class=\"form-control date datepicker\" value=\" " .$date_update ."\"> ";
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
        <script src="../js/form_view_radio.js"></script>
        
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
                $("#view_radio").DataTable({
                    responsive: true,
                    "pageLength": 100 
                });
            }); 
        </script> 
    
    
    
</body>
</html>
