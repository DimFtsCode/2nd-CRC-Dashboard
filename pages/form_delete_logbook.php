<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role == "EXER" || $user->role2 == "EXER+")) {  
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

        <title> Form Delete Log Record </title> 
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Delete Log Record </strong> </a>
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
                               <a href="form_view_logbook.php"><i class="glyphicon glyphicon-fire"></i> Προβολή Ημερολογίου ΚΕΠΙΧ </a>
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
                            <h1 class="page-header"> Διαγραφή Εγγραφής  Ημερολογίου </h1>                             
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_delete_logbook" class="form-horizontal" action="../php_functions/logbook_delete.php" method="POST">                           

                            <div class="form-group">
                                <legend class="col-sm-2 control-label"> Log Record Information  </legend> 
                                 
                            </div> 
                            
                            <div>
<!--                                <button type="button" id="btn_delete" name ="btn_delete" style="background-color: yellow" style="font-size: larger"> Delete Record </button>-->
                                <span id="delete_btn" style="background-color: red"> You must select a Log Record prior to DELETE it ! </span>                                                            
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
                                <label class="col-sm-2 control-label">  Log Record ID : </label>
                                <div class="col-sm-4">
                                    
                                    <select class="form-control"  id="log_id" name="log_id" required="log_id" readonly >
                                        <option value="" selected disabled> log_id </option>
                                        <?php
                                        require_once ("../php_functions/db_config/db_connect.php");
                                        $db = new DbMgmt;                                        
                                        $sql = "SELECT * FROM `logbook` ORDER BY `log_id` DESC ";                                        
                                        $air_id = $db->runQuery($sql);
                                        while ($row_air = mysqli_fetch_array($air_id)) {
                                            echo "<option value=\"" . $row_air['log_id'] . "\">" . $row_air['log_id'] . " -- ". $row_air['mdate'] . " -- ". $row_air['mtime'] ."</option>";
                                        }
                                        ?>                                         
                                    </select>
                                </div>
                            </div>     
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Περιγραφή : </label>
                                <div class="col-sm-4">
                                    <textarea  id="description" name="description" class="form-control" rows="3" placeholder="Description" required="description"></textarea>
                                </div>
                            </div>                                 
                            
                             <div class="form-group">
                                <label class="col-sm-2 control-label"> date Of Log  : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="mdate" name="mdate" class="form-control date datepicker" required="mdate" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>                                                                                                      
                                                                                                                                                                                                                                                                                                                                                                                           
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button type="submit" class="btn btn-default" id="submit" name="submit" style="font-size: x-large"> Delete Log Record</button> 
                                    <div id="delete_btn" style="background-color: red" style="font-size: x-large"> Are you sure ?? DELETE the Log Record ?? </div>
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
                                    if ($user->role == "SYS" || $user->role2 == "EXER+") {
                                        echo "<td class=\"delete_all\"> <a class=\"btn  btn-primary\" href=\"../php_functions/logbook_all_delete.php\" >" . "DELETE ALL Log Records " . " </a> </td>";
                                    } else {
                                        echo "<td class=\"delete_all\"> <a class=\"btn btn-outline btn-primary\" >" . "DELETE ALL ALL Log Records" . "  </a> </td>";
                                    }
                                    
                                    //echo "<span id=\"delete_all_info\" style=\"background-color: red\" style=\"font-size: x-large\"> Are you sure ?? DELETE ALL the Missions ?? </span>";
                                   
                                    ?>
                                    <div id="delete_all_info" style="background-color: red" style="font-size: 18px"> Are you sure ?? DELETE ALL ALL Log Records ?? </div>
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
                                    if ($user->role == "SYS" || $user->role2 == "EXER+") {
                                        echo "<td class=\"alter_table\"> <a class=\"btn  btn-primary\" href=\"../php_functions/logbook_alter_table.php\" >" . "RESET TABLE" . " </a> </td>";
                                    } else {
                                        echo "<td class=\"alter_table\"> <a class=\"btn btn-outline btn-primary\" >" . "RESET TABLE" . "  </a> </td>";
                                    }
                                    //echo "<span id=\"alter_table_info\" style=\"background-color: yellow\"> Are you sure ?? Reset Table ?? </span>";
                                    ?>
                                    <div id="alter_table_info" style="background-color: yellow" style="font-size: 18px"> Are you sure ?? Reset Table ?? </div>
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
        
        <script type="text/javascript" src="../js/delete_logbook.js"></script> 

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
