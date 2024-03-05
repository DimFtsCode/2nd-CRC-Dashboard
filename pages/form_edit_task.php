<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));   
}

if (!($user->role == "SYS" || $user->role == "CMD")) { 
     die(header("Location: dashboard.php"));
 }
 
$myAsma = $user->asma;
$myIndex = $myAsma . "TASK";
$myTask = $_SESSION[$myIndex];
 
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Form Edit Main Task </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Edit Main Task </strong> </a>

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
                            <h1 class="page-header"> Διόρθωση Κύριας Εργασίας </h1>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                            <div class="col-sm-4">       
                                 <input type="text" id="userAsma" name="userAsma" class="form-control" style="display:none" value="<?php $myVar = $user->asma;  $myVar = $myVar . "ASMA";echo $_SESSION[$myVar]?>"  >
                                 <input type="text" id="myTask" name="myTask" class="form-control" style="display:none" value="<?php echo $myTask; ?>"  >
                            </div>
                        </div>   
                        
                        
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_edit_task" class="form-horizontal" action="../php_functions/task_edit.php" method="POST">
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
                                <label class="col-sm-2 control-label">Task ID : </label>
                                <div class="col-sm-2">
                                    <input type="text" id="taskid" name="taskid" class="form-control" placeholder="Task ID" readonly>                                    
                                </div>
                            </div>                                
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΤΟΜΕΑΣ : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="scope" name="scope" required>
                                        <option value="" selected disabled> ΤΟΜΕΑΣ </option>
                                        <option class="text-primary" value="OPS">OPS</option>  
                                        <option class="text-primary" value="LOG">LOG</option>
                                        <option class="text-primary" value="FP">FP</option>
                                        <option class="text-primary" value="MISC">MISC</option>
                                        <option class="text-primary" value="MISC">VCS</option>
                                    </select>                                          
                                </div>
                            </div>
                                                                                   
                          <div class="form-group">
                                <label class="col-sm-2 control-label"> Subject / ΘΕΜΑ : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="subject" name="subject" class="form-control" style="width: 900px;" placeholder="subject" required>                                    
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
                                <label class="col-sm-2 control-label"> Due date : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="date_exp" name="date_exp" class="form-control date datepicker" required >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>   
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Share with : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="share1" name="share1" class="form-control" placeholder="Share with" >                                    
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Share with : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="share2" name="share2" class="form-control" placeholder="Share with" >                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Assigned to : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="assign1" name="assign1" class="form-control" placeholder="Assigned to" required>                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Assigned to : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="assign2" name="assign2" class="form-control" placeholder="Assigned to" >                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Completed : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="complete" name="complete" required>
                                        <option value="" selected disabled> Completed Status </option>
                                        <option class="text-primary" value="No"> No </option>
                                        <option class="text-primary" value="Yes"> Yes </option>                                                                            
                                    </select>                                          
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
        
        <script type="text/javascript" src="../js/edit_task.js"></script>



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

