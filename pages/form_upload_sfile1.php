<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));   
}

if (!($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "ADP+")) { 
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

        <title> Form Upload Static File </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Upload File </strong> </a>

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
                            <h1 class="page-header"> Upload File to Division </h1>
                        </div>
                                                                        
                        
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_upload_file" class="form-horizontal" action="../php_functions/upload_sfile1.php" method="POST" enctype="multipart/form-data">
                           
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
                                <label class="col-sm-2 control-label"> ΕΠΙΣΤΑΣΙΑ : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="myDiv" name="myDiv" required>
                                        <option value="" selected disabled> ΕΠΙΣΤΑΣΙΑ </option>
                                        <option class="text-primary" value="ΔΚΤΗΣ">ΔΚΤΗΣ</option>  
                                        <option class="text-primary" value="ΥΔΚΤΗΣ">ΥΔΚΤΗΣ</option>
                                        <option class="text-primary" value="ΕΠΙΤΕΛΕΙΟ">ΕΠΙΤΕΛΕΙΟ</option>
                                        <option class="text-primary" value="ΔΕΕ">ΔΕΕ</option>
                                        <option class="text-primary" value="ΔΥΠ">ΔΥΠ</option>
                                        <option class="text-primary" value="ΜΕ">ΜΕ</option>                                        
                                        <option class="text-primary" value="ΜΥΠ">ΜΥΠ</option>
                                        <option class="text-primary" value="ΣΑΦ">ΣΑΦ</option>
                                        <option class="text-primary" value="ΣΕΦ">ΣΕΦ</option>
                                        <option class="text-primary" value="ΣΕΕΠ">ΣΕΕΠ</option>
                                    </select>                                          
                                </div>
                            </div>
                             
                            <div class="form-group">                       
                                <label class="col-sm-2 control-label">ΠΕΡΙΓΡΑΦΗ : </label>                            
                                <div class="col-sm-4">
                                    <input type="description" id="description" name="description" class="form-control" placeholder="description" required="description" >
                                    <span class="errorFeedback errorSpan" id="descriptionError">Description  should be only capital letters </span>
                                </div>                           
                            </div>  
                            
                  
                            
                   
                            
                  
                            
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΘΕΣΗ ΤΟΥ ΕΓΓΡΑΦΟΥ : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="fplace" name="fplace" required="fplace">
                                      <?php
                                        for ($arx = 1; $arx < 60; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                            
                            <?php
                                    echo nl2br("**************** *************************** ************** *************************** ************** ************** *************************** **************");
                             ?>    
                            
                             <div class="form-group">
                            <p>Select File to upload: :</p>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            </div>  
                            
                                                                                                                
                            <input type="submit" value="Upload File" name="submit">
                            
                                                                                                                
                                                                                                                


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
        
        <script type="text/javascript" src="../js/upload_sfile.js"></script>



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




