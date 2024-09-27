<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));   
}
$myAsma = $user->asma;
$myIndex = $myAsma . "TASK";
$myIndex1 = $myAsma . "JOB";
$myIndex2 = $myAsma . "REG";
$myTask = $_SESSION[$myIndex];
$myJob = $_SESSION[$myIndex1];
$nyUserREG = $_SESSION[$myIndex2];
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Form Edit Job </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Add Job </strong> </a>

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
                            <h1 class="page-header"> Διόρθωση Επιμέρους Εργασίας </h1>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                            <div class="col-sm-4">       
                                 <input type="text" id="my_asma" name="my_asma" class="form-control"   style="display:none" value="<?php echo $user->asma; ?>"  readonly >
                                 <input type="text" id="myTask" name="myTask" class="form-control" style="display:none" value="<?php echo $myTask; ?>"  >
                                 <input type="text" id="myJob" name="myJob" class="form-control" style="display:none" value="<?php echo $myJob; ?>"  >
                            </div>
                        </div>   
                        
                        
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_edit_job" class="form-horizontal" action="../php_functions/job_edit.php" method="POST">
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
                                <label class="col-sm-2 control-label">Job ID : </label>
                                <div class="col-sm-2">
                                    <input type="text" id="jobid" name="jobid" class="form-control" placeholder="Job ID" readonly>                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">User REG : </label>
                                <div class="col-sm-2">
                                    <input type="text" id="user_reg" name="user_reg" class="form-control" value="<?php echo $nyUserREG; ?>"  readonly>
                                                                       
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Subject / ΘΕΜΑ : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="subject" name="subject" class="form-control" style="width: 900px;" placeholder="subject" required readonly>                                    
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Ενημέρωση :(Θα αναγράφονται λεπτομέρειες (update) περί της εργασίας, max 512 χαρακτήρες.)  </label>
                                <div class="col-sm-4">
                                    <textarea  id="description" name="description" class="form-control" rows="6" style="width: 900px;" placeholder="description" ></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Link / url : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="link" name="link" class="form-control" style="width: 600px;" placeholder="link / url" >                                    
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Update date : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="date_init" name="date_init" class="form-control date datepicker" required >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>                                                                                                                                              
                                                                                                                
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <?php  
                                        if ($user->asma == $nyUserREG ) {
                                            echo "<button id=\"submit\" type=\"submit\" class=\"btn btn-default\">Submit</button>";
                                        }
                                    
                                    ?>
                                  <!--  <button id="submit" type="submit" class="btn btn-default">Submit</button>-->
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
        
        <script type="text/javascript" src="../js/edit_job.js"></script>



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

