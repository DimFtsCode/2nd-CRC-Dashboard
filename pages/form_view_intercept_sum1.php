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
$myIndex2 = $myAsma . "DATE2";

$myDate = $_SESSION[$myIndex];
$myDate2 = $_SESSION[$myIndex2];

$myIndex3 = $myAsma . "ASMA";
$userAsma =  $_SESSION[$myIndex3];

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

        // ?>


        <title> Form View Intercept Sum </title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red;">  View Interceptions Summury </strong> </a>
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
                             <h3 class="page-header" style="color: red;"> Προβολή Συνόλου Συνεργασιών / Αναχαιτίσεων  --- από : <?php echo $myDate; ?>  --- έως : <?php echo $myDate2; ?></h3>
                        </div>                        
            </div>   
            
            <div class="form-group">
                            <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                            <div class="col-sm-4">
                                <!--<input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" style="display:none"  readonly>-->  
                                 <input type="text" id="my_asma" name="my_asma" class="form-control"   style="display:none" value="<?php echo $user->asma; ?>"  readonly   >
                                 <input type="text" id="userAsma" name="userAsma" class="form-control"  style="display:none" value="<?php echo $userAsma; ?>"  readonly   > 
                                 <input type="text" id="myDate" name="myDate" class="form-control" style="display:none" value="<?php echo $myDate; ?>"  readonly   >
                                 <input type="text" id="myDate2" name="myDate2" class="form-control" style="display:none" value="<?php echo $myDate2; ?>"  readonly   >                                 
                            </div>         
            
             
            
                            <div class="form-row">                                                           
                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Αρχική_Ημερομηνία </label>
                                    <input type="text" id="mdate" name="mdate" class="form-control date datepicker" required >
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Τελική_Ημερομηνία </label>
                                    <input type="text" id="mdate2" name="mdate2" class="form-control date datepicker" required >
                                </div>
                            </div>             
                
            <div class="panel-body">
                <div class="dataTables_wrapper">
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    require_once("../php_functions/functions.inc");
                    $class = "table";
                    
                    $headArray = array("SN", "AΣΜΑ", "ΒΑΘΜΟΣ", "ΕΙΔ", "ΕΠΙΘΕΤΟ", "ΟΝΟΜΑ", "ΤΕ", "Α-SCR", "E-30A", "E-30B", "E-31A", "E-31B", "E-32A", "E-32B", "E-33", "E-34", "E-35", "E-36A", "E-36B", "E-37A", "E-37B", "E-38", "E-39", "E-40", "E-41"  );
                    $head = count($headArray);   
                    
                    $sql = "SELECT intercept.*, personnel.* FROM intercept, personnel WHERE personnel.asma = intercept.asma AND (DATE(intercept.mdate) BETWEEN '{$myDate}' AND '{$myDate2}') ORDER BY personnel.asma ASC, mdate DESC";
                    
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    
                    $intercept = array();
                    $sumintercept = array();
                    $row = 1;
                    $srow = 1;                    
                    $serial = 1;
                    $first_entry = 1;
                    $prevAsma = "";
                    $sum1 = 0;
                    $count = 1;
                    
                    $te = 0;
                    $ascr = 0;
                    $e30a = 0;
                    $e30b = 0;
                    $e31a = 0;
                    $e31b = 0;
                    $e32 = 0;
                    $e33 = 0;
                    $e34 = 0;
                    $e35a = 0;
                    $e35b = 0;
                    $e36a = 0;
                    $e36b = 0;
                    $e37a = 0;
                    $e37b = 0;
                    $e38 = 0;
                    $e39 = 0;
                    $e40 = 0;
                    $e41 = 0;
                    $tto = 0;
                    $jez = 0;
                    
                    while ($row_intercept = mysqli_fetch_array($res)) {
                        
                      $intercept [$row] [1] = $serial;
                      $intercept [$row] [2] = $row_intercept['asma'] ;  
                      $intercept [$row] [3] = $row_intercept['rank'] ;
                      $intercept [$row] [4] = $row_intercept['splty'] ;
                      $intercept [$row] [5] = $row_intercept['sname'] ;
                      $intercept [$row] [6] = $row_intercept['fname'] ;
                      $intercept [$row] [7] = $row_intercept['numint'] ;
                      $intercept [$row] [8] = $row_intercept['intype'] ;                        
                      $intercept [$row] [9] = $row_intercept['numint2'] ;                         
                      $intercept [$row] [10] = $row_intercept['intype2'];
                        
                      $serial = $serial + 1; 
                      $row = $row + 1 ;  
                        
                    }
                    
                    for ($i = 1; $i < $row+1; $i++) {
                        
                      $inter1 = $intercept [$i] [7] ;
                      $inter2 = $intercept [$i] [9] ;
                      $Checkintype1 = $intercept [$i] [8] ;
                      $Checkintype2 = $intercept [$i] [10] ;
                         
                        if (!($intercept [$i] [2] == $intercept [$i+1] [2]  )) {
                                                        
                        switch ($Checkintype1) {
                            case "TE" :
                                $te = $te + $inter1;
                                break;
                            case "A-SCR" :
                                $ascr = $ascr + $inter1;
                                break;
                            case "E-30A" :
                                $e30a = $e30a + $inter1;
                                break;
                            case "E-30B" :
                                $e30b = $e30b + $inter1;
                                break;
                            case "E-31A" :
                                $e31a = $e31a + $inter1;
                                break;
                            case "E-31B" :
                                $e31b = $e31b + $inter1;
                                break;
                            case "E-32" :
                                $e32 = $e32 + $inter1;
                                break;
                            case "E-33" :
                                $e33 = $e33 + $inter1;
                                break;
                            case "E-34" :
                                $e34 = $e34 + $inter1;
                                break;
                            case "E-35A" :
                                $e35a = $e35a + $inter1;
                                break;
                            case "E-35B" :
                                $e35b = $e35b + $inter1;
                                break;
                            case "E-36A" :
                                $e36a = $e36a + $inter1;
                                break;
                            case "E-36B" :
                                $e36b = $e36b + $inter1;
                                break;
                            case "E-37A" :
                                $e37a = $e37a + $inter1;
                                break;
                            case "E-37B" :
                                $e37b = $e37b + $inter1;
                                break;
                            case "E-38" :
                                $e38 = $e38 + $inter1;
                                break;
                            case "E-39" :
                                $e39 = $e39 + $inter1;
                                break;
                            case "E-40" :
                                $e40 = $e40 + $inter1;
                                break;
                            case "E-41" :
                                $e41 = $e41 + $inter1;
                                break;
                            case "TTO" :
                                $tto = $tto + $inter1;
                                break;
                            case "JEZ" :
                                $jez = $jez + $inter1;
                                break;
                        }
                        
                        
                        switch ($Checkintype2) {
                            case "TE" :
                                $te = $te + $inter2;
                                break;
                            case "A-SCR" :
                                $ascr = $ascr + $inter2;
                                break;
                            case "E-30A" :
                                $e30a = $e30a + $inter2;
                                break;
                            case "E-30B" :
                                $e30b = $e30b + $inter2;
                                break;
                            case "E-31A" :
                                $e31a = $e31a + $inter2;
                                break;
                            case "E-31B" :
                                $e31b = $e31b + $inter2;
                                break;
                            case "E-32" :
                                $e32 = $e32 + $inter2;
                                break;
                            case "E-33" :
                                $e33 = $e33 + $inter2;
                                break;
                            case "E-34" :
                                $e34 = $e34 + $inter2;
                                break;
                            case "E-35A" :
                                $e35a = $e35a + $inter2;
                                break;
                            case "E-35B" :
                                $e35b = $e35b + $inter2;
                                break;
                            case "E-36A" :
                                $e36a = $e36a + $inter2;
                                break;
                            case "E-36B" :
                                $e36b = $e36b + $inter2;
                                break;
                            case "E-37A" :
                                $e37a = $e37a + $inter2;
                                break;
                            case "E-37B" :
                                $e37b = $e37b + $inter2;
                                break;
                            case "E-38" :
                                $e38 = $e38 + $inter2;
                                break;
                            case "E-39" :
                                $e39 = $e39 + $inter2;
                                break;
                            case "E-40" :
                                $e40 = $e40 + $inter2;
                                break;
                            case "E-41" :
                                $e41 = $e41 + $inter2;
                                break;
                            case "TTO" :
                                $tto = $tto + $inter2;
                                break;
                            case "JEZ" :
                                $jez = $jez + $inter2;
                                break;
                        }
                                                                        
                            $intersum1 = $intersum1 + $intercept [$i] [7] ;
                            
                            $sumintercept [$srow] [1] = $count ;
                            $sumintercept [$srow] [2] = $intercept [$i] [2] ;
                            $sumintercept [$srow] [3] = $intercept [$i] [3] ;
                            $sumintercept [$srow] [4] = $intercept [$i] [4] ;
                            $sumintercept [$srow] [5] = $intercept [$i] [5] ;
                            $sumintercept [$srow] [6] = $intercept [$i] [6] ;
                            
                            $sumintercept [$srow] [7] = $te;                            
                            $sumintercept [$srow] [8] = $ascr;                            
                            $sumintercept [$srow] [9] = $e30a;
                            $sumintercept [$srow] [10] = $e30b;
                            $sumintercept [$srow] [11] = $e31a;
                            $sumintercept [$srow] [12] = $e31b;                            
                            $sumintercept [$srow] [13] = $e32;                            
                            $sumintercept [$srow] [14] = $e33;                            
                            $sumintercept [$srow] [15] = $e34;
                            $sumintercept [$srow] [16] = $e35a;
                            $sumintercept [$srow] [17] = $e35b;
                            $sumintercept [$srow] [18] = $e36a;
                            $sumintercept [$srow] [19] = $e36b;
                            $sumintercept [$srow] [20] = $e37a;
                            $sumintercept [$srow] [21] = $e37b;
                            $sumintercept [$srow] [22] = $e38;                            
                            $sumintercept [$srow] [23] = $e39;
                            $sumintercept [$srow] [24] = $e40;
                            $sumintercept [$srow] [25] = $e41;
                            $sumintercept [$srow] [26] = $tto;
                            $sumintercept [$srow] [27] = $jez;                            
                            
                            $srow = $srow + 1 ;
                            $count = $count + 1 ;
                            $intersum1 = 0 ;   
                            $te = 0;
                            $ascr = 0;
                            $e30a = 0;
                            $e30b = 0;
                            $e31a = 0;
                            $e31b = 0;
                            $e32 = 0;
                            $e33 = 0;
                            $e34 = 0;
                            $e35a = 0;
                            $e35b = 0;
                            $e36a = 0;
                            $e36b = 0;
                            $e37a = 0;
                            $e37b = 0;
                            $e38 = 0;
                            $e39 = 0;
                            $e40 = 0;
                            $e41 = 0;
                            $tto = 0;
                            $jez = 0;                            
                            
                        } else {
                            
                        $intersum1 = $intersum1 + $intercept [$i] [7] ;
                             
                        switch ($Checkintype1) {
                            case "TE" :
                                $te = $te + $inter1;
                                break;
                            case "A-SCR" :
                                $ascr = $ascr + $inter1;
                                break;
                            case "E-30A" :
                                $e30a = $e30a + $inter1;
                                break;
                            case "E-30B" :
                                $e30b = $e30b + $inter1;
                                break;
                            case "E-31A" :
                                $e31a = $e31a + $inter1;
                                break;
                            case "E-31B" :
                                $e31b = $e31b + $inter1;
                                break;
                            case "E-32" :
                                $e32 = $e32 + $inter1;
                                break;
                            case "E-33" :
                                $e33 = $e33 + $inter1;
                                break;
                            case "E-34" :
                                $e34 = $e34 + $inter1;
                                break;
                            case "E-35A" :
                                $e35a = $e35a + $inter1;
                                break;
                            case "E-35B" :
                                $e35b = $e35b + $inter1;
                                break;
                            case "E-36A" :
                                $e36a = $e36a + $inter1;
                                break;
                            case "E-36B" :
                                $e36b = $e36b + $inter1;
                                break;
                            case "E-37A" :
                                $e37a = $e37a + $inter1;
                                break;
                            case "E-37B" :
                                $e37b = $e37b + $inter1;
                                break;
                            case "E-38" :
                                $e38 = $e38 + $inter1;
                                break;
                            case "E-39" :
                                $e39 = $e39 + $inter1;
                                break;
                            case "E-40" :
                                $e40 = $e40 + $inter1;
                                break;
                            case "E-41" :
                                $e41 = $e41 + $inter1;
                                break;
                            case "TTO" :
                                $tto = $tto + $inter1;
                                break;
                            case "JEZ" :
                                $jez = $jez + $inter1;
                                break;
                            } 
                            
                            switch ($Checkintype2) {
                            case "TE" :
                                $te = $te + $inter2;
                                break;
                            case "A-SCR" :
                                $ascr = $ascr + $inter2;
                                break;
                            case "E-30A" :
                                $e30a = $e30a + $inter2;
                                break;
                            case "E-30B" :
                                $e30b = $e30b + $inter2;
                                break;
                            case "E-31A" :
                                $e31a = $e31a + $inter2;
                                break;
                            case "E-31B" :
                                $e31b = $e31b + $inter2;
                                break;
                            case "E-32" :
                                $e32 = $e32 + $inter2;
                                break;
                            case "E-33" :
                                $e33 = $e33 + $inter2;
                                break;
                            case "E-34" :
                                $e34 = $e34 + $inter2;
                                break;
                            case "E-35A" :
                                $e35a = $e35a + $inter2;
                                break;
                            case "E-35B" :
                                $e35b = $e35b + $inter2;
                                break;
                            case "E-36A" :
                                $e36a = $e36a + $inter2;
                                break;
                            case "E-36B" :
                                $e36b = $e36b + $inter2;
                                break;
                            case "E-37A" :
                                $e37a = $e37a + $inter2;
                                break;
                            case "E-37B" :
                                $e37b = $e37b + $inter2;
                                break;
                            case "E-38" :
                                $e38 = $e38 + $inter2;
                                break;
                            case "E-39" :
                                $e39 = $e39 + $inter2;
                                break;
                            case "E-40" :
                                $e40 = $e40 + $inter2;
                                break;
                            case "E-41" :
                                $e41 = $e41 + $inter2;
                                break;
                            case "TTO" :
                                $tto = $tto + $inter2;
                                break;
                            case "JEZ" :
                                $jez = $jez + $inter2;
                                break;
                            }                                             
                            
                          }                                                                            
                    }
                                                                                
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"intercept\">";
                    
                    echo "<thead>";
                    echo "<tr>";
                    for ($i = 0; $i < $head; $i++) {
                        echo "<th>" . $headArray[$i] . "</th>";
                    }
                    echo "</tr>";
                    echo "</thead>";

                    echo "<tbody>";
                    
                    for ($rec = 1; $rec < $srow+1; $rec++) {
                        
                        echo "<tr>";
                                                
                        echo "<td>" . $sumintercept [$rec] [1] . "</td>";
                        echo "<td class=\"asma\" > <a href=\"./form_view_intercept_by_asma.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $sumintercept [$rec] [2] . "</strong>". " </a> </td>";
                        
                        echo "<td>" . $sumintercept [$rec] [3] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [4] . "</td>";
                        
                        echo "<td class=\"sname\">" . $sumintercept [$rec] [5] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [6] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [7] . "</td>";                       
                        
                        echo "<td>" . $sumintercept [$rec] [8] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [9] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [10] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [11] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [12] . "</td>";                        
                        echo "<td>" . $sumintercept [$rec] [13] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [14] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [15] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [16] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [17] . "</td>";                        
                        echo "<td>" . $sumintercept [$rec] [18] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [19] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [20] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [21] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [22] . "</td>";                        
                        echo "<td>" . $sumintercept [$rec] [23] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [24] . "</td>";
                        echo "<td>" . $sumintercept [$rec] [25] . "</td>";
                        //echo "<td>" . $sumintercept [$rec] [26] . "</td>";
                        //echo "<td>" . $sumintercept [$rec] [27] . "</td>";
                        
                        
                                                
                        echo "</tr>";
                        
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

        <script type="text/javascript" src="../js/form_view_intercept_sum1.js"></script>  
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


