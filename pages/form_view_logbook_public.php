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
        //echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_sensor.css?v=" .rand() . "\">" );        
        ?>

        <title> Form View Log </title>   
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        
        
        <link rel="stylesheet" type="text/css"  href="../styles/form_view_logbook.css">

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
                <h1> 2o AKE -- Ημερολόγιο ΚΕΠΙΧ </h1>
            </div> <!-- end header -->
            <div id="menu">
                <ul>
                    <li><a href="./Unit_Status0.php"> Unit Status</a> </li>
                    
                    
                    
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
                                            <strong style="color: black; font-size: 20px;"> Ημερολόγιο ΚΕΠΙΧ - <?php echo date("j - m - Y"); ?> ---- </strong>
                                            <strong style="color: black; background-color: yellow;"> ΑΣΚΗΣΕΙΣ - ΕΝΤΑΣΗ - ΠΟΛΕΜΟΣ </strong>
<!--                                            <span style="color: white;" >  1ake 1ake 1ake </span>-->
                                          <span class="panel-heading text-right">
                                            <?php
                                           
//                                            if ($user->role == "SYS" || $user->role2 == "EXER+") {
//                                                echo "<strong class=\"add_log\" style=\"background-color: yellow;\"> <a href=\"./form_add_logbook.php\">" . " Add new Log Record "  .  " </a> </strong>";
//                                            } else {
//                                                echo "<strong class=\"add_log\" style=\"background-color: yellow;\"> <a href=\"#\">" . " Add new Log Record  "  .  " </a> </strong>";    
//                                            }                                                                                                                                
                                            ?>
                                            
                                        </span>
                                           
