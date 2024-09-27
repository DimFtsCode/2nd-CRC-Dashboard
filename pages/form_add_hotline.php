<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role2 == "COM+" || $user->role2 == "ROIP+")) { 
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

        <title> Form Insert New HOTLINE </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Insert New HOTLINE   </strong> </a>
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
                            
                            <li>
                                </br>
                            </li>
                            
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
                            <h1 class="page-header"> Εισαγωγή Νέας HOTLINE </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_hotline" class="form-horizontal" action="../php_functions/hotline_insert.php" method="POST">                            

                            <div class="form-group">
                                <legend class="col-sm-2 control-label"> HOTLINE Information  </legend>

                            </div>    

                            <div id="errorDiv"> 
                                <?php
                                if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
                                    unset($_SESSION['formAttempt']);
                                    print "Errors encountered<br />\n";
                                    foreach ($_SESSION['error'] as $error) {
                                        print $error . "<br />\n";
                                    } //end foreach
                                } //end if
                                ?>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> HOTLINE Name : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="line_name" name="line_name" class="form-control" placeholder="line_name" required="line_name">
                                    <span class="errorFeedback errorSpan" id="line_nameError">HOTLINE Name  should be only Capital LETTERS, numbers and chars -, /  </span>
                                </div>
                            </div>                                                        

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> HOTLINE type : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="line_type" name="line_type" required="line_type" required="line_type">
                                        <option value="" selected disabled> HOTLINE type </option>
                                        <option class="text-primary" value="HOTLINE"> HOTLINE </option>
                                        <option class="text-primary" value="ATK"> ΜΕΣΩ ATK </option>
                                    </select>                                          
                                </div>
                            </div>
                                                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> STATUS : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="status" name="status" required="status" required="status">
                                        <option value="" selected disabled> HOTLINE Status </option>
                                        <option class="text-primary" value= "ΕΝ/ΕΝ"> ΕΝ/ΕΝ </option>  
                                        <option class="text-primary" value="ΕΚ/ΕΝ"> ΕΚ/ΕΝ </option>  
                                        <option class="text-primary" value="ΕΚ/ΛΕΙΤ"> ΕΚ/ΛΕΙΤ </option>
                                        <option class="text-primary" value="STAND-BY"> STAND BY </option>                                         
                                    </select>                                          
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Reason : </label>
                                <div class="col-sm-4">
                                    <textarea  id="reason" name="reason" class="form-control" rows="2" placeholder="Reason"></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Actions : </label>
                                <div class="col-sm-4">
                                    <textarea  id="action" name="action" class="form-control" rows="1" placeholder="action"></textarea>
                                </div>
                            </div>                           

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΠΕΡΑΣ ΕΝΕΡΓΕΙΩΝ : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="tbc" name="tbc" class="form-control date datepicker" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>                                                        

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" class="btn btn-default" id="submit" name="submit">Submit</button>
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
        
        <script type="text/javascript" src="../js/add_hotline.js"></script> 

        <!-- Datepicker Theme -->
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/locales/bootstrap-datepicker.el.min.js"></script>



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
