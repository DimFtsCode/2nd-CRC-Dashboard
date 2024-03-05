<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role2 == "OPS+" || $user->role == "OPS" || $user->role2 == "EXER+")) { 
     die(header("Location: form_view_missions.php")); 
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

        <title> Form Insert New Mission </title> 
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
        
        <!-- timepicker-wvega css -->
        <link href="../bower_components/jquery-timepicker-wvega/jquery.timepicker.css" rel="stylesheet">

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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Insert New Mission   </strong> </a>
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
                                <a href="form_view_missions.php"><i class="glyphicon glyphicon-fire"></i> Προβολή Αποστολών </a>
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
                            <h1 class="page-header"> Εισαγωγή Νέας Εγγραφής Τακτικών Αποστολών </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_missions" class="form-horizontal" action="../php_functions/missions_insert.php" method="POST">   
                            
                            <div id="errorDiv">
                                <?php
                                if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
                                    unset($_SESSION['formAttempt']);
                                    print "Errors encountered<br />\n";
                                    foreach ($_SESSION['error'] as $error) {
                                        print $error . "<br />\n";
                                    } //end foreach
                                } else{
                                    //print " check for errors ";
                                }
                                ?>
                            </div>
                            

                            <div class="form-group">
                                <legend class="col-sm-2 control-label"> Mission Information  </legend>

                            </div>    

                            <div id="errorDiv">
                                <?php
                                //print $myError;
                                //print $_SESSION['MyError'][0];
                                //print $_SESSION['MyError'][1];
                                ?>
                            </div>
                                                                                   
                             <div class="form-group">
                                <label class="col-sm-2 control-label"> Asset : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="asset" name="asset" class="form-control" placeholder="Asset" required="asset">
                                    <span class="errorFeedback errorSpan" id="assetError">Asset  should be only capital letters </span>
                                </div>
                            </div>   
                                                                                                                                                                                                                                                                                                                                                                                  
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Call Sign : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="callsign" name="callsign" class="form-control" placeholder="Call Sign" required="callsign">
                                    <span class="errorFeedback errorSpan" id="callsignError">Call Sign  should be only capital letters </span>
                                </div>
                            </div>   
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Track Number : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="track" name="track" class="form-control" placeholder="Track Number" required="track">
                                    <span class="errorFeedback errorSpan" id="trackError">Track Number Sign  should be only capital letters </span>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Mission : </label>
                                <div class="col-sm-2">                                    
                                    <select class="form-control" id="mission" name="mission" required="mission">
                                        <option value="" selected disabled> Mission </option>
                                        <option class="text-primary" value="VID"> VID </option>
                                        <option class="text-primary" value="ΚΑΤΑΡΡΙΨΗ"> ΚΑΤΑΡΡΙΨΗ </option>
                                        <option class="text-primary" value="ΕΜΠΛΟΚΗ"> ΕΜΠΛΟΚΗ </option>
                                        <option class="text-primary" value="INTERVENTION"> INTERVENTION </option>
                                        <option class="text-primary" value="ΚΑΤΑΣΤΡΟΦΗ ΣΤΟΧΟΥ"> ΚΑΤΑΣΤΡΟΦΗ ΣΤΟΧΟΥ </option>
                                    </select>                                          
                                </div>
                            </div>
                                                                                                                                                                                                                                     
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> FOE Track Number : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="track2" name="track2" class="form-control" placeholder="Track Number" required="track2">
                                    <span class="errorFeedback errorSpan" id="track2Error">Track Number Sign  should be only capital letters </span>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Results : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="result" name="result" class="form-control" placeholder=" Results " required="result">
                                    <span class="errorFeedback errorSpan" id="resultError">Results  should be only capital letters </span>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Area : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="area" name="area" class="form-control" placeholder=" Area " required="area">
                                    <span class="errorFeedback errorSpan" id="areaError">Area  should be only capital letters </span>
                                </div> 
                            </div> 
                            
                             <div class="form-group">
                                <label class="col-sm-2 control-label"> date Of Mission  : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="mdate" name="mdate" class="form-control date datepicker" required="mdate" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>           
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label"> Time : </label>
                                <div class="input-group date col-sm-2" >
                                    <?php
                                    $MyTime = "12:00";
                                    echo "<input type=\"text\" id=\"mtime\" name=\"mtime\" class=\"form-control time timepicker\"  required=\"mtime\" value=" . $MyTime . ">";                                 
                                    echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-time\"></i></span>"
                                    ?>                                       
                                </div>  
                            </div>                                                        
                                     
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> LIVE /SIM : </label>
                                <div class="col-sm-2">                                    
                                    <select class="form-control" id="scope" name="scope" required="scope">
                                        <option value="" selected disabled> LIVE / SIM </option>
                                        <option class="text-primary" value="LIVE">LIVE</option>
                                        <option class="text-primary" value="SIM">SIM</option>                                        
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Remarks : </label>
                                <div class="col-sm-4">
                                    <textarea  id="remark" name="remark" class="form-control" rows="2" placeholder="Remarks"></textarea>
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

        <!-- Datepicker Theme -->
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/locales/bootstrap-datepicker.el.min.js"></script>
        <script type="text/javascript" src="../js/add_missions.js"></script>

        <!-- Timepicker -->
        <script type="text/javascript" src="../bower_components/jquery-timepicker-wvega/jquery.timepicker.js"></script>    


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
        
        <script type="text/javascript">            
            $('.timepicker').timepicker({
            timeFormat: 'HH:mm',
            interval: 1,
            defaultTime: '12',
            dynamic: false,
            dropdown: true,
            scrollbar: true
            });
        </script>
        
    </body>

</html>
