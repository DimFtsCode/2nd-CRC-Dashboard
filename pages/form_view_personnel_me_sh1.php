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
        // The following is used to force the browser to clear cashe every time the page is loaded  
        //echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_sensor.css?v=" . rand() . "\">" );
        ?>

        <title> Personnel ME Shift#1</title> 
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

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

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
                    <a class="navbar-brand" href="#"> <strong style="color: red; ">  View Personnel   </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>   
                    <a class="navbar-brand" href="./form_view_personnel_bydiv.php"> <strong style="color: darkred; ">  Προβολή ανά Επιστασία </strong> </a>    
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>

            </nav>
            
            <div class="panel-heading text-center">
                        <div class="col-lg-12">
                            <h1 class="page-header" style="color: red;"> 2ο ΑΚΕ // Προβολή Προσωπικού Μοίρας Επιχειρήσεων --- <?php echo date("j - m - Y"); ?></h1>                            
                        </div>
                        <p class="col-lg-12">
                             <h3 class="page-header" style="color: red;"> 1o ΣΜΗΝΟΣ</h3>
                        </p>
                        <!-- /.col-lg-12 -->
             </div>     
            
             <div class="col-sm-2">
                <input type="text" id="my_asma" name="my_asma" class="form-control"  style="display:none" value="<?php echo $user->asma; ?>"  readonly   >                  
                <span class="errorFeedback errorSpan" id="asmaError">ΑΣΜΑ should be only numbers</span> 
            </div>
                                                
            <div class="panel-body">
                <div cla    ss="dataTables_wrapper">
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    require_once("../php_functions/functions.inc");
                    $class = "table";
                    $headArray = array("SN", "ΑΣΜΑ", "Βαθμός", "Ειδ.", "Επιθετο", "Ονομα", "ΚΑΘΗΚΟΝ#1", "ΚΑΘΗΚΟΝ#2", "ΚΑΘΗΚΟΝ#3");
                    $head = count($headArray);
                    $myVar = $user->asma; 
                    $myVar = $myVar . "XID";                  
                    $myUnit = MyUNIT;
                    $myDivision = "15";
                    $myBranch1 = "155";
                    //$myDivID = 15;
                    $myDivID = $_SESSION[$myVar];      
                    //$sql = "SELECT personnel.*, divisions.description AS My_DIV, ranks.*, duty.*, duties.* FROM personnel, divisions, ranks, duty, duties WHERE personnel.asma=duty.asma AND personnel.division = divisions.id AND ranks.rank=personnel.rank AND duty.duty1=duties.description AND personnel.unit ='{$myUnit}' AND personnel.division = '{$myDivision}' ORDER BY ranks.priority ASC, personnel.asma ASC";   
                    $sql = "SELECT personnel.*, divisions.*, branches.branch as MyBranch, ranks.*, duty.*, duties.* FROM personnel, divisions, branches, ranks, duty, duties WHERE personnel.asma=duty.asma AND duty.duty1=duties.description AND personnel.division = divisions.id  AND personnel.branch=branches.id AND ranks.rank=personnel.rank  AND personnel.unit ='{$myUnit}' AND personnel.division ='{$myDivision}' AND personnel.branch ='{$myBranch1}' ORDER BY ranks.priority ASC, personnel.asma ASC";
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

                    echo "<tbody>";
                    while ($row_personnel = mysqli_fetch_array($res)) {
                        echo "<tr>";
                        echo "<td class=\"serial\">" . $serial . "</td>";
                        //echo "<td>" . $row_personnel['priority'] . "</td>";
                        echo "<td class=\"asma\" > <a href=\"./form_personnel_detail_info.php\" target=\"_blank\">" . "<strong style=\"color: blue; font-size: 16px;\">" . $row_personnel['asma'] . "</strong>". " </a> </td>";
                        //echo "<td class=\"asma\" > <a href=\"./form_personnel_detail_info.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row_personnel['asma'] . "</strong>". " </a> </td>";
                        //echo "<td class=\"asma\" > <a href=\"\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row_personnel['asma'] . "</strong>". " </a> </td>";
                        //echo "<td>" . $row_personnel['asma'] . "</td>";
                        echo "<td>" . $row_personnel['rank'] . "</td>";
                        echo "<td>" . $row_personnel['splty'] . "</td>";
                        echo "<td>" . $row_personnel['sname'] . "</td>";
                        echo "<td>" . $row_personnel['fname'] . "</td>";                        
                        //echo "<td>" . $row_personnel['My_DIV'] . "</td>";
                        //echo "<td>" . $row_personnel['MyBranch'] . "</td>";
                        echo "<td>" . $row_personnel['duty1'] . "</td>";
                        echo "<td>" . $row_personnel['duty2'] . "</td>";
                        echo "<td>" . $row_personnel['duty3'] . "</td>";
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

        <script type="text/javascript" src="../js/form_view_personnel_all.js"></script>  
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
