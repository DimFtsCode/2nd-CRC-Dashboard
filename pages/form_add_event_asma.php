<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));   
}

if (!($user->role == "SYS" || $user->role2 == "STAFF+")) { 
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

        <title> Form Add Event to Personnel </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Add Event to Personnel </strong> </a>

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
                            <h1 class="page-header"> Εισαγωγή Μεταβολών σε Προσωπικό </h1>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                            <div class="col-sm-4">       
                                 <input type="text" id="userAsma" name="userAsma" class="form-control" style="display:none" value="<?php $myVar = $user->asma;  $myVar = $myVar . "ASMA";echo $_SESSION[$myVar]?>"  >
                            </div>
                        </div>   
                        
                        
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_school_asma" class="form-horizontal" action="../php_functions/event_insert.php" method="POST">
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
                                                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΑΣΜΑ : </label>
                                 <div class="col-sm-4">
                                     <div class="input-group mb-3">
                                         <input  type="text" id="asma" name="asma" class="form-control" placeholder="asma"  readonly>
                                    <!--<span class="input-group-btn"><button class="btn btn-outline-secondary" type="button" id="btn_asma" name ="btn_asma">Select Person by ASMA </button></span>-->                                    
                                    </div>
                                </div>
                            </div> 
                            
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΒΑΘΜΟΣ : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="rank" name="rank" class="form-control" placeholder="rank"  readonly>
                                    <span class="errorFeedback errorSpan" id="rankError">Rank  should be only capital letters </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">specialty : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" readonly>
                                    <span class="errorFeedback errorSpan" id="specialtyError">Specialty  should be only capital letters </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last Name : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="last_name"  readonly>
                                    <span class="errorFeedback errorSpan" id="last_nameError">Last Name  should be only capital letters </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">First Name : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="first_name" readonly>
                                    <span class="errorFeedback errorSpan" id="first_nameError">First Name  should be only capital letters </span>
                                </div>
                            </div>                                                                                           

                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΚΑΤΗΓΟΡΙΑ : </label>
                                <div class="col-sm-4">

                                    <select class="form-control"  id="type"  name="type" required>
                                        <option value="" selected disabled> Είδος Μεταβολής </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT * FROM eventype ORDER by etid ASC";
                                        // $sql = "SELECT `rank`, `priority` FROM `ranks` ORDER BY `priority` ";
                                        $etid = $db->runQuery($sql);
                                        while ($row = mysqli_fetch_array($etid)) {
                                            echo "<option value=\"" . $row['eventype'] . "\">" . $row['eventype'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Περιγραφή : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="descript" name="descript" class="form-control"   style="width: 900px;" placeholder="descript" required>                                    
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Start date : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="date_start" name="date_start" class="form-control date datepicker" required >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>   
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> End date : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="date_end" name="date_end" class="form-control date datepicker" required >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>   
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Θεσμικό Κείμενο : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="doc" name="doc" class="form-control"   style="width: 900px;" placeholder="doc" required>                                    
                                </div>
                            </div>  

                                                                                                                
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button id="submit" type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>

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
        
        <script type="text/javascript" src="../js/add_event_asma.js"></script>



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

