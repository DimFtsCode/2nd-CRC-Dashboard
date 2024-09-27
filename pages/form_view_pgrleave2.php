 <?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php")); 
}

if (!($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD")) { 
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
                <h1> 2o AKE -- Προβολή  Προγραμματισμένων Αδειών Προσωπικού </h1>
            </div> <!-- end header -->
            <div id="menu">
                <ul>
                    <li><a href="./logout.php"> Logout </a></li>
                    <li><a href="dashboard.php"> Dashboard</a> </li>
                    <li><a href="./form_personnel_detail_info.php"> Αναλυτική Προβολή </a> </li> 

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
                                            <strong style="color: black; background-color: yellow; font-size: 18px;"> ΠΡΟΒΟΛΗ ΠΡΟΓΡΑΜΜΑΤΙΣΜΕΝΩΝ ΑΔΕΙΩΝ του :  </strong> 
                                            <label id="blank"> ... >>>   </label>
                                            <label id="Head_asma" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                            <label id="blank"> ...   </label>
                                            <label id="Head_rank" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                            <label id="blank"> ...   </label>
                                            <label id="Head_specialty" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                             <label id="blank"> ...   </label>
                                             <label id="Head_last_name" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                             <label id="blank"> ...   </label>
                                             <label id="Head_first_name" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                        </div>
                                      
                                        <div class="form-group">
                                           <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                                           <div class="col-sm-4">
                                           <!--<input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" style="display:none"  readonly>-->  
                                           <input type="text" id="userAsma" name="userAsma" class="form-control"  style="display:none"  value="<?php $myVar = $user->asma;  $myVar = $myVar . "XID";echo $_SESSION[$myVar]?>"  >
                                          </div>
                                       </div>   
     
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                //global $_SESSION['MyID'] = array();
                                                $_SESSION['MyIDE'][100] = 4;
                                                
                                                $myVar2 = $user->asma;
                                                $myVar2 = $myVar2 . "XID";
                                                $sp_userAsma = $_SESSION[$myVar2];
                                                
                                                
                                                require_once '../php_functions/db_config/db_connect.php';
                                                $class = "table";
                                                $headArray = array("SN", "TRANSFER", "ASMA", "DATE", "Num", "Leave_type", "Location", "REG_date");
                                                $head = count($headArray);
                                                $Scope = "LIVE";

                                                
                                                $sql = "SELECT pgrleave.*, leave_type.id as My_ID, leave_type.description as My_type FROM pgrleave, leave_type WHERE pgrleave.pl_asma = $sp_userAsma AND pgrleave.leave_type = leave_type.id ORDER BY start_date DESC";
                                                
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $serial = 1;
                                                $loop_var = 0;
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_leave\">";

                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head; $i++) {
                                                    echo "<th>" . $headArray[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";   
                                                
                                                
                                                $c10 = 0 ;      
                                                $c11 = 0 ;      
                                                $c12 = 0 ;      
                                                $c13 = 0 ;      
                                                $c14 = 0 ;      
                                                $c15 = 0 ;      
                                                $c17 = 0 ;      
                                                $c19 = 0 ;      
                                                $c21 = 0 ;                                                                                                      
                                                
                                                while ($row_air = mysqli_fetch_array($res)) {
                                                    //$loop_var = 0;
                                                    $CheckIDLeave = $row_air['My_ID'];
                                                    $Days = $row_air['num_days'] ;
                                                    
                                                     switch ($CheckIDLeave) {
                                                                case  10 :
                                                                    $c10 = $c10 + $Days ;
                                                                    break; 
                                                                case  11 :
                                                                    $c11 = $c11 + $Days ;
                                                                    break; 
                                                                case  12 :
                                                                    $c12 = $c12 + $Days ;
                                                                    break;  
                                                                case  13 :
                                                                    $c13 = $c13 + $Days ;
                                                                    break;  
                                                                case  14 :
                                                                    $c14 = $c14 + $Days ;
                                                                    break;  
                                                                case  15 :
                                                                    $c15 = $c15 + $Days ;
                                                                    break;  
                                                                case  17 :
                                                                    $c17 = $c17 + $Days ;
                                                                    break;  
                                                                case  19 :
                                                                    $c19 = $c19 + $Days ;
                                                                    break;  
                                                                case  21 :
                                                                    $c21 = $c21 + $Days ;
                                                                    break;  
                                                         }
                                                    
                                                    echo "<tr>";

                                                    $id_parse[$loop_var] = $row_air['pl_id'];
                                                   

                                                    echo "<td class=\"serial\">" . $serial . "</td>";                                                       
                                                                                                 
                                                    if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                                                        echo "<td class=\"tbl_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$id_parse[$loop_var]" . " \" >" . $row_air['pl_id'] . "  </a> </td>";
                                                    } else {
                                                        echo "<td class=\"tbl_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_air['pl_id'] . "  </a> </td>";
                                                    }
                                                    
                                                    echo "<td class=\"asma\" id=\"asma\">" . $row_air['pl_asma'] . "</td>";
                                                    echo "<td class=\"start_date\">" . $row_air['start_date'] . "</td>";
                                                    echo "<td class=\"numofdays\">" . $row_air['num_days'] . " </strong> </td>";
                                                    echo "<td class=\"leave_type\">" . $row_air['My_type'] . "</td>";
                                                    echo "<td class=\"location\" >" . $row_air['pl_location'] . "</td>";

                                                    echo "<td class=\"date_reg\">" . $row_air['date_reg'] . "</td>";
                                                     //echo "<td class=\"user_reg\">" . $row_air['user_reg'] . "</td>";
                                                    
                                                    
                                                    //echo "<td class=\"del_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#delete" ."$id_parse[$loop_var]"."\">".$row_air['tbl_id']." </a> </td>";
                                                   
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
                
                                                               
           <!--       //////////////////////////////////////////////////////////////////////////      -->     
           
                           
                <div id="content2">
                    <div class="container-fluid">
                        <!--<div class="row">-->

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-heading text-center">                                          
                                            <strong style="color: black; background-color: cyan; font-size: 18px;"> ΣΥΝΟΛΑ ΠΡΟΓΡΑΜΜΑΤΙΣΜΕΝΩΝ ΑΔΕΙΩΝ ΤΡΕΧΟΝΤΟΣ ΕΤΟΥΣ </strong> 
                                            
                                        </div>
                                                                              
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                
                                                $class2 = "table";
                                                $headArray2 = array("ΚΑΝΟΝΙΚΗ", "ΜΙΚΡΑΣ", "ΗΜΕΡΗΣΙΑ", "ΓΟΝΙΚΗ", "ΑΝΑΡΡΩΤΙΚΗ", "ΜΕΤΑΘΕΣΗΣ", "ΦΟΙΤΗΤΙΚΗ", "ΑΙΜΟΔΟΤΙΚΗ", "ΕΙΔ. ΣΚΟΠΟΥ");
                                                $head2 = count($headArray2);
                                               
                                                $sequal = 1;
                                               
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"sum_leave1\">";

                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head2; $i++) {
                                                    echo "<th>" . $headArray2[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";   
                                                
                                                    echo "<tr>";

                                                    $id_parse[$loop_var] = $row_air['tbl_id'];
                                                   
                                                    //echo "<td class=\"serial\">" . $sequal . "</td>";                                                                                                                                                      
                                                    
                                                    echo "<td class=\"sum1\">" . $c10 . "</td>";

                                                    echo "<td class=\"sum\" id=\"sum2\">" . $c11 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum3\">" . $c12 . "</td>";
                                                    
                                                    echo "<td class=\"sum\" id=\"sum4\">" . $c13 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum5\">" . $c14 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum6\">" . $c15 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum7\">" . $c17 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum8\">" . $c19 . "</td>";
                                                    
                                                    echo "<td class=\"sum\" id=\"sum9\">" . $c21 . "</td>";
                                                                                                                                                     
                                                    echo "</tr>";

                                                echo "</tbody>";

                                                echo "</table>";

                                                //table($class, $headArray, $res);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <!--</div>-->
                        <!-- /.row -->
                      

                    </div>
                </div>
           
           
           
           <!--       //////////////////////////////////////////////////////////////////////////      -->
            </div>
        </div>
                        
        <!-- Modal Transfer Leave !! -->
        <?php
        //$sp1_userAsma = 16518;
        //$sql_update_leave = "SELECT leaves.*, leave_type.id, leave_type.description as My_type FROM leaves, leave_type WHERE leaves.asma =$sp_userAsma AND leaves.leave_type = leave_type.id ORDER BY start_date DESC";
        $sql_update_leave = "SELECT pgrleave.*, leave_type.id as Type_id, leave_type.description as My_type FROM pgrleave, leave_type WHERE pgrleave.pl_asma = $sp_userAsma AND pgrleave.leave_type = leave_type.id ORDER BY start_date DESC";
        
        $db2 = new DbMgmt;
        $qry_update_leave = $db2->runQuery($sql_update_leave);      
        
        while ($row_update = mysqli_fetch_array($qry_update_leave)) {
            //$loop_var = 0;
            $id_parse[$loop_var] = $row_update['pl_id'];

            //Update Modal
            echo "<div class=\"modal fade\" id=\"update" . $id_parse[$loop_var] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";            
            echo "<div class=\"modal-dialog\">\n";            
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> ΜΕΤΑΦΟΡΑ  ΑΔΕΙΑΣ </h3>\n";
            //modal header
            echo "</div>\n";
            $id_update = $row_update['pl_id'];
            $start_date_update = $row_update['start_date'];
            $num_days_update = $row_update['num_days'];
            $leave_type_id = $row_update['Type_id'];
            $leave_type_update = $row_update['My_type'];

            $location_update = $row_update['pl_location'];

            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"updateLeaveForm\" name=\"updateLeaveForm\" action=\"../php_functions/leave_transfer.php\" method=\"POST\">\n";  //action
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\">Transfer Leave </label>\n";
            echo "</div>\n";


            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Leave ID </label>\n";
            echo "<div class=\"col-sm-4\">";
            echo "<input type=\"text\" id=\"tbl_id\" name=\"tbl_id\" class=\"form-control input-group-lg\" value=\"" . $id_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> User asma</label>\n";
            echo "<div class=\"col-sm-4\">";
            echo "<input type=\"text\" id=\"asma\" name=\"asma\" class=\"form-control input-group-lg\" value=\"" . $sp_userAsma . "\" readonly >";
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
            echo "<input type=\"text\" id=\"num_days\" name=\"num_days\" class=\"form-control input-group-lg\" value=\"" . $num_days_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";     
                        
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Leave Type </label>\n";
            echo "<div class=\"col-sm-6\">";          
            echo "<input type=\"text\" id=\"leave_type\" name=\"leave_type\" class=\"form-control input-group-lg\" value=\"" . $leave_type_update  . "\" readonly >";                                                                                                                                                 
            echo "</div>\n";
            echo "</div>\n";                                        
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Location </label>\n";
            echo "<div class=\"col-sm-6\">";          
            echo "<input type=\"text\" id=\"location\" name=\"location\" class=\"form-control input-group-lg\" value=\"" . $location_update  . "\" readonly >";                                                                                                                                                 
            echo "</div>\n";
            echo "</div>\n";  
             
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\" style=\"display:none\"> Leave Type ID </label>\n";
            echo "<div class=\"col-sm-6\">";          
            echo "<input type=\"text\" id=\"leave_type_id\" name=\"leave_type_id\" class=\"form-control input-group-lg\" style=\"display:none\" value=\"" . $leave_type_id  . "\" readonly >";                                                                                                                                               
            echo "</div>\n";
            echo "</div>\n"; 
            
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">  </label>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">  </label>\n";
            echo "</div>\n";                        
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">  </label>\n";
            echo "</div>\n";

            
            echo "</div>";
            //Modal Body
            echo "</div>";
            echo "<div class=\"modal-footer\">";
            echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
            echo "<button type=\"submit\" id=\"update\" class=\"btn btn-primary\">Transfer</button>";
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
        <script src="../js/form_view_pgrleave2.js"></script>

                
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
                $("#view_leave").DataTable({
                    responsive: true,
                    "pageLength": 100 
                });
            }); 
        </script> 
        
 
                            
    
</body>
</html>




