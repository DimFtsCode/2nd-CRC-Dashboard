<?php
require_once("../php_functions/functions.inc");

if (!$_SESSION['ValidUser'][1]  == "yes") {
    die(header("Location: login.php"));
}
$_SESSION['ValidUser'][1]  = "";

$MyAsma = $_SESSION['ValidUser'][2];        
?>
<!DOCTYPE html>
<html lang="en">  

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Reset User Password </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Reset User Password   </strong> </a>

                </div>

                
            </nav>

            <!-- /# page wrapper -->   
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"> Αλλαγή / Reset PASSWORD Προσωπικού </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_reset_password" class="form-horizontal" action="../php_functions/password_reset.php" method="POST">
                            <div id="errorDiv"> 
                                <?php
                                if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
                                    unset($_SESSION['formAttempt']);
                                    //print "Errors encountered<br />\n";
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
                                    <input type="text" id="asma" name="asma" class="form-control" placeholder="asma" required="asma" value="<?php print $MyAsma;  ?>" readonly  >
                                    <span class="errorFeedback errorSpan" id="asmaError">ΑΣΜΑ should be only numbers</span>
                                    </div>
                                </div>
                            </div>
                                                                                                           
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> New password : </label>
                                 <div class="col-sm-4">
                                     <div class="input-group mb-3">
                                         <input  type="password" id="password" name="password" class="form-control" placeholder="password" required="password" >
                                         <span class="errorFeedback errorSpan" id="passwordError"> Password length should be at least seven(7) characters  </span>
                                    </div>
                                </div>
                            </div>                               
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Retype new password : </label>
                                 <div class="col-sm-4">
                                     <div class="input-group mb-3">
                                         <input  type="password" id="password2" name="password2" class="form-control" placeholder="password" required="password2" >
                                         <span class="errorFeedback errorSpan" id="password2Error"> Passwords DO NOT match </span>
                                    </div>
                                </div>
                            </div>                                                         
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ID number : </label>
                                 <div class="col-sm-4">
                                     <div class="input-group mb-3">
                                         <input  type="text" id="idnumber" name="idnumber" class="form-control" placeholder="idnumber" required="idnumber" > 
                                         <span class="errorFeedback errorSpan" id="idnumberError"> ID number should be only digits </span>
                                    </div>
                                </div>
                            </div>                                                         
                                                       
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button id="submit" type="submit" class="btn btn-default">Change password</button>
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
        
        <script type="text/javascript" src="../js/reset_password.js"></script>



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
