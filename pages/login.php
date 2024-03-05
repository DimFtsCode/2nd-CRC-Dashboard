<?php

require_once("../php_functions/functions.inc");

?>

<!DOCTYPE html>
<html lang="eng">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Είσοδος / Log in </title>

        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="/bower_components/bootstrap/html5shiv.js" type="text/javascript"></script>
            <script src="/bower_components/bootstrap/respond.min.js" type="text/javascript"></script>
        <![endif]-->

        <!-- Custom Theme JavaScript -->
        <script type="text/javascript" src="../js/login.js"></script> 
        <script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
        
        <!-- jQuery -->
       <!--  <script src="../bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
      <!--   <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
      <!--  <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
               
       <!-- <script src="../dist/js/sb-admin-2.js"></script>
       <!-- <script src="../bower_components/bootstrap/placeholders.js" type="text/javascript"></script>
       <!-- <script src="../bower_components/bootstrap/better-placeholder-polyfill.js" type="text/javascript"></script>

       <!--  <script src="../php_functions/loadSection.js" type="text/javascript"></script> -->
        
    </head>

    <body>
        <div class="container" id="wrap">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Είσοδος / Log in  </h3>
                        </div>
                        <div class="panel-body">
                            <form id="loginForm" action="../php_functions/login-process.php" method="post" role="form">
                                <fieldset>  
                                    <legend>
                                         <?php  
                                         //$myError = "xxxxxxx";
                                         //print $_SESSION['MyError'][1] . "<br />\n";
                                         //
                                         //print "test"; 
                                         ?>
                                    </legend>
                                    
                                    <div id="errorDiv">
                                        <?php
                                        //print $myError;
                                        if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
                                            unset($_SESSION['formAttempt']);
                                            print "Errors encountered<br />\n";
                                            foreach ($_SESSION['error'] as $error) {
                                                print $error . "<br />\n";
                                            } //end foreach
                                            //print $_SESSION['MyError'][0];
                                        } //end if
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="asma" name="asma" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="password" name="password" type="password" value="">
                                    </div>
                                     <!--  <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div> -->
                                    <!-- Change this to a button or input when using this as a form -->
                                    <!--<a href="index.html" class="btn btn-lg btn-success btn-block">Είσοδος</a>-->
                                    <button type="submit" id="submit" class="btn btn-lg btn-success btn-block" name="submit"> Είσοδος / Log in </button>
                                    <!-- Trigger the modal with a button -->

                                    <span><?php echo $_error; ?></span>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </body>

</html>