<!--                                            <button type="button" id="btn_check" name ="btn_check" style="background-color: green" style="font-size: larger"> Delete Record </button>-->
                                        </div>
                                        
                                        <div class="panel-heading text-center">
                                            <?php
                                            require_once '../php_functions/db_config/db_connect.php';
                                            $sql = "SELECT * FROM exerstatic ";
                                            $db3 = new DbMgmt;
                                            $res = $db3->runQuery($sql);
                                            $row_static = mysqli_fetch_array($res);
                                            //if ($user->role == "SYS" || $user->role == "EXER") {
                                            //    echo "<strong class=\"stat_ex\" id=\"stat_ex\" style=\"background-color: yellow;\"> <a href=\"./form_edit_exer_static.php\">" . "EXERCISE INFO : ---- " . $row_static['ex_remark'] . " ----- " . " </a> </strong>";
                                            //} else {
                                                echo "<strong class=\"stat_ex\" id=\"stat_ex\" style=\"background-color: yellow;\"> <a href=\"#\">" . "EXERCISE INFO : ---- " . $row_static['ex_remark'] . " ----- " . " </a> </strong>";    
                                            //}
                                            
                                            //echo "<strong id=\"sunrise_label\"> Π.Φ : </strong>";
                                            //echo "<strong id=\"sunrise\">"  . $row_static['sunrise'] . " ----- " . "</strong>";
                                            //echo "<strong id=\"sunset_label\"> T.Φ : </strong>";
                                            //echo "<strong id=\"sunset\">"  . $row_static['sunset'] . " ----- " . "</strong>";
                                            
                                            ?>
                                            
                                        </div>
                                                                                 
                                      
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                
                                                require_once '../php_functions/db_config/db_connect.php';
                                                $class = "table";
                                                $headArray = array("SN", "ID", "DATE", "TIME", "Description",  "REMARKS", "LV", "REG_date","by_USER");
                                                $head = count($headArray);
                                                $Scope = "LIVE";
                                                
                                                //$sql = "SELECT airstatus.*, bases.* FROM airstatus,bases WHERE airstatus.scope ='{$Scope}' AND (airstatus.daynight ='{$Period}' OR airstatus.daynight ='{$Period2}') AND airstatus.base=bases.base_name ORDER BY bases.base_pri ASC";
                                                //$sql = "SELECT * FROM missions WHERE scope ='{$Scope}' ORDER BY mis_id ASC";
                                                $sql = "SELECT * FROM logbook ORDER BY mdate DESC, mtime DESC";
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $serial = 1;
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_logbook\">";
                                                //echo "<caption class=\"text-center \"> Προβολή Ετοιμοτήτων Α/Φ </caption>";
                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head; $i++) {
                                                    echo "<th>" . $headArray[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                while ($row_air = mysqli_fetch_array($res)) {
                                                    $loop_var = 0;
                                                    echo "<tr>";
                                                    
                                                    $air_id_parse[$loop_var] = $row_air['user_reg'];
                                                    
                                                    echo "<td class=\"serial\">" . $serial . "</td>";    
                                                    //if ($user->role == "SYS" || $user->role2 == "EXER+") {                                                       
                                                    //    echo "<td class=\"log_id\"> <a class=\"btn btn-outline btn-primary\" href=\"./form_edit_logbook.php\" >" . $row_air['log_id'] . " </a> </td>";                                                     
                                                    //} else {                                                        
                                                        echo "<td class=\"log_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_air['log_id'] . "  </a> </td>";
                                                    //}        
                                                    echo "<td class=\"mdate\">" . $row_air['mdate'] . "</td>";
                                                    echo "<td class=\"mtime\">" . $row_air['mtime'] . "</td>";
                                                    echo "<td class=\"description\">" . $row_air['description'] . "</td>";                                                    
                                                    
                                                    
                                                    echo "<td class=\"remark\">" . $row_air['remark'] . " </strong> </td>";
                                                    
                                                    $myIDLoad = "load" . $serial;
                                                    //echo "<td class=\"scope\">" . $row_air['scope'] . " </strong> </td>";
                                                    echo "<td class=\"load\" id=\"" . $myIDLoad . "\"> " . $row_air['load'] . "</td>"; 
                                                    
                                                    
                                                   
                                                    //echo "<td class=\"date_reg\">" . $row_air['date_reg'] . "</td>";
                                                    echo "<td class=\"date_reg\">" . $row_air['date_reg'] . "</td>";
                                                    echo "<td class=\"user_reg\" id=\"user_reg\"> <a data-toggle=\"modal\" data-target=\"#displayUser\" >" . $row_air['user_reg'] . "  </a></td>";

                                                    //if ($user->role == "SYS" || $user->role2 == "EXER+") {                                                       
                                                    //    echo "<td class=\"log_id\"> <a class=\"btn btn-outline btn-primary\" href=\"./form_delete_logbook.php\" >" . $row_air['log_id'] . " </a> </td>";                                                     
                                                    //} else {                                                        
                                                    //    echo "<td class=\"log_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_air['log_id'] . "  </a> </td>";
                                                    //}       
                                                    
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
                        
                        
                        
                        </br>
                        
                        
                        

                        
                        
                         </br>
                         
                         

                                        
                                        
<!--                                        <div class="panel-heading text-right">
                                            <?php
                                           
//                                            if ($user->role == "SYS" || $user->role2 == "EXER+") {
//                                                echo "<strong class=\"add_log\" style=\"background-color: yellow;\"> <a href=\"./form_add_logbook.php\">" . " Add new Log Record "  .  " </a> </strong>";
//                                            } else {
//                                                echo "<strong class=\"add_log\" style=\"background-color: yellow;\"> <a href=\"#\">" . " Add new Log Record  "  .  " </a> </strong>";    
//                                            }                                                                                                                                  
                                            ?>
                                            
                                        </div>
                                        
                                        <div class="panel-heading text-right">
                                            <?php
//                                            if ($user->role == "SYS" || $user->role2 == "EXER+") {
//                                            echo "<strong class=\"del_missions\" style=\"background-color: red;\"> <a href=\"./form_delete_logbook.php\">" . " Delete Logs " . " </a> </strong>";
//                                            } else {
//                                            //echo "<strong class=\"del_missions\" style=\"background-color: yellow;\"> <a href=\"#\">" . " Delete Missions "  .  " </a> </strong>";    
//                                            }
                                            ?>

                                        </div>-->
                                        
                                        
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


    
    
        <!-- Modal Find User Information !! -->
        <?php
        $MyAsma = $_SESSION['MyUser'][0];
        $sql_update_user = "SELECT * FROM personnel WHERE asma ='{$MyAsma}' ";
        $db2 = new DbMgmt;
        $qry_update_user = $db2->runQuery($sql_update_user);  
        $row_update = mysqli_fetch_array($qry_update_user);
        
        $MyAsma =0;
        $_SESSION['MyUser'][0]=0;
            //Update Modal
            echo "<div class=\"modal fade\" id=\"displayUser\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";
            echo "<div class=\"modal-dialog\">\n";
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> User Information </h3>\n";
            //modal header
            echo "</div>\n";
            $userRank = $row_update['rank'];                       
            $userSplty = $row_update['splty'];
            $userSname = $row_update['sname'];
            $userFname = $row_update['fname'];
            //$link_update = $row_update['link'];
            //$valid_update = $row_update['valid'];
            
            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"userDataForm\" name=\"updatePostForm\" action=\"#\" method=\"POST\">\n";
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\">" . $userRank . "  " . $userSplty . "  " . $userSname . "  " . $userFname . "   </label>\n";
            //echo "<label class=\"col-sm-8 control-label\">" . $_SESSION['MyUser'][1] . "  " . $_SESSION['MyUser'][2] . "  " . $_SESSION['MyUser'][3] . "  " . $_SESSION['MyUser'][4] . "   </label>\n";
            echo "</div>\n";
                        
            echo "</div>";
            //Modal Body
            echo "</div>";
            echo "<div class=\"modal-footer\">";
            echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";           
            //echo "<button type=\"submit\" id=\"update\" class=\"btn btn-primary\">Update</button>";
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
            
            //echo "<script type=\"text/javascript\" src=\"../js/update_post.js\"></script>\n"; 
            
            //$_SESSION['MyUser'][0] = 0;
            $db2->close;
        
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
        <script src="../js/form_view_logbook.js"></script>
        
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
                $("#view_logbook").DataTable({
                    responsive: true,
                    "pageLength": 100 
                });
            }); 
        </script> 
                            
    
</body>
</html>
