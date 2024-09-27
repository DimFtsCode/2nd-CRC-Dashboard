<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}


if (!($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD")) { 
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

        <title> Form View Current Event  </title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red;">  View Current Events  </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>    
                    <a class="navbar-brand" href="./admin_dashboard.php"> <strong style="color: darkred; ">  Admin </strong> </a>
                    <a class="navbar-brand" href="./form_view_event_bydate.php"> <strong style="color: blue; ">  Μεταβολές By Date   </strong> </a> 
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>                                

            </nav>
            

           <div class="panel-heading text-center">
                        <div class="col-lg-12">                            
                             <h1 class="page-header" style="color: blue;"> Προβολή Τρέχουσων Μεταβολών  Προσωπικού  --- <?php echo date("j - m - Y"); ?> </h1>
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
            
             
            
                
            <div class="panel-body">
                <div class="dataTables_wrapper">
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    require_once("../php_functions/functions.inc");
                    $class = "table";
                    $myUnit = MyUNIT;
                    $myDate3 = date('Y-m-d');
                    $headArray = array("SN", "ID", "EDIT", "ΒΑΘΜΟΣ", "ΕΙΔ", "ΕΠΙΘΕΤΟ", "ΟΝΟΜΑ", "EΠΙΣΤΑΣΙΑ", "ΕΝΑΡΞΗ", "ΠΕΡΑΣ", "ΚΑΤΗΓΟΡΙΑ", "ΠΕΡΙΓΡΑΦΗ", "ΘΕΣΜ. ΚΕΙΜΕΝΟ", "Reg_User", "DEL" );
                    $head = count($headArray);   
                    
                    
                    $sql = "SELECT event.*, event.user_reg as MyUserReg, personnel.* FROM event, personnel WHERE personnel.asma = event.asma AND personnel.unit ='{$myUnit}' AND (DATE '{$myDate3}' >= (event.date_start)) AND (DATE(event.date_end) >= '{$myDate3}') ORDER BY date_start DESC";
                    
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
                        
                        $My_DIV = $row['division'];
                        $My_Division = "";

                        switch ($My_DIV) {
                            case 10 :
                                $My_Division = "ΔΚΤΗΣ";
                                break;
                            case 11 :
                                $My_Division = "ΥΔΚΤΗΣ";
                                break;
                            case 12 :
                                $My_Division = "ΕΠΙΤ";
                                break;
                            case 13 :
                                $My_Division = "ΔΕΕ";
                                break;
                            case 14 :
                                $My_Division = "ΔΥΠ";
                                break;
                            case 15 :
                                $My_Division = "ΜΕΠ";
                                break;
                            case 16 :
                                $My_Division = "ΜΥΠ";
                                break;
                            case 17 :
                                $My_Division = "ΣΑΦ";
                                break;
                            case 18 :
                                $My_Division = "ΣΕΦ";
                                break;
                        }
                    echo "<tr>";
                        echo "<td class=\"serial\">" . $serial . "</td>";
                                                              
                        //echo "<td class=\"evid\" > <a href=\"./form_edit_event.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['evid'] . "</strong>". " </a> </td>"; 
                        if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                           echo "<td class=\"evid\" > <a href=\"./form_edit_event.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['evid'] . "</strong>". " </a> </td>"; 
                       }   else {
                           echo "<td class=\"evid\" > <a href=\"#\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['evid'] . "</strong>". " </a> </td>"; 
                       } 
                        
                        echo "<td class=\"asma\" > <a href=\"form_view_event_asma.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['asma'] . "</strong>". " </a> </td>";
                        echo "<td>" . $row['rank'] . "</td>";
                        echo "<td>" . $row['splty'] . "</td>";
                        echo "<td>" . $row['sname'] . "</td>";
                        echo "<td>" . $row['fname'] . "</td>";
                        echo "<td class=\"division\" id=\"division\">" . $My_Division . "</td>";
                        
                        echo "<td>" . $row['date_start'] . "</td>";
                        echo "<td>" . $row['date_end'] . "</td>";
                        
                        echo "<td class=\"type\">" . $row['type'] . "</td>";                        
                                                                       
                        echo "<td class=\"descript\">" . $row['descript'] . "</td>";
                        echo "<td class=\"doc\">" . $row['doc'] . "</td>"; 
                        echo "<td>" . $row['MyUserReg'] . "</td>"; 
                        
                        //echo "<td class=\"devid\" > <a href=\"./form_delete_event.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['evid'] . "</strong>". " </a> </td>";                                               
                        if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                        
                            echo "<td class=\"devid\" > <a href=\"./form_delete_event.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['evid'] . "</strong>". " </a> </td>";
                        } else {
                            echo "<td class=\"devid\" > <a href=\"#\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['evid'] . "</strong>". " </a> </td>";
                        }
                        
                      
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

        <script type="text/javascript" src="../js/form_view_event_bydate.js"></script>  
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


