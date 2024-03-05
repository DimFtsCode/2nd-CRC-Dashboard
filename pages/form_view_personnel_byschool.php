<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role2 == "TRAIN+" || $user->role == "CMD" || $user->role2 == "STAFF+" || $user->role3 == "TRAIN")) { 
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
        $myAsma = $user->asma;
        $myIndex = $myAsma . "SCHOOL";
        $mySchool =  $_SESSION[$myIndex];
        ?>

        <title> Form View Personnel Schools</title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; ">  View Personnel Schools </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>   
                    <a class="navbar-brand" href="./admin_dashboard.php"> <strong style="color: darkred; ">  Admin </strong> </a>  
                    <a class="navbar-brand" href="./form_view_school_bydiv.php"> <strong style="color: blue; ">  Schools by Division </strong> </a>   
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
               <input type="text" id="mySchool" name="mySchool" class="form-control"   style="display:none" value="<?php echo $mySchool?>"  >
            </div>
            

            <div class="panel-heading text-center">
                        <div class="col-lg-12">
                            <h1 class="page-header" style="color: red;"> Προβολή Προσωπικού ανά Σχολείο ή Σεμινάριο  --- <?php echo date("j - m - Y"); ?></h1>
                        </div>
             </div> 
            

            <div class="panel-heading text-center">                                          
                <strong style="color: black; background-color: yellow; font-size: 18px;"> ΠΡΟΒΟΛΗ  ΠΡΟΣΩΠΙΚΟΥ για το ΣΧΟΛΕΙΟ / ΣΕΜΙΝΑΡΙΟ  :  </strong> 
                <label id="blank"> ... >>>   </label>
                <label id="Head_shid" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                <label id="blank"> ...   </label>
                <label id="Head_type" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                <label id="blank"> ...   </label>
                <label id="Head_name" style="color: yellow; background-color: black; font-size: 18px;">    </label>
                <label id="blank"> ...   </label>
                <label id="Head_location" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                <label id="blank"> ...   </label>
                <label id="Head_description" style="color: yellow; background-color: black; font-size: 18px;">    </label>
            </div>
            
            <div class="panel-body">
                <div class="dataTables_wrapper">
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    $class = "table";
                    $myUnit = MyUNIT;
                    $headArray = array("SN", "ΑΣΜΑ", "ΒΑΘΜΟΣ", "ΕΙΔ", "ΕΠΙΘΕΤΟ", "ΟΝΟΜΑ", "ΕΠΙΣΤΑΣΙΑ", "ΟΝΟΜΑ ΣΧΟΛΕΙΟΥ", "Start Date" , "End Date" );
                    $head = count($headArray);                  
                    
                    $sql = "SELECT schools.*, training.*, personnel.*, divisions.description as MyDIV, ranks.* FROM schools, training, personnel, divisions, ranks WHERE schools.shid='{$mySchool}' AND schools.shid=training.shid AND personnel.asma=training.asma AND personnel.division=divisions.id AND personnel.rank=ranks.rank AND personnel.unit ='{$myUnit}' ORDER BY ranks.priority ASC, personnel.asma ASC";
                     //$sql = "SELECT schools.*, training.*, personnel.* FROM schools, training, personnel WHERE schools.shid='{$mySchool}' AND schools.shid=training.shid AND personnel.asma=training.asma  ";
                                       
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    $serial = 1;
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"personnel\">";
                    
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
                                                                                              
                        echo "<td class=\"asma\" > <a href=\"form_view_school_asma.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row['asma'] . "</strong>". " </a> </td>";
                                             
                        echo "<td>" . $row['rank'] . "</td>";
                        echo "<td >" . $row['splty'] . "</td>";
                        echo "<td class=\"sname\">" . $row['sname'] . "</td>";
                        echo "<td class=\"fname\">" . $row['fname'] . "</td>";
                        echo "<td >" . $row['MyDIV'] . "</td>";
                        
                        echo "<td >" . $row['shname'] . "</td>";
                        
                        echo "<td>" . $row['date_start'] . "</td>";
                        echo "<td>" . $row['date_end'] . "</td>";  
                                                                                                                                                 
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

        <script type="text/javascript" src="../js/form_view_personnel_byschool.js"></script>
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#personnel").DataTable({
                    responsive: true,
                    "pageLength": 100
                });
            });
        </script>


    </body>
</html>








