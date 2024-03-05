<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));   
}

if (!($user->role == "SYS" || $user->role == "MED" || $user->role2 == "MED+")) { 
     die(header("Location: dashboard.php"));
 }
 
$myAsma = $user->asma;
$myIndex = $myAsma . "ASMA";
$myUser = $_SESSION[$myIndex];
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Form Add Medata to Personnel </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Add Med Data to Personnel </strong> </a>

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
                            <h1 class="page-header"> Εισαγωγή Ιατρικών Στοιχείων+ σε Προσωπικό </h1>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                            <div class="col-sm-4">
                                <!--<input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" style="display:none"  readonly>-->  
                                 <input type="text" id="userAsma" name="userAsma" class="form-control" style="display:none" value="<?php $myVar = $user->asma;  $myVar = $myVar . "XID";echo $_SESSION[$myVar]?>"  >
                            </div>
                        </div>   
                        
                                                                        
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_tpye_asma" class="form-horizontal" action="../php_functions/medata_insert.php" method="POST">
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
                                     <div class="input-group mb-3">
                                         <input  type="text" id="asma" name="asma" class="form-control" placeholder="asma"  readonly>
                                    <!--<span class="input-group-btn"><button class="btn btn-outline-secondary" type="button" id="btn_asma" name ="btn_asma">Select Person by ASMA </button></span>-->                                    
                                    </div>
                                </div>
                            </div> 
                            <div> <span class="errorFeedback errorSpan" id="asmaError">ΑΣΜΑ should be only numbers</span></div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΒΑΘΜΟΣ : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="rank" name="rank" class="form-control" placeholder="rank"  readonly>
                                    <span class="errorFeedback errorSpan" id="rankError">Rank  should be only capital letters </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">specialty : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" readonly>
                                    <span class="errorFeedback errorSpan" id="specialtyError">Specialty  should be only capital letters </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last Name : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="last_name"  readonly>
                                    <span class="errorFeedback errorSpan" id="last_nameError">Last Name  should be only capital letters </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">First Name : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="first_name" readonly>
                                    <span class="errorFeedback errorSpan" id="first_nameError">First Name  should be only capital letters </span>
                                </div>
                            </div>                                                                                           
                            
                             <?php
                                    echo nl2br("**************** *************************** ************** *************************** ************** *************************** **************");
                              ?>  

                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Ιατρικός Φάκελος : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="medfolder_yn" name="medfolder_yn" >
                                        <option value="" selected disabled> MedFolder Y/N </option>
                                        <option class="text-primary" value="No"> No </option>
                                        <option class="text-primary" value="Yes"> Yes </option>                                                                            
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Θέση Ιατρικού Φακέλου : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="medfolder_loc" name="medfolder_loc" class="form-control" placeholder="medfolder_loc">
                                    <span class="errorFeedback errorSpan" id="medfolder_loc_nameError">Med Folder loc should be only capital letters </span>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="display:none"> Φάκελος Eκπαίδευσης: </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="trfolder_yn" name="trfolder_yn" style="display:none">
                                        <option value="" selected disabled> trfolder Y/N </option>
                                        <option class="text-primary" value="No"> No </option>
                                        <option class="text-primary" value="Yes"> Yes </option>                                                                            
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="display:none"> Θέση Φακέλου ΕΚΠ: </label>
                                <div class="col-sm-4">
                                    <input type="text" id="trfolder_loc" name="trfolder_loc" class="form-control" placeholder="trfolder_loc" style="display:none">
                                    <span class="errorFeedback errorSpan" id="trfolder_loc_nameError">TR Folder loc should be only capital letters </span>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="display:none"> Ατομικό Μητρώο : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="abm_yn" name="abm_yn" style="display:none">
                                        <option value="" selected disabled> ABM Y/N </option>
                                        <option class="text-primary" value="No"> No </option>
                                        <option class="text-primary" value="Yes"> Yes </option>                                                                            
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label" style="display:none"> Θέση Ατομικού Μητρώου: </label>
                                <div class="col-sm-4">
                                    <input type="text" id="abm_loc" name="abm_loc" class="form-control" placeholder="abm_loc" style="display:none">
                                    <span class="errorFeedback errorSpan" id="abm_loc_nameError">ABM should be only capital letters </span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Είδος Εξέτασης : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="tpye" name="tpye" >
                                        <option value="" selected disabled> Είδος Εξέτασης </option>
                                        <option class="text-primary" value="ΕΤΗΣΙΑ"> ΕΤΗΣΙΑ </option>  
                                        <option class="text-primary" value="ΔΙΕΤΗΣΙΑ"> ΔΙΕΤΗΣΙΑ </option>
                                        <option class="text-primary" value="ΠΕΡΙΟΔΙΚΗ ΕΞΕΤΑΣΗ"> ΠΕΡΙΟΔΙΚΗ ΕΞΕΤΑΣΗ </option>   
                                    </select>                                          
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label class="col-sm-2 control-label"> Ομάδα Αίματος: </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="blood" name="blood" >
                                        <option value="" selected disabled> Blood type </option>
                                        <option class="text-primary" value="A"> A </option>  
                                        <option class="text-primary" value="B"> B </option>
                                        <option class="text-primary" value="AB"> AB </option>
                                        <option class="text-primary" value="A+"> A+ </option>
                                        <option class="text-primary" value="B+"> B+ </option>
                                        <option class="text-primary" value="O+"> O+ </option>
                                        <option class="text-primary" value="O-"> O- </option>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΒΑΡΟΣ: </label>
                                <div class="col-sm-4">
                                    <input type="text" id="weight" name="weight" class="form-control" placeholder="weight">                                    
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΥΨΟΣ: </label>
                                <div class="col-sm-4">
                                    <input type="text" id="height" name="height" class="form-control" placeholder="height">                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΕΜΒΟΛΙΑ: </label>
                                <div class="col-sm-4">
                                    <input type="text" id="vaccin" name="vaccin" class="form-control" placeholder="vaccinations">                                    
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
        
        <script type="text/javascript" src="../js/add_medata_asma.js"></script>



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

