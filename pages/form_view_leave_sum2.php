<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "CMD+")) { 
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
        //echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_sensor.css?v=" . rand() . "\">" );
        ?>

        <title> Form View Sum of Personnel Leaves</title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; ">   View Sum of  Leaves</strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>   
                    <a class="navbar-brand" href="./form_view_personnel_all.php"> <strong style="color: darkred; ">  Προβολή Συνόλου ΠΡΣ </strong> </a> 
                    <a class="navbar-brand" href="./admin_dashboard.php"> <strong style="color: blue; ">  Admin   </strong> </a> 
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>

            </nav>

            <div class="panel-heading text-center">
                        <div class="col-lg-12">
                            <h1 class="page-header" style="color: red;"> Προβολή Συνόλου Αδειών Προσωπικού --- <?php echo date("j - m - Y"); ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
             </div> 
            
            <div class="col-sm-2">
                <input type="text" id="my_asma" name="my_asma" class="form-control"  style="display:none" value="<?php echo $user->asma; ?>"  readonly   >                  
                <span class="errorFeedback errorSpan" id="asmaError">ΑΣΜΑ should be only numbers</span> 
            </div>
            
            <div class="panel-body">
                <div class="dataTables_wrapper">
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    $class = "table";
                    $headArray = array("SN", "ΑΣΜΑ", "Βαθμός", "Ειδ.", "Επιθετο", "Ονομα", "Επιστασία", "ΗΜΕΡΕΣ", "ΕΙΔΟΣ", "ΕΝΑΡΞΗ");                    
                    $head = count($headArray);
                    $myUnit = MyUNIT;
                    $Mydate = "2000-01-01";
                    
                    $sql = "SELECT personnel.*, divisions.description AS My_DIV, ranks.*, leaves.* FROM personnel, divisions, ranks, leaves WHERE personnel.division = divisions.id AND ranks.rank=personnel.rank AND leaves.asma = personnel.asma AND personnel.unit ='{$myUnit}'  ORDER BY ranks.priority ASC, personnel.asma ASC, leaves.start_date DESC ";                    
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    $serial = 1;
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"personnel\">";
                    //echo "<caption class=\"text-center \">Προβολή Προσωπικού</caption>";
                    echo "<thead>";
                    echo "<tr>";
                    for ($i = 0; $i < $head; $i++) {
                        echo "<th>" . $headArray[$i] . "</th>";
                    }
                    echo "</tr>";
                    echo "</thead>";
                    $leaves = array();
                    $row = 1;
                    $col = 1;
                                                     
                    echo "<tbody>";
                    while ($row_personnel = mysqli_fetch_array($res)) {
                                                    
                        echo "<tr>";
                        //echo "<td class=\"serial\">" . $serial . "</td>";
                        $leaves [$row] [1] = $serial;
                        echo "<td class=\"serial\">" . $leaves [$row] [1]  . "</td>";
                                                                                               
                        echo "<td class=\"asma\" > <a href=\"./form_personnel_detail_info.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row_personnel['asma'] . "</strong>". " </a> </td>";
                        $leaves [$row] [2] = $row_personnel['asma'] ;                        
                        echo "<td>" . $row_personnel['rank'] . "</td>";
                        $leaves [$row] [3] = $row_personnel['rank'] ;  
                        echo "<td>" . $row_personnel['splty'] . "</td>";
                        $leaves [$row] [4] = $row_personnel['splty'] ;  
                        
                        //echo "<td>" . $row_personnel['sname'] . "</td>";                        
                        $leaves [$row] [5] = $row_personnel['sname'] ;    
                        echo "<td>" . $leaves [$row] [5] . "</td>";  
                        
                        echo "<td>" . $row_personnel['fname'] . "</td>";
                        $leaves [$row] [6] = $row_personnel['fname'] ;  
                        echo "<td>" . $row_personnel['My_DIV'] . "</td>";
                        $leaves [$row] [7] = $row_personnel['MyDiv'] ;  
                        echo "<td>" . $row_personnel['num_days'] . "</td>";
                        $leaves [$row] [8] = $row_personnel['num_days'] ;  
                        echo "<td>" . $row_personnel['leave_type'] . "</td>";
                        $leaves [$row] [9] = $row_personnel['leave_type'] ;  
                        echo "<td>" . $row_personnel['start_date'] . "</td>";
                        $leaves [$row] [10] = $row_personnel['start_date'] ;  
                        
                        echo "</tr>";
                        
                        $serial = $serial + 1; 
                        $row = $row + 1 ;
                    } 
                                                            
                    echo "</tbody>";

                    echo "</table>";
                    
                    ?>
                </div>
            </div>

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

        <script type="text/javascript" src="../js/form_view_leave_sum1.js"></script>
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#personnel").DataTable({
                    responsive: true,
                    "pageLength": 200
                });
            });
        </script>


    </body>
</html>






