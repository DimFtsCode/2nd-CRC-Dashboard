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

        <title> Form Add New Personnel </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Add New Personnel   </strong> </a>

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
                            <h1 class="page-header"> Εισαγωγή Νέου Προσωπικού</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_personnel" class="form-horizontal" action="../php_functions/personnel_insert.php" method="POST">
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
                                    <input type="text" id="asma" name="asma" class="form-control" placeholder="asma" required="asma">
                                    <span class="errorFeedback errorSpan" id="asmaError">ΑΣΜΑ should be only numbers</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΒΑΘΜΟΣ : </label>
                                <div class="col-sm-4">

                                    <select class="form-control"  id="rank"  name="rank" required="rank">
                                        <option value="" selected disabled> rank </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT `rank`, `priority` FROM `ranks` ORDER BY `priority` ";
                                        $rank = $db->runQuery($sql);
                                        while ($row_rank = mysqli_fetch_array($rank)) {
                                            echo "<option value=\"" . $row_rank['rank'] . "\">" . $row_rank['rank'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">specialty : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" required="specialty">
                                    <span class="errorFeedback errorSpan" id="specialtyError">Specialty  should be only capital letters </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last Name : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="last_name" required="last_name">
                                    <span class="errorFeedback errorSpan" id="last_nameError">Last Name  should be only capital letters </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">First Name : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="first_name" required="first_name">
                                    <span class="errorFeedback errorSpan" id="first_nameError">First Name  should be only capital letters </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">password : </label>
                                 <div class="col-sm-4">
                                     <div class="input-group mb-3">
                                         <input  type="password" id="password" name="password" class="form-control" placeholder="password" required="password" readonly>
                                    <span class="input-group-btn"><button class="btn btn-outline-secondary" type="button" id="btn_passwd" name ="btn_passwd">Reset Password</button></span>
                                    </div>
                                </div>
                            </div>   
                            <div> <span class="errorFeedback errorSpan" id="passwordError"> You must reset password </span></div>
                           
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Unit : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="unit" name="unit" required="unit">
                                        <option class="text-primary" value="2ΑΚΕ">2ΑΚΕ</option>  
                                        <option class="text-primary" value="OTHER">OTHER</option>  
                                    </select>                                  
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">directorate : </label>
                                <div class="col-sm-4">

                                    <select class="form-control"  id="directorate"  name="directorate" required="directorate" >
                                        <option value="" selected disabled> directorate </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `divisions` ORDER BY `id` ";
                                        $div = $db->runQuery($sql);
                                        while ($row_div = mysqli_fetch_array($div)) {
                                            echo "<option value=\"" . $row_div['id'] . "\">" . $row_div['description'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>                            
                                                         
                            <div class="form-group">
                                <label class="col-sm-2 control-label">branch : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="branch" name="branch" required="branch"  required="branch">
                                        <option value="" selected disabled> branch </option>
                                        
                                    </select>                                  
                                </div>
                            </div>                                                                                                             

                            <div class="form-group">
                                <label class="col-sm-2 control-label">office : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="office" name="office" class="form-control" placeholder="office" >
                                     <span class="errorFeedback errorSpan" id="officeError">Office should be only capital letters and . , -</span>
                                </div> 
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">admin : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="admin" name="admin" >
                                        <option class="text-primary" value="0">No</option>  
                                        <option class="text-primary" value="1">Yes</option>  
                                    </select>                                  
                                </div>
                            </div>

                           <div class="form-group">
                                <label class="col-sm-2 control-label">Role#1 : </label>
                                <div class="col-sm-4">

                                    <select class="form-control"  id="role"  name="role" >
                                        <option value="" selected disabled> role#1 </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `role1` ORDER BY `r1id` ";
                                        $div = $db->runQuery($sql);
                                        while ($row_div = mysqli_fetch_array($div)) {
                                            echo "<option value=\"" . $row_div['role1'] . "\">" . $row_div['role1'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Role#2 : </label>
                                <div class="col-sm-4">

                                    <select class="form-control"  id="role2"  name="role2" >
                                        <option value="" selected disabled> role#2 </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `role2` ORDER BY `r2id` ";
                                        $div = $db->runQuery($sql);
                                        while ($row_div = mysqli_fetch_array($div)) {
                                            echo "<option value=\"" . $row_div['role2'] . "\">" . $row_div['role2'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Role#3 : </label>
                                <div class="col-sm-4">

                                    <select class="form-control"  id="role3"  name="role3" >
                                        <option value="" selected disabled> role#3 </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `role3` ORDER BY `r3id` ";
                                        $div = $db->runQuery($sql);
                                        while ($row_div = mysqli_fetch_array($div)) {
                                            echo "<option value=\"" . $row_div['role3'] . "\">" . $row_div['role3'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                            </div>  
                                                                                    
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ID number : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="idnumber" name="idnumber" class="form-control" placeholder="idnumber" required="idnumber">
                                    <span class="errorFeedback errorSpan" id="idnumberError">ID number  should be only numbers </span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> date Of Birth  : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="dateofbirth" name="dateofbirth" class="form-control date datepicker" required="dateofbirth" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>                                                                                                                                            
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> date Of Assign : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="dateofassign" name="dateofassign" class="form-control date datepicker" required="dateofassign" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> date Of Release : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="dateofrelease" name="dateofrelease" class="form-control date datepicker" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
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
        
        <script type="text/javascript" src="../js/add_personnel.js"></script>



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
