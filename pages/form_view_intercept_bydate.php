<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}


if (!($user->role == "SYS" || $user->role2 == "TRAIN+" || $user->role == "CMD" || $user->role3 == "TRAIN" || $user->role3 == "MC")) { 
     die(header("Location: dashboard.php"));
 }

$myAsma = $user->asma;
$myIndex = $myAsma . "DATE";

$myDate = $_SESSION[$myIndex];

$myIndex2 = $myAsma . "ASMA";
//$myUser = $_SESSION[$myIndex2];
$userAsma =  $_SESSION[$myIndex2];

?>

<!DOCTYPE html>
<html lang="en">   

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        //<?php

        // ?>

        <title> Form View Intercept by Date </title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red;">  View Interceptions  by Date </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>    
<!--                    <a class="navbar-brand" href="./form_view_personnel_all.php"> <strong style="color: darkred; ">  Προβολή Συνόλου ΠΡΣ </strong> </a>  -->
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>                                

            </nav>
            

           <div class="panel-heading text-center">
                        <div class="col-lg-12">                            
                             <h1 class="page-header" style="color: blue;"> Προβολή Συνεργασιών / Αναχαιτίσεων / Ασκήσεων  --- <?php echo date("j - m - Y"); ?> </h1>
                        </div>                        
            </div>     
            
            <div class="panel-heading text-center">
                        <div class="col-lg-12">                            
                             <h3 class="page-header" style="color: red;"> Προβολή Συνεργασιών / Αναχαιτίσεων σε συγκεκριμένη Ημέρα --- στις : <?php echo $myDate; ?>  </h3>
                        </div>                        
            </div>   
            
            <div class="form-group">
                            <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                            <div class="col-sm-4">
                                <!--<input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" style="display:none"  readonly>-->  
                                 <input type="text" id="my_asma" name="my_asma" class="form-control"   style="display:none" value="<?php echo $user->asma; ?>"  readonly   >
                                 <input type="text" id="userAsma" name="userAsma" class="form-control"  style="display:none" value="<?php echo $userAsma; ?>"  readonly   >                                 
                            </div>         
            
             
            
            <div class="form-group">                                                             
                <label class="col-sm-2 control-label" style="color: red" > Date of Interest  : </label>
                <div  class="input-group date col-sm-2" >
                    <input type="text" id="mdate" name="mdate" class="form-control date datepicker" required >
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>             
                
            <div class="panel-body">
                <div class="dataTables_wrapper">
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    require_once("../php_functions/functions.inc");
                    $class = "table";
                    //$myDate = "2022-12-20";
                    $headArray = array("SN", "AΣΜΑ", "ΟΝΟΜΑ", "ID", "ΚΑΤΗΓΟΡΙΑ", "CALL SIGN", "ΑΡ. Α/Φ" , "ΤΥΠΟΣ Α/Φ" , "ΜΟΙΡΑ", "ΠΕΡΙΟΧΗ", "FREQ", "RADIO", "AJ", "NET", "CRYPTO", "Reason A/J", "Reason KΡIKO" );
                    $head = count($headArray);   
                    
                    $sql = "SELECT intercept.*, personnel.* FROM intercept, personnel WHERE personnel.asma=intercept.asma AND intercept.mdate='{$myDate}' ";
                    //$sql = "SELECT intercept.* FROM intercept WHERE intercept.mdate='{$myDate}' ";
                    //$sql = "SELECT intercept.*, personnel.* FROM intercept, personnel WHERE personnel.asma = intercept.asma AND (DATE(intercept.mdate) BETWEEN '{$myDate}' AND '{$myDate2}') ORDER BY mdate DESC";
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    $serial = 1;
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"intercept\">";
                    //echo "<caption class=\"text-center \">Προβολή Προσωπικού</caption>";
                    echo "<thead>";
                    echo "<tr>";
                    for ($i = 0; $i < $head; $i++) {
                        echo "<th>" . $headArray[$i] . "</th>";
                    }
                    echo "</tr>";
                    echo "</thead>";

                    echo "<tbody>";
                    while ($row = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td class=\"serial\">" . $serial . "</td>";
                                                                    
                        $myfcs = $row['fcs1'];
                        if (strlen($row['fcs2']) > 1) {
                             $myfcs = $myfcs . ", " . $row['fcs2'];
                        } else {
                            $myfcs = $myfcs;
                        }
                        
                        if (strlen($row['fcs3']) > 1) {
                             $myfcs = $myfcs . ", " . $row['fcs3'];
                        } else {
                            $myfcs = $myfcs;
                        }
                        
                        if (strlen($row['fcs4']) > 1) {
                             $myfcs = $myfcs . ", " . $row['fcs4'];
                        } else {
                            $myfcs = $myfcs;
                        }
                        
                        echo "<td class=\"asma\" > <a href=\"form_view_intercept_by_asma.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['asma'] . "</strong>". " </a> </td>";
                        echo "<td>" . $row['sname'] . "</td>";
                        echo "<td class=\"int_id\" > <a href=\"form_view_intercept_detail.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['int_id'] . "</strong>". " </a> </td>"; 
                        echo "<td class=\"cotype\">" . $row['cotype'] . "</td>";                        
                                                                       
                        echo "<td>" . $myfcs . "</td>";
                        echo "<td>" . $row['numf1'] . "</td>";                          
                        echo "<td >" . $row['typef1'] . "</td>";                        
                        echo "<td >" . $row['sq1'] . "</td>";
                        
                        echo "<td >" . $row['area'] . "</td>";
                        echo "<td >" . $row['freq'] . "</td>";
                        echo "<td >" . $row['radio'] . "</td>";
                        
                        echo "<td >" . $row['aj'] . "</td>";
                        echo "<td >" . $row['ajnet'] . "</td>";
                        echo "<td >" . $row['crypto'] . "</td>";
                        echo "<td >" . $row['reason'] . "</td>";
                        echo "<td >" . $row['reason2'] . "</td>";
                        
                        //echo "<td class=\"del_id\" > <a href=\"\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['int_id'] . "</strong>". " </a> </td>";
                        //echo "<td class=\"del_id\" > <a href=\"form_delete_intercept_asma.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['int_id'] . "</strong>". " </a> </td>";
                      
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

        <script type="text/javascript" src="../js/form_view_intercept_bydate.js"></script>  
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#intercept").DataTable({
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


