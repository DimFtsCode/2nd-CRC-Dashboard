<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}


if (!($user->role == "SYS" || $user->role == "CMD")) { 
     die(header("Location: dashboard.php"));
 }

$myAsma = $user->asma;

$myIndex1 = $myAsma . "ASMA";
$userAsma =  $_SESSION[$myIndex1];

?>

<!DOCTYPE html>
<html lang="en">   

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv= "Expires" content="Mon, 26 Jul 1997 05:00:00 GMT">
        <meta http-equiv= "Pragma" content="no-cache">

        <title> Form View Main Tasks </title> 
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">


        <!--        <link rel="stylesheet" type="text/css"  href="../styles/form_view_sensor.css">-->

        <!-- Morris Charts CSS -->
        <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <!--  -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" >

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> <strong style="color: red;">  View Sum of Main Tasks </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>
                    <a class="navbar-brand" href="./form_add_task.php"> <strong style="background-color: yellow; color: darkred; "> Εισαγωγή Κύριας Εργασίας </strong> </a>
                    <a class="navbar-brand" href="./admin_dashboard.php"> <strong style="color: darkred; "> Admin </strong> </a> 
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>                                

            </nav>
            

           <div class="panel-heading text-center">
                        <div class="col-lg-12">                            
                             <h1 class="page-header" style="color: blue;"> Προβολή Τρέχοντων Εργασιών --- <?php echo date("j - m - Y"); ?> </h1>
                        </div>                        
            </div>                    
            
            <div class="form-group">
                            <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                            <div class="col-sm-4">
                                <!--<input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" style="display:none"  readonly>-->  
                                 <input type="text" id="my_asma" name="my_asma" class="form-control"   style="display:none" value="<?php echo $user->asma; ?>"  readonly   >
                                 <input type="text" id="userAsma" name="userAsma" class="form-control"  style="display:none" value="<?php echo $userAsma; ?>"  readonly   >                                  
                            </div>         
                            
                
            <div class="panel-body">
                <div class="dataTables_wrapper">
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    require_once("../php_functions/functions.inc");
                    $class = "table";
                    $MyOwner = $user->asma;
                    $Finished = "No";
                    
                    $headArray = array("SN", "ID", "ΤΟΜΕΑΣ", "ΘΕΜΑ / ΠΕΡΙΓΡΑΦΗ", "ΕΝΑΡΞΗ.", "ΠΕΡΑΣ", "OWNER", "SHARE#1", "SHARE#2", "ASSIGN#1", "ASSIGN#2", "DETAIL" );
                    $head = count($headArray);   
                    
                    $sql = "SELECT * FROM taskmain WHERE (owner = '{$MyOwner}' OR share1 ='{$MyOwner}' OR share2 ='{$MyOwner}') AND complete='{$Finished}' ORDER BY date_start DESC ";                    
                    
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    $serial = 1;
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"majortable\">";
                    
                    echo "<thead>";
                    echo "<tr>";
                    for ($i = 0; $i < $head; $i++) {
                        echo "<th>" . $headArray[$i] . "</th>";
                    }
                    echo "</tr>";
                    echo "</thead>";

                    echo "<tbody>";                                        
                    
                    while ($row = mysqli_fetch_array($res)) {
                        $owner = $row['owner'];
                        echo "<tr>";
                        echo "<td class=\"serial\">" . $serial . "</td>";
                                                                        
                        if ($owner == $user->asma ) {                                           
                           echo "<td class=\"taskid\" > <a href=\"./form_edit_task.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['taskid'] . "</strong>". " </a> </td>";                  
                        } else {
                           echo "<td class=\"taskid\" > <a href=\"#\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['taskid'] . "</strong>". " </a> </td>";     
                        }
                                               
                        echo "<td>" . $row['scope'] . "</td>";                                             
                        echo "<td class=\"subject\">" . $row['subject'] . "</td>";                                                                                                 
                        echo "<td>" . $row['date_start'] . "</td>";                          
                        echo "<td >" . $row['date_exp'] . "</td>";  
                        
                        //echo "<td class=\"owner\">" . $row['owner'] . "</td>";
                        echo "<td class=\"owner\" id=\"owner\"> <a data-toggle=\"modal\" data-target=\"#displayUser\" >" . $row['owner'] . "  </a></td>";
                        echo "<td class=\"share1\" id=\"share1\"> <a data-toggle=\"modal\" data-target=\"#displayUser\" >" . $row['share1'] . "  </a></td>";                       
                        echo "<td class=\"share2\" id=\"share2\"> <a data-toggle=\"modal\" data-target=\"#displayUser\" >" . $row['share2'] . "  </a></td>";
                        
                        echo "<td class=\"assign1\" id=\"assign1\"> <a data-toggle=\"modal\" data-target=\"#displayUser\" >" . $row['assign1'] . "  </a></td>";
                        echo "<td class=\"assign2\" id=\"assign2\"> <a data-toggle=\"modal\" data-target=\"#displayUser\" >" . $row['assign2'] . "  </a></td>";
                        //echo "<td >" . $row['assign2'] . "</td>";
                        
                        echo "<td class=\"detail\" > <a href=\"./form_view_job_detail.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['taskid'] . "</strong>". " </a> </td>"; 
                        
                       
                        echo "</tr>";
                        $serial = $serial + 1;
                    }


                    echo "</tbody>";
                                      

                    echo "</table>";


                    //table($class, $headArray, $res);
                    ?>
                </div>
            </div>

        
            
        </div>
        <!-- /#wrapper -->
        
        
        
        
        
        
                <!-- Modal Find User Information !! -->
        <?php
        $myVar = $user->asma . "ASMA";
        $MyAsma = $_SESSION[$myVar];
        //$MyAsma = $_SESSION['MyUser'][0];
        $sql_update_user = "SELECT * FROM personnel WHERE asma ='{$MyAsma}' ";
        $db2 = new DbMgmt;
        $qry_update_user = $db2->runQuery($sql_update_user);  
        $row_update = mysqli_fetch_array($qry_update_user);
        
        //$MyAsma =0;
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
            //$_SESSION[$myVar] = "";            
            echo "</div>";
            //Modal Body
            echo "</div>";
            echo "<div class=\"modal-footer\">";
            echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";           
            
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

        <script type="text/javascript" src="../js/form_view_task_main.js"></script>  
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#majortable").DataTable({
                    responsive: true,
                    "pageLength": 200
                });
            });
        </script>
        
         
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


