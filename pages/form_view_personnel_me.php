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
        echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_sensor.css?v=" . rand() . "\">" );
        ?>

        <title> Form View Personnel</title> 
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
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> <strong style="color: red; ">  View Personnel   </strong> </a>

                </div>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="./logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout </a>
                            </li>
                            <li class="sidebar-search">

                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>

                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            <!-- /# page wrapper -->   
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Προβολή Προσωπικού Μοίρας Επιχειρήσεων</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading text-center">
                                        <strong> Προβολή Προσωπικού Μοίρας Επιχειρήσεων - <?php echo date("j - m - Y"); ?></strong>
                                    </div>
                                    <div class="panel-body">
                                        <div class="dataTables_wrapper">
                                            <?php
                                            require_once '../php_functions/Cvutils/utils.php';
                                            require_once '../php_functions/db_config/db_connect.php';
                                            $class = "table";
                                            $headArray = array("SN", "ΑΣΜΑ", "Βαθμός", "Ειδ.", "Επιθετο", "Ονομα", "Σμήνος");
                                            $head = count($headArray);
                                            $myID = "15";
                                            $myUnit = MyUNIT;
                                            //$sql = "SELECT `asma`, `rank`, `splty`, `sname`, `fname` FROM `personnel` ORDER BY `personnel`.`asma` ASC";
                                            //$sql = "SELECT * FROM personnel, divisions WHERE personnel.division ='{$myID}' AND divisions.id='{$myID}'  ORDER BY personnel.asma ASC";
                                            //$sql = "SELECT * FROM personnel, divisions WHERE personnel.division = divisions.id  ORDER BY personnel.asma ASC";
                                            $sql = "SELECT personnel.*, divisions.description AS My_DIV, branches.branch as MyBranch, ranks.* FROM personnel, divisions, branches, ranks WHERE personnel.division = divisions.id AND personnel.branch = branches.id AND personnel.unit ='{$myUnit}' AND personnel.division = '{$myID}' AND ranks.rank=personnel.rank  ORDER BY ranks.priority ASC, personnel.asma ASC";
                                            //$sql = "SELECT personnel.*, divisions.description AS My_DIV, ranks.* FROM personnel, divisions, ranks WHERE personnel.division = divisions.id AND personnel.unit ='{$myUnit}' AND personnel.division = '{$myID}' AND ranks.rank=personnel.rank  ORDER BY ranks.priority ASC, personnel.asma ASC";
                                            //$sql = "SELECT personnel.*, divisions.description AS My_DIV, branches.branch as MyBranch, ranks.* FROM personnel, divisions, branches, ranks WHERE personnel.division = divisions.id AND personnel.unit ='{$myUnit}' AND personnel.division = '{$myID}' AND ranks.rank=personnel.rank ORDER BY ranks.priority ASC, personnel.asma ASC";
                                            $db = new DbMgmt;                                            
                                            $res = $db->runQuery($sql);
                                            $serial = 1;
                                            echo "<table class=\"table table-striped table-bordered table-hover\" id=\"personnel\">";
                                            echo "<caption class=\"text-center \">Προβολή Προσωπικού</caption>";
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
                                                echo "<td>" . $row_personnel['asma'] . "</td>";
                                                echo "<td>" . $row_personnel['rank'] . "</td>";
                                                echo "<td>" . $row_personnel['splty'] . "</td>";
                                                echo "<td>" . $row_personnel['sname'] . "</td>";
                                                echo "<td>" . $row_personnel['fname'] . "</td>";
                                                echo "<td>" . $row_personnel['MyBranch'] . "</td>";
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
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
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

        <!--  <script type="text/javascript" src="../js/insert_personnel.js"></script>  -->
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
