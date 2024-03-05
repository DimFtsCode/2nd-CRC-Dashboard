<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));   
}

if (!($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY")) {
     die(header("Location: dashboard.php"));
 }
 
$myAsma = $user->asma;
$myIndex = $myAsma . "SUPPLY";
$myIndex1 = $myAsma . "BRANCH";
$myIndex2 = $myAsma . "BRANCH2";

$mySupply = $_SESSION[$myIndex];
$myBranchID = $_SESSION[$myIndex1];
$myBranchName = $_SESSION[$myIndex2];
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Form Detail Supply </title>
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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Detail Supply </strong> </a>

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
                            <h1 class="page-header"> Αναλυτική Προβολή / Διαγραφή Εντολής Αγοράς-Εργασίας </h1>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                            <div class="col-sm-4">       
                                 <input type="text" id="userAsma" name="userAsma" class="form-control"  style="display:none" value="<?php $myVar = $user->asma;  echo $myVar?>"  >
                                 <input type="text" id="mySupply" name="mySupply" class="form-control" style="display:none" value="<?php echo $mySupply; ?>"  >
                                 <input type="text" id="brc" name="brc" class="form-control" style="display:none" value="<?php echo $myBranchName; ?>"  >
                            </div>
                        </div>   
                        
                        
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_detail_supply" class="form-horizontal" action="../php_functions/supply_delete.php" method="POST">
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
                                <label class="col-sm-2 control-label">Supply ID : </label>
                                <div class="col-sm-2">
                                    <input type="text" id="supid" name="supid" class="form-control" placeholder="Supply ID" readonly>                                    
                                </div>
                            </div>                                
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Α/Α : </label>
                                <div class="col-sm-2">
                                    <input type="text" id="serial" name="serial" class="form-control" placeholder="ΑΥΞΩΝ ΑΡΙΘΜΟΣ ΕΝΤΟΛΗΣ" required="serial" readonly>
                                    <span class="errorFeedback errorSpan" id="serialError">Serial should be only numbers</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Ημερομηνία Εντολής  : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="sdate" name="sdate" class="form-control date datepicker" placeholder="Ημερομηνία Εντολής Αγοράς" required="sdate" readonly>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>                                                          
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΕΤΟΣ : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="year" name="year" required="year" readonly>
                                      <option value="" selected disabled> ΕΤΟΣ ΕΝΤΟΛΗΣ </option>  
                                      <?php
                                        for ($arx = 2021; $arx < 2062; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Περιγραφή : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="description" name="description" class="form-control" placeholder="ΠΕΡΙΓΡΑΦΗ ΠΡΟΪΟΝΤΩΝ ή ΕΡΓΑΣΙΩΝ" required="description" readonly>
                                    <span class="errorFeedback errorSpan" id="descriptionError">Description  should be only capital letters </span>
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Επιστασία : </label>
                                <div class="col-sm-4">

                                    <select class="form-control"  id="directorate"  name="directorate" required="directorate" readonly>
                                        <option value="" selected disabled> directorate </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `divisions` ORDER BY `id` ";
                                        $div = $db->runQuery($sql);
                                        while ($row_div = mysqli_fetch_array($div)) {
                                            echo "<option value=\"" . $row_div['id'] . "\">" . $row_div['description'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>
                               <!-- <div> <span id="division_info">You must select again directorate and branch</span></div>-->
                            </div>                            
                                                         
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Τμήμα : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="branch" name="branch" readonly>
                                        <option value="" selected disabled> branch </option>
                                        <?php echo "<option value=\"" . $myBranchID . "\">" . $myBranchID . ", ". $myBranchName . "</option>"; ?>                                       
                                        
                                    </select>                                  
                                </div>
                              <!--  <div> <span id="branch_info"> The previous was : => . </span>
                                   <span id="branch_info2">  </span></div>-->
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">POC, Χειριστής : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="poc" name="poc" class="form-control" placeholder="ΧΕΙΡΙΣΤΗΣ ΕΝΤΟΛΗΣ, ΒΑΘΜΟΣ ΕΙΔΙΚ. ΠΛΗΡΕΣ ΟΝΟΜΑ " required readonly>
                                     <span class="errorFeedback errorSpan" id="pocError">POC should be only capital letters and . , -</span>
                                </div> 
                            </div>
                            
                             <div class="form-group">
                                <label class="col-sm-2 control-label">Εκτ. Κόστος (€): </label>
                                <div class="col-sm-4">
                                    <input type="text" id="cost" name="cost" class="form-control" placeholder="ΚΟΣΤΟΣ, ΜΟΝΟ ΑΡΙΘΜΟΙ" required="cost" readonly>
                                   <span class="errorFeedback errorSpan" id="costError">Cost  should be only numbers .. </span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Budget : </label>
                                <div class="col-sm-6">
                                    <input type="text" id="budget" name="budget" class="form-control" placeholder="ΠΕΡΙΓΡΑΦΗ ΧΡΗΜΑΤΟΔΟΤΗΣΗΣ, ΠΑΚΕΤΟ" readonly>                                      
                                </div>
                            </div>                         

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Είδος Εντολής : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="type_order" name="type_order" required readonly>
                                        <option value="" selected disabled> Είδος Εντολής </option>
                                        <option class="text-primary" value="ΑΓΟΡΑ">ΕΝΤΟΛΗ ΑΓΟΡΑΣ</option>  
                                        <option class="text-primary" value="ΕΡΓΑΣΙΑ">ΕΝΤΟΛΗ ΕΡΓΑΣΙΑΣ</option>  
                                    </select>                                  
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">ΥΠΗΡΕΣΙΑΚΟ : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="order" name="order" class="form-control" placeholder="ΣΧΕΤΙΚΑ ΤΟΥ ΥΣ" required readonly>
                                     <span class="errorFeedback errorSpan" id="orderError">Order should be only capital letters and . , -</span>
                                </div> 
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΥΣ ΙΡΙΔΑ Link : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="link" name="link" class="form-control" placeholder="ΥΠΕΡΣΥΝΔΕΣΗ ΥΣ στο ΙΡΙΔΑ" required="link" readonly>                                    
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Έγκριση Χρηματοδότησης : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="funded" name="funded"  readonly>
                                        <option value="" selected disabled> Έγκριση Χρηματοδότησης από ΔΟΥ </option>
                                        <option class="text-primary" value="No">ΟΧΙ</option>  
                                        <option class="text-primary" value="Yes">ΝΑΙ</option>  
                                    </select>                                  
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label class="col-sm-2 control-label"> Παραλαβή από Επιτροπή : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="rdate" name="rdate" class="form-control date datepicker" placeholder="Ημερομηνία Παραλαβής από Πρόεδρο" readonly>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Τοποθέτηση Παραγγελίας : </label>
                                <div  class="input-group date col-sm-2" >
                                    <input type="text" id="ordate" name="ordate" class="form-control date datepicker" placeholder="Ημερομηνία Παραγγελίας" readonly >
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΠΡΟΜΗΘΕΥΤΗΣ : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="orplace" name="orplace" class="form-control" placeholder="ΠΡΟΜΗΘΕΥΤΗΣ ΠΑΡΑΓΓΕΛΙΑΣ" readonly >                                   
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> ΤΙΜΟΛΟΓΙΟ : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="invoice" name="invoice" class="form-control" placeholder="ΑΡΙΘΜΟΣ ΤΙΜΟΛΟΓΙΟΥ & ΠΡΟΜΗΘΕΥΤΗΣ" readonly >                                   
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Τελικό Κόστος (€): </label>
                                <div class="col-sm-4">
                                    <input type="text" id="fcost" name="fcost" class="form-control" placeholder="ΤΕΛΙΚΟ ΚΟΣΤΟΣ, ΜΟΝΟ ΑΡΙΘΜΟΙ" readonly>
                                   <span class="errorFeedback errorSpan" id="fcostError"> Final Cost  should be only numbers </span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Κατάσταση, Status : </label>
                                <div class="col-sm-4">
                                    <select class="form-control" id="status" name="status" required readonly>
                                        <option value="" selected disabled> ΚΑΤΑΣΤΑΣΗ, Status </option>
                                        <option class="text-primary" value="ΣΕ ΕΞΕΛΙΞΗ">ΣΕ ΕΞΕΛΙΞΗ</option>
                                        <option class="text-primary" value="ΕΝΤΟΣ ΜΟΝΑΔΑΣ">ΕΝΤΟΣ ΜΟΝΑΔΑΣ</option>  
                                        <option class="text-primary" value="ΟΛΟΚΛΗΡΩΜΕΝΗ">ΟΛΟΚΛΗΡΩΜΕΝΗ</option>
                                        <option class="text-primary" value="ΑΚΥΡΩΘΗΚΕ">ΑΚΥΡΩΘΗΚΕ</option>
                                    </select>                                  
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Παρατηρήσεις: </label>
                                <div class="col-sm-8">
                                    <input type="text" id="remark" name="remark" class="form-control" placeholder="ΠΑΡΑΤΗΡΗΣΕΙΣ" readonly>                                   
                                </div>
                            </div> 
                            
                            </br>
                            </br>                            
                                                                                                                
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    
                                    <?php                                        
                                        if ($user->role == "SYS" || $user->role == "CMD") {
                                            echo "<button id=\"submit\" type=\"submit\" class=\"btn btn-default\">DELETE</button>";
                                        }
                                    ?>  
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
        
        <script type="text/javascript" src="../js/detail_supply.js"></script>



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
            //setTimeout(function () { location.reload(true); }, 500);
        </script> 
    </body>

</html>

