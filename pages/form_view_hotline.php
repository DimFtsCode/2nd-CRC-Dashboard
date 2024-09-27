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
        echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_sensor.css?v=" .rand() . "\">" );        
        ?>

        <title> Form View / Update HOTLINE </title> 
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
        <div id="container">
            <div id="header">
                <h1> 2o AKE / Μοίρα Επιχειρήσεων -- Προβολή Status HOTLINEs </h1>
            </div> <!-- end header -->
            <div id="menu">
                <ul>
                    <li><a href="./logout.php"> Logout </a></li>
                    <li><a href="dashboard.php"> Dashboard</a> </li>  
<!--                    <li><a href="../index.php">Home</a></li>  -->

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
                                            <strong> Προβολή HOTLINE Status - <?php echo date("j - m - Y"); ?></strong>
                                        </div>
                                        <!--                                    <div class="panel-heading text-center">
                                                                                <strong> Debug  - <?php // echo $_SESSION['MyError'][0];  echo $_SESSION['MyError'][1]; echo $_SESSION['MyError'][2];echo $_SESSION['MyError'][3]; ?></strong>
                                                                            </div>-->
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php                                                
                                                require_once '../php_functions/db_config/db_connect.php';
                                                $class = "table";
                                                $headArray = array("SN", "ID", "LINE NAME", "TYPE", "STATUS", "REASON / REMARKS", "ACTIONS", "DATE", "by_USER", "DATE_REG",);
                                                $head = count($headArray);                                                
                                                $sql = "SELECT * FROM hotline ORDER BY hotline.line_id ASC";
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $serial = 1;
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_hotline\">";
                                                echo "<caption class=\"text-center \"> Προβολή HOTLINE Status </caption>";
                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head; $i++) {
                                                    echo "<th>" . $headArray[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";

                                                echo "<tbody>";
                                                while ($row_line = mysqli_fetch_array($res)) {
                                                    $loop_var = 0;
                                                    echo "<tr>";
                                                    
                                                    $tdl_id_parse[$loop_var] = $row_line['line_id']; 
                                                    
                                                    echo "<td class=\"serial\">" . $serial . "</td>";    
                                                    if ($user->role == "SYS" || $user->role == "COM" || $user->role == "OPR" || $user->role == "ROIP") {
                                                        echo "<td class=\"tdl_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$tdl_id_parse[$loop_var]" . " \" >" . $row_line['line_id'] . "  </a> </td>";
                                                    } else {
                                                        echo "<td class=\"tdl_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_line['line_id'] . "  </a> </td>";
                                                    }
                                                                                                                             
                                                    echo "<td class=\"line_name\">" . $row_line['line_name'] . "</td>";
                                                    echo "<td class=\"tdl_type\"> " . $row_line['line_type'] . "</td>";                                                    
                                                    echo "<td class=\"status\">" . $row_line['status'] . "</td>";
                                                    echo "<td class=\"reason\">" . $row_line['reason'] . "</td>";
                                                    echo "<td class=\"action\">" . $row_line['action'] . " </strong> </td>";
                                                    echo "<td class=\"tbc\">" . $row_line['tbc'] . "</td>";
                                                    echo "<td class=\"user_reg\">" . $row_line['user_reg'] . "</td>";
                                                    echo "<td class=\"date_reg\">" . $row_line['date_reg'] . "</td>";
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
        $sql_update_line = "SELECT * FROM hotline ORDER BY hotline.line_id ASC";
        $db1 = new DbMgmt;
        $qry_update_line = $db1->runQuery($sql_update_line);
        while ($row_update = mysqli_fetch_array($qry_update_line)) {
            $loop_var = 0;
            $line_id_parse[$loop_var] = $row_update['line_id'];

            //Update Modal
            echo "<div class=\"modal fade\" id=\"update" . $line_id_parse[$loop_var] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";
            echo "<div class=\"modal-dialog\">\n";
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> Update HOTLINE </h3>\n";
            //modal header
            echo "</div>\n";
            $line_id_update = $row_update['line_id'];
            $line_name_update = $row_update['line_name'];
            $line_type_update = $row_update['line_type'];            
            $status_update = $row_update['status'];
            $reason_update = $row_update['reason'];
            $action_update = $row_update['action'];
            $date_update = $row_update['tbc'];
                                                                                                                                                                              
            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"updateHOTLINEForm\" name=\"updateHOTLINEForm\" action=\"../php_functions/hotline_update.php\" method=\"POST\">\n";
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\">Update HOTLINE Status : " . $line_name_update  . "</label>\n";
            echo "</div>\n";
            
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> LINE ID </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"line_id\" name=\"line_id\" class=\"form-control input-group-lg\" value=\"" . $line_id_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";
                                                                                                                                      
            /*
             * Select Status
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
            echo "<option class=\"text-primary\" value=\"STAND-BY\"> STAND BY </option>";            
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
            echo "<label class=\"col-sm-2 control-label\">Date</label> ";
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
        <script src="../js/form_view_hotline.js"></script>
        
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
                $("#view_hotline").DataTable({
                    responsive: true,
                    "pageLength": 100 
                });
            }); 
        </script> 
    
    
    
</body>
</html>
