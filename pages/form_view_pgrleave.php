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
        //echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_sensor.css?v=" .rand() . "\">" );        
        ?>

        <title> Form View PGR Leaves </title>   
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        
        
        <link rel="stylesheet" type="text/css"  href="../styles/form_view_pgrleave.css">

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
                <h1> 2o AKE -- Προβολή Προγραμματισμένων Αδειών </h1>
            </div> <!-- end header -->
            <div id="menu">
                <ul>
                    <li><a href="./logout.php"> Logout </a></li>
                    <li><a href="dashboard.php"> Dashboard</a> </li>
                    <li><a href="./form_add_pgr_leave.php"> Νέα Άδεια</a> </li> 

                </ul>
            </div> <!-- end menu -->          

            <div id="mainContainer">


                <div id="content">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">                                          
                                            <strong style="color: black; background-color: yellow; font-size: 18px;"> ΠΡΟΒΟΛΗ ΠΡΟΓΡΑΜΜΑΤΙΣΜΕΝΩΝ ΑΔΕΙΩΝ </strong>                                                     

                                        </div>

                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                //global $_SESSION['MyID'] = array();
                                                $_SESSION['MyIDE'][100] = 4;
                                                
                                                require_once '../php_functions/db_config/db_connect.php';
                                                $class = "table";
                                                $headArray = array("SN", "ID", "ASMA", "DATE", "Num", "Leave_type", "Location", "REG_date", "DEL");
                                                $head = count($headArray);
                                                $Scope = "LIVE";

                                                $sql = "SELECT pgrleave.*, leave_type.id, leave_type.description as My_type FROM pgrleave, leave_type WHERE pgrleave.pl_asma = $user->asma AND pgrleave.leave_type = leave_type.id ORDER BY start_date DESC";
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $serial = 1;
                                                $loop_var = 0;
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_pgrleave\">";

                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head; $i++) {
                                                    echo "<th>" . $headArray[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";   
                                                 $_SESSION['superhero'] = "batman";
                                                while ($row_air = mysqli_fetch_array($res)) {
                                                    //$loop_var = 0;
                                                    echo "<tr>";

                                                    $pl_id_parse[$loop_var] = $row_air['pl_id'];
                                                   

                                                    echo "<td class=\"serial\">" . $serial . "</td>";                                                       
                                                    $MyArrayID[$loop_var] = $row_air['pl_id'];                                                   
                                                    //echo "<td class=\"pl_id\" > <a class=\"btn btn-outline btn-primary\" href=\"\" >" . $row_air['pl_id'] . " </a> </td>"; 
                                                    //echo "<td class=\"pl_id\" > <a class=\"btn btn-outline btn-primary\" href=\"./form_edit_pgr_leave.php\" >" . $row_air['pl_id'] . " </a> </td>"; 
                                                    echo "<td class=\"pl_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$pl_id_parse[$loop_var]" . " \" >" . $row_air['pl_id'] . "  </a> </td>";
   
                                                    echo "<td class=\"pl_asma\" id=\"pl_asma\">" . $row_air['pl_asma'] . "</td>";
                                                    echo "<td class=\"start_date\">" . $row_air['start_date'] . "</td>";
                                                    echo "<td class=\"numofdays\">" . $row_air['num_days'] . " </strong> </td>";
                                                    echo "<td class=\"leave_type\">" . $row_air['My_type'] . "</td>";
                                                    echo "<td class=\"location\" >" . $row_air['pl_location'] . "</td>";

                                                    echo "<td class=\"date_reg\">" . $row_air['date_reg'] . "</td>";
                                                    
                                                    //echo "<td class=\"pl_id\" id=\"mytest\"> <a class=\"btn btn-outline btn-primary\" >" . $row_air['pl_id'] . "  </a> </td>";                                                     
                                                    //echo "<td class=\"del_id\" > <a class=\"btn btn-outline btn-primary\" href=\"./form_edit_pgr_leave.php\" >".$row_air['pl_id']." </a> </td>"; 
                                                    echo "<td class=\"del_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#delete" ."$pl_id_parse[$loop_var]"."\">".$row_air['pl_id']." </a> </td>";
                                                    //echo "<td class=\"pl_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#delete\" >" . $row_air['pl_id'] . "  </a> </td>";
                                                    echo "</tr>";
                                                    $loop_var = $loop_var + 1;
                                                    $serial = $serial + 1;
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
                </div>
            </div>
        </div>
                        
        <!-- Modal Edit PGR Leave !! -->
        <?php
        $sql_update_leave = "SELECT pgrleave.*, leave_type.id, leave_type.description as My_type FROM pgrleave, leave_type WHERE pgrleave.pl_asma = $user->asma AND pgrleave.leave_type = leave_type.id ORDER BY start_date DESC";
        
        $db2 = new DbMgmt;
        $qry_update_leave = $db2->runQuery($sql_update_leave);      
        
        while ($row_update = mysqli_fetch_array($qry_update_leave)) {
            //$loop_var = 0;
            $pl_id_parse[$loop_var] = $row_update['pl_id'];

            //Update Modal
            echo "<div class=\"modal fade\" id=\"update" . $pl_id_parse[$loop_var] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";            
            echo "<div class=\"modal-dialog\">\n";            
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> ΔΙΟΡΘΩΣΗ  ΑΔΕΙΑΣ </h3>\n";
            //modal header
            echo "</div>\n";
            $pl_id_update = $row_update['pl_id'];
            $start_date_update = $row_update['start_date'];
            $num_days_update = $row_update['num_days'];
            $leave_type_update = $row_update['My_type'];

            $pl_location_update = $row_update['pl_location'];


            //echo "Sensor ID : " . $sensor_id_update;
            $_SESSION['MyError'][1] = $sensor_id_update;
            $_SESSION['MyError'][3] = "NO-USER";
            //echo "<input class=\"hidden\" id=\"sensor_id\" name=\"sensor_id\" value=\"" . $sensor_id_update . "\">\n";


            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"updatePGRLeaveForm\" name=\"updatePGRLeaveForm\" action=\"../php_functions/pgr_leave_edit.php\" method=\"POST\">\n";
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\">Update PGR Leave </label>\n";
            echo "</div>\n";


            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> PL ID </label>\n";
            echo "<div class=\"col-sm-4\">";
            echo "<input type=\"text\" id=\"pl_id\" name=\"pl_id\" class=\"form-control input-group-lg\" value=\"" . $pl_id_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";
                        
            /*
             * Select days
             */
            echo "<div class=\"form-group form-group-sm\">\n";
            echo "<div class=\"col-sm-2\">\n";
            echo "<label class=\"col-sm-2 control-label\">Days</label>\n";
            echo "</div>\n";
            echo "<div class=\"col-sm-4\">\n";
            echo "<select class=\"col-sm-8 form-control\" id=\"num_days\" required=\"num_days\" name=\"num_days\">\n";
            echo "<option value=\"\" selected disabled> num of days </option>";
            for ($arx = 1; $arx < 31; $arx++) {
                                            
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
            //echo "<option selected=\"selected\" value=\" ". $status_update ."\"> $status_update </option>";
            echo "</select>\n";
            echo "</div>\n";
            echo "</div>\n";
            /*
             * End here
             */
            //Select ends here:
            
            
            /*
             * Select leave type
             */
            echo "<div class=\"form-group form-group-sm\">\n";
            echo "<div class=\"col-sm-2\">\n";
            echo "<label class=\"col-sm-2 control-label\">Leave Type</label>\n";
            echo "</div>\n";
            echo "<div class=\"col-sm-4\">\n";
            echo "<select class=\"col-sm-8 form-control\" id=\"leave_type\" required=\"leave_type\" name=\"leave_type\">\n";
            
            require_once '../php_functions/db_config/db_connect.php';
            $db3 = new DbMgmt;
            $sql = "SELECT  * FROM `leave_type` ORDER BY `id` ";
            $div = $db3->runQuery($sql);
             echo "<option value=\"\" selected disabled> leave type </option>";
            while ($row_div = mysqli_fetch_array($div)) {
                echo "<option value=\"" . $row_div['id'] . "\">" . $row_div['description']   . "</option>";
            }

            //echo "<option selected=\"selected\" value=\" ". $status_update ."\"> $status_update </option>";
            echo "</select>\n";
            echo "</div>\n";
            echo "</div>\n";
            /*
             * End here
             */
            //Select ends here:
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">  </label>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">  </label>\n";
            echo "</div>\n";
                        
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">Start Date</label> ";
            echo "<div  class=\"input-group date col-sm-4\" > ";
            echo "<input type=\"text\" id=\"start_date\"  name=\"start_date\" class=\"form-control date datepicker\" value=\" " . $start_date_update . "\"> ";
            echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-calendar\"></i></span> ";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">  </label>\n";
            echo "</div>\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Location </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"pl_loction\" name=\"pl_loction\" required=\"pl_location\" class=\"form-control input-group-lg\" placeholder=\"location\" value=\"" . $pl_location_update . "\">";
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
    
         
        
        <!-- Modal Delete PGR Leave !! -->
        <?php
        $sql_update_leave = "SELECT pgrleave.*, leave_type.id, leave_type.description as My_type FROM pgrleave, leave_type WHERE pgrleave.pl_asma = $user->asma AND pgrleave.leave_type = leave_type.id ORDER BY start_date DESC";
        //$sql_update_leave = "SELECT * FROM personnel WHERE asma ='{$MyAsma}' ";
        $db2 = new DbMgmt;
        $qry_update_leave = $db2->runQuery($sql_update_leave);
        //$row_update = mysqli_fetch_array($qry_update_leave);
        
        while ($row_update = mysqli_fetch_array($qry_update_leave)) {
            //$loop_var = 0;
            $pl_id_parse[$loop_var] = $row_update['pl_id'];

            //Update Modal
            echo "<div class=\"modal fade\" id=\"delete" . $pl_id_parse[$loop_var] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n"; 
            //echo "<div class=\"modal fade\" id=\"delete\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";            
            echo "<div class=\"modal-dialog\">\n";
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> ΔΙΑΓΡΑΦΗ  ΑΔΕΙΑΣ </h3>\n";
            //modal header
            echo "</div>\n";
            $pl_id_update = $row_update['pl_id'];
            $start_date_update = $row_update['start_date'];
            $num_days_update = $row_update['num_days'];
            $leave_type_update = $row_update['My_type'];

            $pl_location_update = $row_update['pl_location'];


            //echo "Sensor ID : " . $sensor_id_update;
            $_SESSION['MyError'][1] = $sensor_id_update;
            $_SESSION['MyError'][3] = "NO-USER";
            //echo "<input class=\"hidden\" id=\"sensor_id\" name=\"sensor_id\" value=\"" . $sensor_id_update . "\">\n";


            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"deletePGRLeaveForm\" name=\"deletePGRLeaveForm\" action=\"../php_functions/pgr_leave_delete.php\" method=\"POST\">\n";
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\">Delete PGR Leave </label>\n";
            echo "</div>\n";


            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> PL ID </label>\n";
            echo "<div class=\"col-sm-4\">";
            echo "<input type=\"text\" id=\"del_id\" name=\"pl_id\" class=\"form-control input-group-lg\" value=\"" . $pl_id_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";
            
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">Start Date</label> ";
            echo "<div  class=\"input-group date col-sm-4\" > ";
            echo "<input type=\"text\" id=\"start_date\"  name=\"start_date\" class=\"form-control date datepicker\" value=\" " . $start_date_update . "\" readonly> ";
            echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-calendar\"></i></span> ";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Days </label>\n";
            echo "<div class=\"col-sm-4\">";
            echo "<input type=\"text\" id=\"pl_id\" name=\"pl_id\" class=\"form-control input-group-lg\" value=\"" . $num_days_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";            
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Leave Type </label>\n";
            echo "<div class=\"col-sm-6\">";
            echo "<input type=\"text\" id=\"pl_id\" name=\"pl_id\" class=\"form-control input-group-lg\" value=\"" . $leave_type_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";    
                                  
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Location </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"pl_loction\" name=\"pl_loction\" required=\"pl_location\" class=\"form-control input-group-lg\" placeholder=\"location\" value=\"" . $pl_location_update . "\" readonly >";
            echo "</div>\n"; 
            echo "</div>\n";

            echo "</div>";
            //Modal Body
            echo "</div>";
            echo "<div class=\"modal-footer\">";
            echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
            echo "<button type=\"submit\" id=\"delete\" class=\"btn btn-primary\">Delete</button>";
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
        <script src="../bower_components/jquery/dist/jquery.js"></script>
        <script src="../bower_components/jquery/dist/jquery.ui.js"></script>

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
        <script src="../js/form_view_pgr_leave.js"></script>
<!--        <script src="../js/modal_draggable.js"></script>-->
                
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
                $("#view_pgrleave").DataTable({
                    responsive: true,
                    "pageLength": 100 
                });
            }); 
        </script> 
                            
    
</body>
</html>


