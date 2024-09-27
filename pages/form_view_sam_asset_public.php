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
        echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_sam.css\" >" );        
        ?>

        <title> Form View SAM / SHORAD Readiness </title>  
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        
        
        <link rel="stylesheet" type="text/css"  href="../styles/form_view_sam_asset.css">

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
                <h1> 2o AKE / Μοίρα Επιχειρήσεων -- Προβολή Ετοιμοτήτων SAM / SHORAD </h1>
                <h3> -- NATO CONFIDENTIAL -- </h3>
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
                            <!-- /.col-lg-12 -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">
                                            <strong> Προβολή Ετοιμοτήτων SAM / SHORAD - <?php echo date("j - m - Y"); ?> ---- </strong>                                            
                                        </div>
                                        <div class="panel-heading text-center">                                            
                                            <?php
                                            require_once '../php_functions/db_config/db_connect.php';
                                            $sql = "SELECT * FROM saminfo ";
                                            $db3 = new DbMgmt;
                                            $res = $db3->runQuery($sql);
                                            $row_saminfo = mysqli_fetch_array($res);
                                            
                                            echo "<strong style=\"background-color: cyan;\">  ΚΑΤΑΣΤΑΣΗ ΕΛΕΓΧΟΥ ΕΚΠΟΜΠΩΝ  :  </strong>"; 
                                            //if ($user->role == "SYS" || $user->role == "SAM") {
                                            //echo "<strong id=\"info_order\" style=\"background-color: yellow;\"> <a href=\"./form_edit_saminfo.php\">"  . $row_saminfo['gen_order'] .  " </a> </strong>";
                                            //} else {
                                            echo "<strong id=\"info_order\" style=\"background-color: yellow;\"> <a href=\"#\">" . $row_saminfo['gen_order'] .  " </a> </strong>";    
                                            //}
                                            echo "<strong id=\"info_remark\">"  . " ----- "  . $row_saminfo['gen_remark'] . " ----- " . "</strong>";
                                            echo "<strong id=\"info_update\">"  . " Updated On : "  . $row_saminfo['date_reg'] . "</strong>";
                                            
                                            ?>                                            
                                        </div>
                                                                                                                                                                                                      
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                
                                                require_once '../php_functions/db_config/db_connect.php';
                                                $class = "table";
                                                $headArray = array("SN", "ID", "WEAPON", "Unit", "Location", "STATUS", "REMARKS", "DATE_REG", "USER");
                                                $head = count($headArray);
                                                $myStatus1 = "N/A";
                                                $myStatus2 = "RS-0";
                                                
                                                $sql = "SELECT * FROM samstatus WHERE samstatus.status <> '{$myStatus2}' ORDER BY weapon_pri ASC";
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $serial = 1;
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_sam_asset\">";
                                                
                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head; $i++) {
                                                    echo "<th>" . $headArray[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                while ($row_sam = mysqli_fetch_array($res)) {
                                                    $loop_var = 0;
                                                    echo "<tr>";
                                                    
                                                    $sam_id_parse[$loop_var] = $row_sam['user_reg'];
                                                    
                                                    echo "<td class=\"serial1\">" . $serial . "</td>";    
                                                    //if ($user->role == "SYS" || $user->role == "SAM" || $user->role2 == "SAM+") {                                                       
                                                    //    echo "<td class=\"sam_id\"> <a class=\"btn btn-outline btn-primary\" href=\"./form_edit_sam_asset.php\" >" . $row_sam['sam_id'] . " </a> </td>";                                                     
                                                    //} else {                                                        
                                                        echo "<td class=\"sam_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_sam['sam_id'] . "  </a> </td>";
                                                    //}                                                                                                                                          
                                                    echo "<td class=\"weapon\">" . $row_sam['weapon'] . "</td>";
                                                    echo "<td class=\"samunit\"> " . $row_sam['samunit'] . "</td>";
                                                    echo "<td class=\"location\"> " . $row_sam['location'] . "</td>"; 
                                                    
                                                    //$myIDstatus = "status1" . $row_sam['sam_id'];
                                                    $myIDstatus = "status1" . $serial;
                                                    echo "<td class=\"status1\" id=\"" . $myIDstatus . "\"> " . $row_sam['status'] . "</td>"; 
                                                    //echo "<td class=\"status1\" > " . $row_sam['status'] . "</td>";
                                                    echo "<td class=\"remark1\">" . $row_sam['remark'] . " </strong> </td>";
                                                    
                                                   
                                                    echo "<td class=\"date_reg1\">" . $row_sam['date_reg'] . "</td>";
                                                    echo "<td class=\"user_reg1\" id=\"user_reg\"> <a data-toggle=\"modal\" data-target=\"#displayUser\" >" . $row_sam['user_reg'] . "  </a></td>";
                                                    
                                                    
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
                        
                        
                        
                        <div class="row">
<!--                            <div class="col-lg-12">
                                <h1 class="page-header"> Προβολή RADAR Status </h1>
                            </div>-->
                            <!-- /.col-lg-12 -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">
                                            <strong> Προβολή Ετοιμοτήτων Α/Α ΟΠΛΩΝ - STINGER  - <?php echo date("j - m - Y"); ?> ---- </strong>
                                            
                                        </div>
                                        
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                
                                                require_once '../php_functions/db_config/db_connect.php';
                                                $class = "table";
                                                $headArray = array("SN", "ID", "ΣΥΣΤΗΜΑ", "RS-1", "RS-4", "RS-4A", "RS-5", "RS-5A", "RS-5B", "RS-6", "RS-11", "RS-12", "REMARKS", "DATE_REG", "USER");
                                                $head = count($headArray);                                                
                                                $sql = "SELECT * FROM samstatic ORDER BY static_id ASC";
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $serial = 1;
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_sam_static\">";                                                
                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head; $i++) {
                                                    echo "<th>" . $headArray[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                while ($row_sam = mysqli_fetch_array($res)) {
                                                    $loop_var = 0;
                                                    echo "<tr>";
                                                    
                                                    $sam_id_parse[$loop_var] = $row_sam['useer_reg'];
                                                    
                                                    echo "<td class=\"serial2\">" . $serial . "</td>";    
                                                    //if ($user->role == "SYS" || $user->role == "SAM" || $user->role2 == "SAM+") {
                                                        
                                                    //    echo "<td class=\"sam_id\"> <a class=\"btn btn-outline btn-primary\" href=\"./form_edit_sam_static.php\" >" . $row_sam['static_id'] . " </a> </td>"; 
                                                    //} else {                                                        
                                                        echo "<td class=\"sam_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_sam['static_id'] . "  </a> </td>";
                                                    //}                                                                                                                                          
                                                    echo "<td class=\"system\">" . $row_sam['system'] . "</td>";
                                                    echo "<td class=\"rs1\"> " . $row_sam['rs1'] . "</td>";
                                                    echo "<td class=\"rs4\"> " . $row_sam['rs4'] . "</td>";
                                                    echo "<td class=\"rs4a\"> " . $row_sam['rs4a'] . "</td>";
                                                    echo "<td class=\"rs5\"> " . $row_sam['rs5'] . "</td>";
                                                    echo "<td class=\"rs5a\"> " . $row_sam['rs5a'] . "</td>";
                                                    echo "<td class=\"rs5b\"> " . $row_sam['rs5b'] . "</td>";                                                    
                                                    
                                                    echo "<td class=\"rs6\">" . $row_sam['rs6'] . "</td>";
                                                    echo "<td class=\"rs11\">" . $row_sam['rs11'] . "</td>";
                                                    echo "<td class=\"rs12\">" . $row_sam['rs12'] . "</td>";
                                                    echo "<td class=\"remark2\">" . $row_sam['remark'] . " </strong> </td>";
                                                    
                                                   
                                                    echo "<td class=\"date_reg2\">" . $row_sam['date_reg'] . "</td>";
                                                    echo "<td class=\"user_reg2\" id=\"user_reg\"> <a data-toggle=\"modal\" data-target=\"#displayUser\" >" . $row_sam['user_reg'] . "  </a></td>";  
                                                                                                       
                                                    
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
                         
                         
                         <div class="row">
                            <!-- /.col-lg-12 -->
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">
                                            <strong style="background-color: yellow" > Προβολή Μονάδων SAM / SHORAD  ΧΩΡΙΣ ΕΤΟΙΜΟΤΗΤΑ - <?php echo date("j - m - Y"); ?> ---- </strong>
                                            
                                        </div>
                                                                                                                                                                                                      
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                
                                                require_once '../php_functions/db_config/db_connect.php';
                                                $class = "table";
                                                $headArray = array("SN", "ID", "WEAPON", "Unit", "Location", "STATUS", "REMARKS", "DATE_REG", "USER");
                                                $head = count($headArray);
                                                $myStatus1 = "N/A";
                                                $myStatus2 = "RS-0";
                                                
                                                $sql = "SELECT * FROM samstatus WHERE samstatus.status='{$myStatus2}' ORDER BY weapon_pri ASC";
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $serial = 1;
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_sam_asset_0\">";
                                                
                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head; $i++) {
                                                    echo "<th>" . $headArray[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                while ($row_sam = mysqli_fetch_array($res)) {
                                                    $loop_var = 0;
                                                    echo "<tr>";
                                                    
                                                    $sam_id_parse[$loop_var] = $row_sam['user_reg'];
                                                    
                                                    echo "<td class=\"serial3\">" . $serial . "</td>";    
                                                    //if ($user->role == "SYS" || $user->role == "SAM" || $user->role2 == "SAM+") {                                                       
                                                    //    echo "<td class=\"sam_id\"> <a class=\"btn btn-outline btn-primary\" href=\"./form_edit_sam_asset.php\" >" . $row_sam['sam_id'] . " </a> </td>";                                                     
                                                    //} else {                                                        
                                                        echo "<td class=\"sam_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_sam['sam_id'] . "  </a> </td>";
                                                    //}                                                                                                                                          
                                                    echo "<td class=\"weapon3\">" . $row_sam['weapon'] . "</td>";
                                                    echo "<td class=\"samunit3\"> " . $row_sam['samunit'] . "</td>";
                                                    echo "<td class=\"location3\"> " . $row_sam['location'] . "</td>"; 
                                                    echo "<td class=\"status3\"> " . $row_sam['status'] . "</td>"; 
                                                    echo "<td class=\"remark3\">" . $row_sam['remark'] . " </strong> </td>";
                                                    
                                                   
                                                    echo "<td class=\"date_reg3\">" . $row_sam['date_reg'] . "</td>";
                                                    echo "<td class=\"user_reg3\" id=\"user_reg\"> <a data-toggle=\"modal\" data-target=\"#displayUser\" >" . $row_sam['user_reg'] . "  </a></td>";
                                                    
                                                    
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
                      
                        
                        <div class="panel-body text-justify">
                            <?php
                            
                                echo "<strong class=\"photo\" ;\"> <img src=\"../web/me/images/sam_readiness1.jpg\" alt=\"\"  height=800 width=900> </strong>";                            
                            ?>
                        </div>

                        
                         </br>
                        
                                                                          
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
        <script src="../js/form_view_sam_asset.js"></script>
        
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
                $("#view_sam_asset").DataTable({
                    responsive: true,
                    "pageLength": 100 
                });
            }); 
        </script> 
    
        <script>
            $(document).ready(function () {
                $("#view_sam_static").DataTable({
                    responsive: true,
                    "pageLength": 100 
                });
            }); 
        </script> 
        
        <script>
            $(document).ready(function () {
                $("#view_sam_asset_0").DataTable({
                    responsive: true,
                    "pageLength": 100 
                });
            }); 
        </script> 
    
    
</body>
</html>
