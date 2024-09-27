<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
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
        $myAsma = $user->asma;
        $myIndex = $myAsma . "ASMA";
        //$userAsma =  $_SESSION[$myIndex];
        $userAsma =   $user->asma;
        ?>

        <title> Form View SAM Exer </title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; ">  View Exer </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>
                    <a class="navbar-brand" href="form_add_exssa.php"> <strong style="color: red; ">  Εισαγωγή Ασκήσεων </strong> </a>  
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>
                
            </nav>

                           
                <div id="errorDiv"> 
                    <?php
                    if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
                        unset($_SESSION['formAttempt']);
                        print "Action Information : <br />\n";
                        foreach ($_SESSION['error'] as $error) {
                            print $error . "<br />\n";
                            //print $_SESSION['MyError'][0] . "<br />\n";  
                        } //end foreach                                                                        
                    } //end if
                    ?>
                </div>
 
             <div class="col-sm-2">
                <input type="text" id="my_asma" name="my_asma" class="form-control" style="display:none" value="<?php echo $user->asma; ?>"  readonly   >                  
               <input type="text" id="userAsma" name="userAsma" class="form-control"  style="display:none" value="<?php echo $userAsma; ?>"  readonly   > 
            </div>
            

            <div class="panel-heading text-center">
                        <div class="col-lg-12">
                            <h1 class="page-header" style="color: blue;"> Προβολή Ασκήσεων SSA / SAM --- <?php echo date("j - m - Y"); ?></h1>
                        </div>
             </div> 
            

            <div class="panel-heading text-center">                                          
                <strong style="color: black; background-color: yellow; font-size: 18px;"> ΠΡΟΒΟΛΗ  ΑΣΚΗΣΕΩΝ του :  </strong> 
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
                    $headArray = array("SN", "Edit ", "ΗΜΕΡΟΜ.", "ΚΑΤΗΓΟΡΙΑ", "Ο/Σ", "C2 UNIT" , "MKEΑ/AΠ" , "TDL", "VOICE", "AIR", "FREQ", "RADIO", "AJ", "NET", "REASON", "Del" );
                    $head = count($headArray);                  
                    
                    $sql = "SELECT exssa.* FROM exssa WHERE exssa.asma='{$userAsma}' ORDER BY exssa.mdate DESC";                    
                                       
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    $serial = 1;
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"schools\">";
                    
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
                                                                               
                         
                        echo "<td class=\"ssa_id\" > <a href=\"form_edit_exssa_asma.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['ssa_id'] . "</strong>". " </a> </td>";                     
                        
                        echo "<td>" . $row['mdate'] . "</td>";
                        echo "<td class=\"cotype\">" . $row['cotype'] . "</td>";                        
                                                                       
                        echo "<td>" . $row['osunit'] . "</td>"; 
                        echo "<td>" . $row['c2unit'] . "</td>";                          
                        echo "<td >" . $row['mkeap'] . "</td>";                        
                        echo "<td >" . $row['tdl'] . "</td>";
                        
                        echo "<td >" . $row['voicegr'] . "</td>";
                        echo "<td >" . $row['voicair'] . "</td>";
                        echo "<td >" . $row['freq'] . "</td>";
                        echo "<td >" . $row['radio'] . "</td>";
                        
                        echo "<td >" . $row['aj'] . "</td>";
                        echo "<td >" . $row['ajnet'] . "</td>";
                        echo "<td >" . $row['reason'] . "</td>";
                        
                        echo "<td class=\"del_id\" > <a href=\"\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['ssa_id'] . "</strong>". " </a> </td>"; 
                        
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

        <script type="text/javascript" src="../js/form_view_exssa_asma.js"></script>
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#schools").DataTable({
                    responsive: true,
                    "pageLength": 100
                });
            });
        </script>


    </body>
</html>








