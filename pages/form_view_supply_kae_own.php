<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}


if (!($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY")) { 
     die(header("Location: dashboard.php"));
 }

$myAsma = $user->asma;
$myIndex = $user->asma . "KAE";
$myIndex1 = $myAsma . "ASMA";
$myIndex2 = $myAsma . "XCHECK";
$myIndex3 = $myAsma . "KAEDS";
$myIndex4 = $myAsma . "FUND";

$myKAE = $_SESSION[$myIndex];
//$myKAE = "KAE1925";
//$myYear = $_SESSION[$myIndex];
$userAsma =  $_SESSION[$myIndex1];
$blnCheck = $_SESSION[$myIndex2];
$myKAEDes = $_SESSION[$myIndex3];
$myFund = $_SESSION[$myIndex4];

$DefYear = date("Y");
//$DefYear = $myYear;
//$myKAEDes = "TESTTEST";



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

        <title> Form View Supply Budget & KAE </title> 
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
                    <a class="navbar-brand" href="./form_add_supply.php"> <strong style="background-color: yellow; color: darkred; "> Εισαγωγή Νέας Εντολής </strong> </a>
                    <a class="navbar-brand" href="./form_view_supply_main.php"> <strong style="background-color: cyan; color: darkred; "> Προβολή Συνόλου Εντολών </strong> </a>
                    <a class="navbar-brand" href="./form_view_supply_budget.php"> <strong style="background-color: red; color: yellow; "> Προβολή ανά Budget </strong> </a>
                    <a class="navbar-brand" href="./form_view_supply_kae.php"> <strong style="background-color: yellow; color: darkred; "> Προβολή ανά ΚΑΕ </strong> </a>
                    <a class="navbar-brand" href="./admin_dashboard.php"> <strong style="color: darkred; "> Admin </strong> </a> 
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>                                

            </nav>
            
           
           <div class="panel-heading text-center">
                        <div class="col-lg-12">                            
                             <h1 class="page-header" style="color: blue;"> Προβολή Εντολών Αγοράς / Εργασίας Έτους :  <?php echo $DefYear; ?>  / Budget : <?php echo $myFund; ?>  </h1>
                        </div>        
                        <div class="col-lg-12">                            
                             <strong class="page-header" style="color: black; background-color: yellow"> ΚΑΕ / ΑΛΕ    :  <?php  echo $myKAEDes;?>  </strong>
                        </div>   
                        <div class="col-lg-12">                                                        
                            </br>   
                        </div>  
            </div>                    
            
            <div class="form-group">
                                    
                         <div class="form-group">
                                <label class="col-sm-2 control-label"> ΕΠΙΛΕΞΤΕ ΧΡΗΜΑΤΟΔΟΤΗΣΗ : </label>
                                <div class="col-sm-2">
                                    <select class="form-control"  id="fund"  name="fund" >
                                        <option value="" selected disabled> ΟΙΚΕΙΟ BUDGET </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `fund` ORDER BY `fid` ";
                                        $row = $db->runQuery($sql);
                                        while ($row_div = mysqli_fetch_array($row)) {
                                            echo "<option value=\"" . $row_div['fund'] .  "\">" . $row_div['fund'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                        </div>   
                            
                        <div class="form-group">
                                <label class="col-sm-2 control-label"> ΕΠΙΛΕΞΤΕ KAE / ΑΛΕ : </label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="kae" name="kae" required="kae">
                                        <option value="" selected disabled> ΚΩΔΙΚΟΣ ΚΑΕ/ΑΛΕ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `budget` ORDER BY `bid` ";
                                        $row = $db->runQuery($sql);
                                        while ($row_div = mysqli_fetch_array($row)) {
                                            echo "<option value=\"" . $row_div['kae'] . "\">" . $row_div['kae'] . " -- " . $row_div['description'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                        </div> 
                            
                       
                
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
                    
                    $headArray = array("SN", "ID", "Αρ.ΕΝ", "ΗΜΕΡ. ΕΝΤ.", "ΠΕΡΙΓΡΑΦΗ", "ΔΝΣΗ", "ΤΜΗΜΑ", "ΧΕΙΡΙΣΤΗΣ", "ΕΚΤ. ΚΟΣΤΟΣ", "own BUDGET", "ΕΙΔΟΣ ΕΝΤ.", "ΥΠΗΡ.ΣΗΜ.", "Link ΥΣ", "ΧΡΗΜΑΤ.", "ΠΑΡΑΛΗΦΘΗ", "ΠΑΡΑΓΓΕΛ.", "ΠΡΟΜΗΘΕΥΤΗΣ", "ΤΙΜΟΛΟΓΙΟ", "ΤΕΛ. ΚΟΣΤ", "STATUS", "ΠΑΡΑΤΗΡ.", "DETAIL" );
                    $head = count($headArray);   
                    
                    if ($blnCheck ==0) {
                       $DefYear = date("Y");
                    }
                    
                    $own_budget = "2AKE";
                    
                    $sql = "SELECT * FROM supply WHERE year = '{$DefYear}' AND bcode = '{$myKAE}' AND own_budget = '{$myFund}' ORDER BY serial DESC ";                    
                    //$sql = "SELECT * FROM supply WHERE year = '{$DefYear}' ORDER BY sdate DESC ";
                    
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    $serial = 1;
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"supplytable\">";
                    
                    echo "<thead>";
                    echo "<tr>";
                    for ($i = 0; $i < $head; $i++) {
                        echo "<th>" . $headArray[$i] . "</th>";
                    }
                    echo "</tr>";
                    echo "</thead>";

                    echo "<tbody>";
                    
                    $SumCost = 0;
                    $SumFCost = 0;
                    $preCell = "--";
                    while ($row = mysqli_fetch_array($res)) { 
                        
                        $My_DIV = $row['division'];
                        $My_BRC = $row['branch'];
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
                                                
                        
                        $db2 = new DbMgmt;
                        $sql2 = "SELECT `id`, `branch`  FROM `branches` ORDER BY `id` ";
                        $branch = $db2->runQuery($sql2);
                        while ($row_branch = mysqli_fetch_array($branch)){ 
                             if ($row_branch['id'] == $My_BRC ) {
				$myBranch = $row_branch['branch'];
			    }										                                           
                        }
                        
                        $myBudget = $row['budget'];
                        $lenBudget = strlen($myBudget);
                        $myBcode = substr($myBudget, 0, 26);
                        
                        $posComa = strpos($myBudget, ',');
                        
                        $myBudget = substr($myBudget, 28, $lenBudget);
                        
                        if (strlen($myBudget) > 52 ){
                            $myBudget = substr($myBudget, 0, 52);
                        }
                        
                        $myLink = $row['link'];
                        if (strlen($myLink) > 23 ){
                            $myLink = substr($myLink, 0, 23);
                        }
                        
                        $myRemark = $row['remark'];
                        if (strlen($myRemark) > 50 ){
                            $myRemark = substr($myRemark, 0, 50);
                        }
                        
                        
                        
                        echo "<tr>";
                        echo "<td class=\"serial\">" . $serial . "</td>";
                        
                        
                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY") {
                           echo "<td class=\"supid\" > <a href=\"./form_edit_supply.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['sup_id'] . "</strong>". " </a> </td>";                                          
                        } else {
                           echo "<td class=\"supid\" > <a href=\"#\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['sup_id'] . "</strong>". " </a> </td>"; 
                        }                                          
                                                                         
                        echo "<td class=\"snumber\">" . $row['serial'] . "</td>";
                        echo "<td class=\"sdate\">" . date("d-m-Y", strtotime($row['sdate'])) . "</td>";
                        echo "<td class=\"description\">" . $row['description'] . "</td>";
                        echo "<td class=\"division\" id=\"division\">" . $My_Division . "</td>";
                        echo "<td class=\"branch\" id=\"branch\">" . $myBranch . "</td>";
                                                 
                        echo "<td class=\"poc\">" . $row['poc'] . "</td>";
                        echo "<td class=\"cost\">" . $row['cost'] . " €". "</td>";
                        $SumCost = $SumCost + $row['cost'];
                        
                        echo "<td class=\"own_budget\">" . $row['own_budget'] . "</td>";
                                                                        
                        //echo "<td class=\"bcode\">" . $myBcode . "</td>";
                                                 
                        echo "<td class=\"type_order\">" . $row['type_order'] . "</td>";
                        echo "<td class=\"order\">" . $row['order'] . "</td>";
                        //echo "<td class=\"order\">" . $posComa . "</td>";
                        
                        echo "<td class=\"link\" > <a href=\" " . $row['link'] . "\" target=\"_blank\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $myLink . "</strong>". " </a> </td>";
                        echo "<td class=\"funded\">" . $row['funded'] . "</td>";
                        echo "<td>" . date("d-m-Y", strtotime($row['rdate'])) . "</td>";
                        echo "<td>" . date("d-m-Y", strtotime($row['ordate'])) . "</td>";

                        echo "<td>" . $row['orplace'] . "</td>"; 
                        echo "<td class=\"invoice\">" . $row['invoice'] . "</td>";
                        echo "<td >" . $row['fcost'] . " €". "</td>";
                        $SumFCost = $SumFCost + $row['fcost'];
                        echo "<td class=\"status\">" . $row['status'] . "</td>";
                                                
                        echo "<td class=\"remark\">" . $myRemark . "</td>";
                        
                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY") {
                            echo "<td class=\"delid\" > <a href=\"./form_detail_supply.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['sup_id'] . "</strong>". " </a> </td>";
                        }   else {
                            echo "<td class=\"delid\" > <a href=\"#\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['sup_id'] . "</strong>". " </a> </td>";
                        }    
                                                                                                                                       
                        echo "</tr>";
                        $serial = $serial + 1;
                    }
                    echo "<tr>";
                    
                    echo "</tr>";
                        echo "<td>" . $preCell . "</td>"; 
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        //echo "<td>" . "ΣΥΝΟΛΟ :" . "</td>"; 
                        echo "<td class=\"sum1\">" ."ΣΥΝΟΛΟ :" . "</td>";
                        echo "<td class=\"sum1\">" . $SumCost . " €". "</td>";
                        echo "<td>" . $preCell . "</td>"; 
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        
                        echo "<td class=\"sum2\">" ."ΣΥΝΟΛΟ :" . "</td>";
                        echo "<td class=\"sum2\">" . $SumFCost . " €". "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        echo "<td>" . $preCell . "</td>";
                        //echo "<td>" . $preCell . "</td>";
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

        <script type="text/javascript" src="../js/form_view_supply_kae_own.js"></script>  
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#supplytable").DataTable({
                    responsive: true,
                    "pageLength": 500
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


