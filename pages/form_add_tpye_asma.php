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

        <title> Form Add TPYE to Personnel </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Add TPYE to Personnel </strong> </a>

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
                            <h1 class="page-header"> Εισαγωγή Τακτικής Περιοδικής Υγ. Εξέτασης (ΤΠΥΕ) σε Προσωπικό </h1>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                            <div class="col-sm-4">       
                                 <input type="text" id="userAsma" name="userAsma" class="form-control" style="display:none" value="<?php echo $myUser; ?>"  >
                            </div>
                        </div>   
                        
                        
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_tpye_asma" class="form-horizontal" action="../php_functions/tpye_insert.php" method="POST">
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
                            
                           <div class="form-group">
                                <label class="col-sm-2 control-label">HOSPITAL : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="hospital" name="hospital" required>
                                         <option value="" selected disabled>  Hospital </option>
                                        <option class="text-primary" value="251 ΓΝΑ">251 ΓΝΑ</option>  
                                        <option class="text-primary" value="404 ΓΣΝΛ">404 ΓΣΝΛ</option>  
                                        <option class="text-primary" value="424 ΓΣΝΕ">424 ΓΣΝΕ</option>
                                        <option class="text-primary" value="414 ΣΝΕΝ">414 ΣΝΕΝ</option>
                                        <option class="text-primary" value="ΓΝΣΛ">ΓΝΣΛ</option>
                                        <option class="text-primary" value="ΠΓΝΛ">ΠΓΝΛ</option>
                                    </select>                                  
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΕΙΔΟΣ ΕΞΕΤΑΣΗΣ : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="exam_type" name="exam_type" required>
                                         <option value="" selected disabled>  exam type </option>
                                        <option class="text-primary" value="ΕΤΗΣΙΑ">ΕΤΗΣΙΑ</option>
                                        <option class="text-primary" value="ΑΡΧΙΚΗ ΕΤΗΣΙΑ">ΑΡΧΙΚΗ ΕΤΗΣΙΑ</option>
                                        <option class="text-primary" value="ΑΡΧΙΚΗ ΕΝΤΑΞΗ">ΑΡΧΙΚΗ ΕΝΤΑΞΗ</option>
                                        <option class="text-primary" value="ΔΙΕΤΗΣΙΑ">ΔΙΕΤΗΣΙΑ</option>
                                        <option class="text-primary" value="ΠΕΡΙΟΔΙΚΗ ΕΞΕΤΑΣΗ">ΠΕΡΙΟΔΙΚΗ ΕΞΕΤΑΣΗ</option> 
                                        <option class="text-primary" value="ΕΞΕΤΑΣΕΙΣ">ΕΞΕΤΑΣΕΙΣ</option>
                                        <option class="text-primary" value="ΕΛΕΓΧΟΣ">ΕΛΕΓΧΟΣ</option>
                                        <option class="text-primary" value="ΕΙΣΑΓΩΓΗ">ΕΙΣΑΓΩΓΗ</option>
                                        <option class="text-primary" value="ΕΠΑΝΕΞΕΤΑΣΗ">ΕΠΑΝΕΞΕΤΑΣΗ</option>
                                        <option class="text-primary" value="ΑΝΑΡΡΩΤΙΚΗ ΑΔΕΙΑ">ΑΝΑΡΡΩΤΙΚΗ ΑΔΕΙΑ</option>
                                        <option class="text-primary" value="ΕΛΕΥΘΕΡΟΣ ΥΠΗΡΕΣΙΑΣ">ΕΛΕΥΘΕΡΟΣ ΥΠΗΡΕΣΙΑΣ</option>
                                        <option class="text-primary" value="ΑΛΛΟΔΑΠΗ">ΑΛΛΟΔΑΠΗ</option>
                                        <option class="text-primary" value="ΑΛΛΟ">ΑΛΛΟ</option>
                                    </select>                                  
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
                                <label class="col-sm-2 control-label"> End date : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="date_end" name="date_end" class="form-control date datepicker" >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>  
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΑΡΧΗ ΕΚΔΟΣΗΣ ΑΠΟΦ. : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="aea" name="aea" >
                                         <option value="" selected disabled>  authority </option>
                                        <option class="text-primary" value="ΑΑΥΕ">ΑΑΥΕ</option>  
                                        <option class="text-primary" value="ΤΠΥΕ">ΤΠΥΕ</option>  
                                        <option class="text-primary" value="ΚΑΙ">ΚΑΙ</option>
                                        <option class="text-primary" value="251 ΓΝΑ">251 ΓΝΑ</option>
                                        <option class="text-primary" value="424 ΓΝΣΕ">424 ΓΝΣΕ</option>
                                        <option class="text-primary" value="414 ΣΝΕΝ">414 ΣΝΕΝ</option>
                                        <option class="text-primary" value="404 ΓΝΣΛ">404 ΓΝΣΛ</option>
                                        <option class="text-primary" value="110ΠΜ/ΥΥ">110ΠΜ/ΥΥ </option>
                                    </select>                                  
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Αρ. Απόφασης : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="rmknum" name="rmknum" class="form-control" value="1" placeholder="rmknum">
                                    <span class="errorFeedback errorSpan" id="rmknumError">Remark number should be only numbers </span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Περιγραφή Απόφασης : </label>
                                <div class="col-sm-4">
                                    <textarea  id="message" name="remark" class="form-control" rows="4" placeholder="remark" ></textarea>
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
        
        <script type="text/javascript" src="../js/add_tpye_asma.js"></script>



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

