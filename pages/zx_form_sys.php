<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" )) {  
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

        <title> SYS Functions </title> 
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        
         <link rel="stylesheet" type="text/css"  href="../styles/form_delete_logbook.css">

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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> SYS Functions </strong> </a>
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
                               <a href="admin_dashboard.php"><i class="glyphicon glyphicon-fire"></i> Admin </a>
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
                            <h1 class="page-header"> System Functions </h1>                             
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_delete_logbook" class="form-horizontal" action="../php_functions/zx_add_many_rows.php" method="POST">                           

                            <div class="form-group">
                                <legend class="col-sm-2 control-label"> SYS Information  </legend> 
                                 
                            </div> 
<!--                            
                            <div>
                                <button type="button" id="btn_delete" name ="btn_delete" style="background-color: yellow" style="font-size: larger"> Delete Record </button>
                                <span id="delete_btn" style="background-color: red"> You must select a Log Record prior to DELETE it ! </span>                                                            
                            </div>    -->

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
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" class="btn btn-default" id="submit" name="submit" style="font-size: x-large"> Delete Log Record</button> 
                                    <!--<div id="delete_btn" style="background-color: red" style="font-size: x-large"> Are you sure ?? DELETE the Log Record ?? </div>-->
                                </div>
                            </div>
                            
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">    
                                    <?php
                                    if ($user->role == "SYS" ) {
                                        echo "<td class=\"delete_all\"> <a class=\"btn  btn-primary\" href=\"../php_functions/zx_del_all_records.php\" >" . "DELETE ALL Records " . " </a> </td>";
                                    } else {
                                        echo "<td class=\"delete_all\"> <a class=\"btn btn-outline btn-primary\" >" . "DELETE ALL Records" . "  </a> </td>";
                                    }
                                    
                                    //echo "<span id=\"delete_all_info\" style=\"background-color: red\" style=\"font-size: x-large\"> Are you sure ?? DELETE ALL the Missions ?? </span>";
                                   
                                    ?>
                                    <!--<div id="delete_all_info" style="background-color: red" style="font-size: 18px"> Are you sure ?? DELETE ALL ALL Log Records ?? </div>-->
                                </div>    
                            </div>
                            
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>
                            </br>                                                                                    
                            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">    
                                    <?php
                                    if ($user->role == "SYS" ) {
                                        echo "<td class=\"alter_table\"> <a class=\"btn  btn-primary\" href=\"../php_functions/zx_alter_table.php\" >" . "RESET TABLE" . " </a> </td>";
                                    } else {
                                        echo "<td class=\"alter_table\"> <a class=\"btn btn-outline btn-primary\" >" . "RESET TABLE" . "  </a> </td>";
                                    }
                                    //echo "<span id=\"alter_table_info\" style=\"background-color: yellow\"> Are you sure ?? Reset Table ?? </span>";
                                    ?>
                                    <div id="alter_table_info" style="background-color: yellow" style="font-size: 18px"> Are you sure ?? Reset Table ?? </div>
                                </div>    
                            </div>
                            
                            </br>
                            
                             <div class="form-group">
                                <label class="col-sm-2 control-label"> Number of Place : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="numof" name="numof" required="numof">
                                      <?php
                                        for ($arx = 41; $arx < 60; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                      ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                             </br>
                            
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" class="btn btn-default" id="submit" name="submit"> Add Record to Table</button>
                                </div>
                            </div>
                            
                            
                              
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">    
                                    <?php
                                    if ($user->role == "SYS" ) {
                                        echo "<td class=\"alter_table\"> <a class=\"btn  btn-primary\" href=\"../php_functions/zx_add_many_rows.php\" method=\"POST\">" . "ADD MANY ROWS to TABLE" . " </a> </td>";
                                    } else {
                                        echo "<td class=\"alter_table\"> <a class=\"btn btn-outline btn-primary\" >" . "ADD MANY ROWS to TABLE" . "  </a> </td>";
                                    }
                                    //echo "<span id=\"alter_table_info\" style=\"background-color: yellow\"> Are you sure ?? Reset Table ?? </span>";
                                    ?>
                                    <div id="alter_table_info" style="background-color: yellow" style="font-size: 18px"> Are you sure ?? Add Rows to Table ?? </div>
                                </div>    
                            </div>
                            
                            
                            
                            
                           
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
        
        <script type="text/javascript" src="../js/zx_sys.js"></script> 

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

