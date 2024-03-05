<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD")) { 
     die(header("Location: dashboard.php"));    
} 

$myIndex = $user->asma . "XID";                      
$myDivID = $_SESSION[$myIndex];
$myIndex2 = $user->asma . "DIV";   
$myDivision = $_SESSION[$myIndex2];
$myUnit = MyUNIT; 

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
                            <h1 class="page-header" style="color: red;"> Προβολή Συνόλου Αδειών Προσωπικού Τρέχοντος 'Ετους / Επιστασία --- <?php  echo  "<strong style=\"color: black; font-size: 40px; background-color: yellow;\">" .  $myDivision . "</strong>"; ?>  ---- <?php echo date("j - m - Y"); ?> </h1>
                        </div>
                        <!-- /.col-lg-12 -->
             </div> 
            
            <div class="col-sm-2">
                <input type="text" id="my_asma" name="my_asma" class="form-control"  style="display:none" value="<?php echo $user->asma; ?>"  readonly   >                  
                <span class="errorFeedback errorSpan" id="asmaError">ΑΣΜΑ should be only numbers</span> 
            </div>
            
            <div class="panel-heading text-center">                
                                <strong class="form-group">
                                <label class="col-sm-2 control-label" style="color: red" >Διεύθυνση / Μοίρα : </label>  
                                <div class="col-sm-2">

                                    <select class="form-control"  id="directorate"  name="directorate" required >
                                        <option value="" selected disabled> directorate </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `divisions` ORDER BY `id` ";
                                        $div = $db->runQuery($sql);
                                        while ($row_div = mysqli_fetch_array($div)) {
                                            echo "<option value=\"" . $row_div['id'] . "\">" . $row_div['description'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>   
                                </div>                                
                            </strong>                             
                
            </div>
            
            <div class="form-group">
                                <label class="col-sm-2 control-label"> Number of Days : </label>
                                <div class="col-sm-2">                                    
                                    <select class="form-control" id="numofdays" name="numofdays" required="numofdays">
                                      <?php
                                        for ($arx = 1; $arx < 31; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                        
                                    </select>                                          
                                </div>
                                <span class="input-group-btn"><button class="btn btn-outline-secondary" type="button" id="btn_calc" name ="btn_calc">Calculate</button></span>
            </div>
            
            
            <div class="panel-body">
                <div class="dataTables_wrapper">  
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    $class = "table";
                    $headArray = array("SN", "ΑΣΜΑ", "Βαθμός", "Ειδ.", "Επιθετο", "Ονομα", "Επιστασία", "ΚΑΝΟΝΙΚΗ", "ΜΙΚΡΑΣ", "ΑΝΑΡΡΩΤΙΚΗ");                    
                    $head = count($headArray);
                    //$myUnit = MyUNIT;
                    $Mydate = "2000-01-01";
                    $efyear = date('Y');
                    
                    $sql = "SELECT personnel.*, divisions.description, ranks.*, leaves.* FROM personnel, divisions, ranks, leaves WHERE personnel.division = divisions.id AND ranks.rank=personnel.rank AND leaves.asma = personnel.asma AND personnel.unit ='{$myUnit}' AND personnel.division='{$myDivID}' AND leaves.efyear ='{$efyear}' ORDER BY ranks.priority ASC, personnel.asma ASC, leaves.start_date DESC "; 
                    //$sql = "SELECT personnel.*, divisions.description, ranks.*, leaves.* FROM personnel, divisions, ranks, leaves WHERE personnel.division = divisions.id AND ranks.rank=personnel.rank AND leaves.asma = personnel.asma AND personnel.unit ='{$myUnit}' AND leaves.efyear ='{$efyear}' ORDER BY ranks.priority ASC, personnel.asma ASC, leaves.start_date DESC "; 
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    
                    $leaves = array();
                    $sumleaves = array();
                    $row = 1;
                    $srow = 1;
                    $serial = 1;
                    $first_entry = 1;
                    $prevAsma =  "";
                    $sum1 = 0;
                    $count = 1;
                    
                    $c10 = 0;
                    $c11 = 0;
                    $c12 = 0;
                    $c13 = 0;
                    $c14 = 0;
                    $c15 = 0;
                    $c17 = 0;
                    $c19 = 0;
                    $c21 = 0;

                    while ($row_personnel = mysqli_fetch_array($res)) {
                                                
                        $leaves [$row] [1] = $serial;
                        $leaves [$row] [2] = $row_personnel['asma'] ;  
                        $leaves [$row] [3] = $row_personnel['rank'] ;
                        $leaves [$row] [4] = $row_personnel['splty'] ;
                        $leaves [$row] [5] = $row_personnel['sname'] ;
                        $leaves [$row] [6] = $row_personnel['fname'] ;
                        $leaves [$row] [7] = $row_personnel['description'] ;
                        $leaves [$row] [8] = $row_personnel['num_days'] ;                        
                        $leaves [$row] [9] = $row_personnel['leave_type'] ;                         
                        $leaves [$row] [10] = $row_personnel['start_date'];
                        
                        $serial = $serial + 1; 
                        $row = $row + 1 ;
                        
                    }
                                        
                    
                     for ($i = 1; $i < $row+1; $i++) {
                            
                         $Days = $leaves [$i] [8] ;
                         $CheckIDLeave = $leaves [$i] [9] ;
                         
                        if (!($leaves [$i] [2] == $leaves [$i+1] [2]  )) {
                                                        
                        switch ($CheckIDLeave) {
                            case 10 :
                                $c10 = $c10 + $Days;
                                break;
                            case 11 :
                                $c11 = $c11 + $Days;
                                break;
                            case 14 :
                                $c12 = $c12 + $Days;
                                break;
                            case 13 :
                                $c13 = $c13 + $Days;
                                break;
                        }

                            $sum1 = $sum1 + $leaves [$i] [8] ;
                            
                            $sumleaves [$srow] [1] = $count ;
                            $sumleaves [$srow] [2] = $leaves [$i] [2] ;
                            $sumleaves [$srow] [3] = $leaves [$i] [3] ;
                            $sumleaves [$srow] [4] = $leaves [$i] [4] ;
                            $sumleaves [$srow] [5] = $leaves [$i] [5] ;
                            $sumleaves [$srow] [6] = $leaves [$i] [6] ;
                            $sumleaves [$srow] [7] = $leaves [$i] [7] ;                            
                            $sumleaves [$srow] [8] = $c10  ;
                            
                            $sumleaves [$srow] [9] = $c11 ;
                            $sumleaves [$srow] [10] = $c12 ;
                            
                            $srow = $srow + 1 ;
                            $count = $count + 1 ;
                            $sum1  = 0 ;   
                            $c10 = 0 ;
                            $c11 = 0 ;
                            $c12 = 0 ;
                            $c13 = 0 ;
                            
                        } else {
                            
                             $sum1 = $sum1 + $leaves [$i] [8] ;
                             
                        switch ($CheckIDLeave) {
                            case 10 :
                                $c10 = $c10 + $Days;
                                break;
                            case 11 :
                                $c11 = $c11 + $Days;
                                break;
                            case 14 :
                                $c12 = $c12 + $Days;
                                break;
                            case 13 :
                                $c13 = $c13 + $Days;
                                break;
                        }
                            
                          }                         
                         
                      }
                    
                                                                                                                                                                                                                            
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"personnel\">";
                    //echo "<caption class=\"text-center \">Προβολή Προσωπικού</caption>";
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
                                                
                        echo "<td>" . $sumleaves [$rec] [1] . "</td>";
                        echo "<td class=\"asma\" > <a href=\"./form_personnel_detail_info.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $sumleaves [$rec] [2] . "</strong>". " </a> </td>";
                        
                        echo "<td>" . $sumleaves [$rec] [3] . "</td>";
                        echo "<td>" . $sumleaves [$rec] [4] . "</td>";
                        //echo "<td>" . $sumleaves [$rec] [5] . "</td>";
                        echo "<td class=\"sname\">" . $sumleaves [$rec] [5] . "</td>";
                        echo "<td>" . $sumleaves [$rec] [6] . "</td>";
                        echo "<td>" . $sumleaves [$rec] [7] . "</td>";                       
                        //echo "<td>" . $sumleaves [$rec] [8] . "</td>";
                        echo "<td class=\"leave1\">" . $sumleaves [$rec] [8] . "</td>";
                        echo "<td>" . $sumleaves [$rec] [9] . "</td>";
                        echo "<td>" . $sumleaves [$rec] [10] . "</td>";
                        
                        //echo "<td>" . $efyear . "</td>";
                                                
                        echo "</tr>";
                        
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






