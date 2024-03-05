<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));   
}

if (!($user->role == "SYS" || $user->role2 == "CRF+")) { 
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

        <title> Form Add Batch CRF to User </title>
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Add Batch CRF Files to User </strong> </a>

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
                            </br>                           
                            
                            <li>
                                <a href="admin_dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Admin Dashboard</a>
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
                            <h1 class="page-header"> Προσθήκη CRF Αρχείων Έτους σε Προσωπικό ( έναν Χρήστη, ένα Έτος) </h1>
                        </div>
                                                                        
                        
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_crf_year_asma" class="form-horizontal" action="../php_functions/add_crf_year_asma.php" method="POST" >                           
                           
                            <div id="errorDiv"> 
                                <?php
                                if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
                                    unset($_SESSION['formAttempt']);
                                    print "Errors encountered<br />\n";
                                    foreach ($_SESSION['error'] as $error) {
                                        print $error . "<br />\n";
                                        //print $_SESSION['MyError'][0] . "<br />\n";
                                    } //end foreach                                                                        
                                    
                                } //end if
                                ?>
                            </div>
                                                        
 
                             <?php
                                    echo nl2br("**************** *************************** ************** *************************** ************** ************** *************************** **************");
                              ?>                                
                                                                                    
                            <div class="form-group">                       
                                <label class="col-sm-4 control-label">ΕΠΙΛΕΞΕ ΕΤΟΣ : </label>                            
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΕΤΟΣ : </label>
                                <div class="col-sm-4">

                                    <select class="form-control"  id="fyear"  name="fyear" required="fyear">
                                        <option value="" selected disabled> file year </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT fyear FROM crfiles ORDER by fyear DESC";
                                        
                                        $prevyear = 1900;
                                        $file_year = $db->runQuery($sql);
                                        while ($row_file = mysqli_fetch_array($file_year)) {
                                            $curyear = $row_file['fyear'];
                                            if ($prevyear !=$curyear){
                                                 echo "<option value=\"" . $row_file['fyear'] . "\">" . $row_file['fyear'] . "</option>";
                                            }
                                            $prevyear = $curyear; 
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΑΣΜΑ : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="asma" name="asma" class="form-control" placeholder="asma" required="asma">
                                    <span class="errorFeedback errorSpan" id="asmaError">ΑΣΜΑ should be only numbers</span>
                                </div>
                            </div>
                              
                            
                            <?php
                                    echo nl2br("**************** *************************** ************** *************************** ************** ************** *************************** **************");
                              ?>  
                           
                            </br>
                            </br>
                            </br>
                            </br>
                                                                                                                
                            <input type="submit" value="Add CRF File" name="submit">                          
                            
                             </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                                                                                                                                                                                                                                                                                                                   

                        </form>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

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
        
        <script type="text/javascript" src="../js/add_crf_year_asma.js"></script>


        
    </body>

</html>














