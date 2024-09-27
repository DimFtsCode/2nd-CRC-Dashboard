<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+" || $user->role2 == "TRAIN+" || $user->role3 == "TRAIN")) { 
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

        <title> Form View Schools</title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; ">  View Schools </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>   
                    <a class="navbar-brand" href="./admin_dashboard.php"> <strong style="color: darkred; ">  Admin </strong> </a>  
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
 

            <div class="panel-heading text-center">
                        <div class="col-lg-12">
                            <h1 class="page-header" style="color: red;"> Προβολή Συνόλου Σχολείων / Σεμιναρίων --- <?php echo date("j - m - Y"); ?></h1>
                        </div>
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
                    $headArray = array("SN", "Sch ID",  "ΤΥΠΟΣ", "ΟΝΟΜΑ", "ΕΔΡΑ", "ΠΕΡΙΓΡΑΦΗ", "Del_ID", "User_reg", "Date_reg");
                    $head = count($headArray);
                    //$myUnit = "1ΑΚΕ";
                    
                    $sql = "SELECT schools.*  FROM schools ORDER BY schools.shname ASC";
                    
                   
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
                        
                                               
                        //echo "<td class=\"shid\" > <a href=\"\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['shid'] . "</strong>". " </a> </td>";
                        echo "<td class=\"shid\" > <a href=\"./form_edit_school.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['shid'] . "</strong>". " </a> </td>";
                        echo "<td class=\"shtype\">" . $row['shtype'] . "</td>";                        
                        echo "<td>" . $row['shname'] . "</td>";
                        
                        echo "<td >" . $row['location'] . "</td>";
                        echo "<td >" . $row['description'] . "</td>";
                        //echo "<td class=\"fpath\" > <a href=\" " . $row['fpath'] . "\" target=\"_blank\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['fpath'] . "</strong>". " </a> </td>";
                       
                        if ($user->role == "SYS" || $user->role3 == "SYSTEM") {
                            echo "<td class=\"Dshid\" > <a href=\"./form_delete_school.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['shid'] . "</strong>". " </a> </td>";                           
                        } else {
                           echo "<td class=\"Dshid\" > <a href=\"\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['shid'] . "</strong>". " </a> </td>"; 
                        }
                        
                        echo "<td>" . $row['user_reg'] . "</td>";
                        echo "<td>" . $row['date_reg'] . "</td>";                      
   
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

        <script type="text/javascript" src="../js/form_view_schools.js"></script>
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








