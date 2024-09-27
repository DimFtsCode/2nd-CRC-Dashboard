<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}
 
 if (!($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD" || $user->role == "MED" || $user->role2 == "MED+")) { 
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
        $myUnit = MyUNIT;
        $myAsma = $user->asma;
           
        $myIndex = $myAsma . "ASMA";
        $userAsma =  $_SESSION[$myIndex];
              
        ?>

        <title> Form View User ΤΠΥΕ </title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; ">  View User CRF Files </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>   
                    <a class="navbar-brand" href="./admin_dashboard.php"> <strong style="color: darkred; ">  Admin </strong> </a>  
                    <a class="navbar-brand" href="./form_view_personnel_all.php"> <strong style="color: blue; ">  Σύνολο ΠΡΣ </strong> </a>   
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 
                     <?php
                    if ($user->role == "SYS" || $user->role == "MED" || $user->role2 == "MED+") {
                        $myHerf = " <a class=\"navbar-brand\" id=\"add_tpye\" style=\"color: red; font-size: 20px; \" href=\"form_add_tpye_asma.php\"> Εισαγωγή ΤΠΥΕ / Εξετάσεων Προσωπικού </a> ";
                        echo $myHerf;
                    }
                    ?>          

                </div>

            </nav>
            

            <div id="errorDiv"> 
                <?php
                if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
                    unset($_SESSION['formAttempt']);
                    print "Action Information :  <br />\n";
                    foreach ($_SESSION['error'] as $error) {
                        print $error . "<br />\n";
                        //print $_SESSION['MyError'][0] . "<br />\n";
                    } //end foreach                                                                        
                } //end if
                ?>
            </div>

                        
            <div class="col-sm-2">
                <input type="text" id="my_asma" name="my_asma" class="form-control"  style="display:none" value="<?php echo $user->asma; ?>"  readonly   >                  
                <input type="text" id="userAsma" name="userAsma" class="form-control"  style="display:none" value="<?php echo $userAsma; ?>"  readonly   > 
            </div>

            <div class="panel-heading text-center">
                        <div class="col-lg-12">
                            <h1 class="page-header" style="color: red;"> Προβολή  ΤΠΥΕ Προσωπικού --- <?php echo date("j - m - Y"); ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
             </div>         
            
            
            <div class="panel-heading text-center">                                          
                <strong style="color: black; background-color: yellow; font-size: 18px;"> ΠΡΟΒΟΛΗ  ΤΠΥΕ  του :  </strong> 
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

            
            <div class="panel-body">
                <div class="dataTables_wrapper">
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    $class = "table";
                    $headArray = array("SN", "ΕΝΑΡΞΗ", "ΠΕΡΑΣ", "ΝΟΣΟΚΟΜΕΙΟ", "ΕΙΔΟΣ", "ΑΡΧΗ", "ΑΡ. ΑΠΟΦ.", "ΔΙΑΓΝΩΣΗ", "ID_Edit", "Delete_ID");
                    $head = count($headArray);
                                                      
                    //$sql = "SELECT tpye.* FROM tpye WHERE tpye.asma='{$userAsma}' ORDER BY tpye.date_start DESC";
                    $sql = "SELECT tpye.* FROM tpye WHERE tpye.asma='{$userAsma}' ORDER BY tpye.date_start DESC";
                                       
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    $serial = 1;
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"tpye\">";
                    
                    echo "<thead>";
                    echo "<tr>";
                    for ($i = 0; $i < $head; $i++) {
                        echo "<th>" . $headArray[$i] . "</th>";
                    }
                    echo "</tr>";
                    echo "</thead>";

                    echo "<tbody>";
                    while ($row = mysqli_fetch_array($res)) {
                        $My_Date = "2000-01-01";
                        $My_end_date = $row['date_end'] ;
                        if ($row['date_end']  == $My_Date) {
                            $My_end_date = "Pending";
                        } else {
                            $Signature = "No";
                        }
                        
                        echo "<tr>";
                        echo "<td class=\"serial\">" . $serial . "</td>";
                        
                        echo "<td>" . $row['date_start'] . "</td>";   
                        //echo "<td>" . $row['date_end'] . "</td>";   
                        echo "<td>" . $My_end_date . "</td>";  
                        echo "<td>" . $row['hospital'] . "</td>";  
                        echo "<td>" . $row['exam_type'] . "</td>";
                        echo "<td>" . $row['aea'] . "</td>";
                        echo "<td>" . $row['rmknum'] . "</td>";
                        echo "<td>" . $row['remark'] . "</td>";
                        
                        
                        if ($user->role == "SYS" || $user->role == "MED" || $user->role2 == "MED+") {                        
                              echo "<td class=\"tpid\" > <a href=\"./form_edit_tpye_asma.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['tpid'] . "</strong>". " </a> </td>";
                         }else {
                              echo "<td class=\"tpid\" > <a href=\"\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['tpid'] . "</strong>". " </a> </td>";
                         }              
                                               
                        if ($user->role == "SYS" || $user->role == "MED" || $user->role2 == "MED+") {                        
                              echo "<td class=\"delid\" > <a href=\"./form_delete_tpye_asma.php\" >" . "<strong style=\"color: red; font-size: 16px;\">" . $row['tpid'] . "</strong>". " </a> </td>";
                         }else {
                              echo "<td class=\"delid\" > <a href=\"\" >" . "<strong style=\"color: red; font-size: 16px;\">" . $row['tpid'] . "</strong>". " </a> </td>";
                         }                                                                                        
   
                        echo "</tr>";
                        $serial = $serial + 1;
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

        <script type="text/javascript" src="../js/form_view_tpye_user.js"></script>
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#tpye").DataTable({
                    responsive: true,
                    "pageLength": 100
                });
            });
        </script>


    </body>
</html>









