<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));   
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

        <title> Form Add SSA Exer </title>
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
        
        <!-- Custom Style -->
        <link href="../styles/form_add_intercept.css" type="text/css" rel="stylesheet"  >

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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Εισαγωγή Ασκήσεων SSA </strong> </a>
                    <a class="navbar-brand" href="#"> <strong style="color: blue; ">  Προβολή Ασκήσεων SSA  </strong> </a> 

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
                            <h1 class="page-header"> Εισαγωγή Ασκήσεων SSA / SAM </h1>
                            <h3 class="page-header"> Μοίρα Επιχειρήσεων  </h3>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_add_exssa" class="form-horizontal" action="../php_functions/exssa_insert.php" method="POST">
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
                            
                            
                                                        
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">ΑΣΜΑ</label>                                    
                                    <input  type="text" id="asma" name="asma" class="form-control" placeholder="asma"  value="<?php echo $user->asma; ?>" required="asma"  readonly>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">ΒΑΘΜΟΣ</label>
                                    <input type="text" id="rank" name="rank" class="form-control" placeholder="rank" required="rank" readonly>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">ΕΙΔ </label>
                                    <input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" required="specialty" readonly>
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                   <label class="col-sm-2 control-label">Επίθετο</label>
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="last_name" required="last_name" readonly>
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">Όνομα</label>
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="first_name" required="first_name" readonly>
                                </div> 
                                
                                 <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">tbd</label>
                                    <input type="text" id="first_name" name="tbd1" class="form-control" placeholder="tbd" readonly>
                                </div>   

                            </div>                            
                                                                                    
                            <?php echo nl2br("**************** *************************** ************** ************** *************************** **************");?>
                            
                            
                            
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> ΚΑΤΗΓΟΡΙΑ </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="cotype"  name="cotype" required>
                                        <option value="" selected disabled> category </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `sbecode` ORDER BY `sbecode_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['sbecode'] . "\">" . $row_res['sbecode'] . "--". $row_res['sbe_description'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> date </label>
                                    <input type="text" id="mdate" name="mdate" class="form-control date datepicker" required >
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-3 control-label"> Start_time </label>
                                    <?php
                                    $MyTime = "12:00";
                                    echo "<input type=\"text\" id=\"stime\" name=\"stime\" class=\"form-control time timepicker\"  required=\"stime\" value=" . $MyTime . ">";
                                    echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-time\"></i></span>"
                                    ?>    
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-3 control-label"> End_time </label>
                                    <?php
                                    $MyTime = "12:00";
                                    echo "<input type=\"text\" id=\"ltime\" name=\"ltime\" class=\"form-control time timepicker\"  required=\"ltime\" value=" . $MyTime . ">";
                                    echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-time\"></i></span>"
                                    ?>    
                                </div>

                            </div>
                                
                                <div class="form-row">
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                                                 
                                </div>                                                                                                            
                            
                            <?php echo nl2br("**************** *********** separator **************** **************");?>
                                                                                                                                         
                            <div class="form-row">
                                 <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Ο/Σ </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="osunit"  name="osunit" required>
                                        <option value="" selected disabled> osunit </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `gbados` ORDER BY `os_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['ostype'] . "\">" . $row_res['ostype'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                 </div>
                                

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> C2_Unit </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="c2unit"  name="c2unit" required>
                                        <option value="" selected disabled> C2 Unit </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;                                       
                                        $sql = "SELECT  * FROM `gbadc2` ORDER BY `c2_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['c2type'] . "\">" . $row_res['c2type'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                 </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> ΜΚΕΑΑΠ </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="mkeap"  name="mkeap" >
                                        <option value="" selected disabled> ΜΚΕΑΑΠ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;                                       
                                        $sql = "SELECT  * FROM `mkeap` ORDER BY `mk_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['umkeap'] . "\">" . $row_res['umkeap'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                 </div>                                                                 

                            </div>
                                
                                <div class="form-row">
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                                                 
                                </div>                                                                                                            
                            
                            <?php echo nl2br("**************** ********** separator ***************** **************");?>
                            
                            <div class="form-row">
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> TDL </label>
                                        </br>
                                        </br>                                
                                            <select class="form-control" id="tdl" name="tdl" >
                                            <option value="" selected disabled> Tactical Data Link </option>
                                            <option class="text-primary" value="L-11B">L-11B</option>  
                                            <option class="text-primary" value="L-16">L-16</option>
                                            <option class="text-primary" value="L-1">L-1</option>
                                            <option class="text-primary" value="JREAP">JREAP</option>
                                            <option class="text-primary" value="NULL">NULL</option>
                                            
                                        </select>                                                                  
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> GROUND_Voice </label>
                                        </br>
                                        </br>                                
                                            <select class="form-control" id="voicegr" name="voicegr" >
                                            <option value="" selected disabled> GROUND VOICE </option>
                                            <option class="text-primary" value="No">No</option>  
                                            <option class="text-primary" value="Yes">Yes</option>
                                            <option class="text-primary" value="Limited">Limited</option>
                                        </select>                                                                  
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> VOICE_AIR </label>
                                        </br>
                                        </br>                                
                                            <select class="form-control" id="voicair" name="voicair" >
                                            <option value="" selected disabled> VOICE AIR </option>
                                            <option class="text-primary" value="No">No</option>  
                                            <option class="text-primary" value="Yes">Yes</option>
                                            <option class="text-primary" value="Limited">Limited</option>
                                        </select>                                                                  
                                </div>                                                             

                            </div>
                                
                                <div class="form-row">
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                                                 
                                </div>                                                                                                            
                            
                                                                
                            <?php echo nl2br("**************** **********  Additional Data  ***************** **************");?>
                            
                              <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">Frequency</label>
                                    <input type="text" id="freq" name="freq" class="form-control" placeholder="Συχνότητα" >
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">Radio</label>
                                    <input type="text" id="radio" name="radio" class="form-control" placeholder="Ασύρματος" >
                                </div>
                                </div>                                              
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> AJ_Yes_No </label>
                                        </br>
                                        </br>                                
                                            <select class="form-control" id="aj" name="aj" >
                                            <option value="" selected disabled> AJ </option>
                                            <option class="text-primary" value="No">No</option>  
                                            <option class="text-primary" value="Yes">Yes</option>
                                            <option class="text-primary" value="Limited">Limited</option>
                                        </select>                                                                  
                                </div>
                                
                               <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> AJ_NET </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="ajnet"  name="ajnet" >
                                        <option value="" selected disabled> HAVE QUICK </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `ajnet` ORDER BY `aj_id` ";
                                        $sq = $db->runQuery($sql);
                                        while ($row_sq = mysqli_fetch_array($sq)) {
                                            echo "<option value=\"" . $row_sq['ajnet'] . "\">" . $row_sq['ajnet'] . "</option>";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>
                                </div>                                                                     

                            </div>                                                                                                                                     
                                
                            <div class="form-row">
                                </br>
                                                             
                                                                 
                            </div>                                                                                                            
                            
                            <?php echo nl2br("**************** **********  Additional Data  ***************** **************");?>
                            </br>
                    
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Λόγος ΜΗ Μετάπτωσης σε AJ NET : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="reason" name="reason" class="form-control" placeholder="Λόγος μη Μετάπτωσης σε AJ NET " >
                                    <span class="errorFeedback errorSpan" id="abm_loc_nameError">ABM should be only capital letters </span>
                                </div>
                            </div>
                            
                            </br>
                            </br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Preset Reason for AJ NET : </label>
                                <div class="col-sm-4">                                    
                                    <select class="form-control" id="preset" name="preset" >
                                        <option value="" selected disabled> Preset Reason for AJ NET</option>
                                        <option class="text-primary" value="Ανεπιτυχής χρονισμός">Ανεπιτυχής χρονισμός</option>                                          
                                        <option class="text-primary" value="Ανεπιτυχής εισαγωγή κρυπτοκλείδας (WOD)">Ανεπιτυχής εισαγωγή κρυπτοκλείδας (WOD)</option>  
                                        <option class="text-primary" value="Βλάβη ασυρμάτου">Βλάβη ασυρμάτου</option>
                                        <option class="text-primary" value="Δεν απαιτήθηκε λόγω αποστολής">Δεν απαιτήθηκε λόγω αποστολής</option>
                                        <option class="text-primary" value="Τα Α/Φ ανέφεραν UNABLE">Τα Α/Φ ανέφεραν UNABLE</option>
                                        <option class="text-primary" value="Επιλογή λάθος δικτύου (NET) συνεργασίας">Επιλογή λάθος δικτύου (NET) συνεργασίας</option>
                                        <option class="text-primary" value="Κορεσμός λόγω φόρτου επικοινωνιών">Κορεσμός λόγω φόρτου επικοινωνιών</option> 
                                    </select>                                          
                                </div>
                            </div>
                                                                                    
                            </br>
                            </br>
                           
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Σχόλια :(Θα αναγράφονται τα στοιχεία των ΤΕ, ίχνος, Α/Φ, όπλα, διαμόρφωση και οποιοδήποτε άλλο σχόλιο, max 512 χαρακτήρες.)  </label>
                                <div class="col-sm-4">
                                    <textarea  id="remark" name="remark" class="form-control" rows="5" placeholder="remark" ></textarea>
                                </div>
                            </div>
                            </br>
                             </br>
                              </br>
                               </br>
                                </br>
                                 </br>
                            <?php echo nl2br("**************** **********  *****************  ***************** **************");?>
  
                                    </br>
                                    </br>
                                    </br>
                                    </br>

                                                                                                                
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button id="submit" type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                                    
                                    </br>
                                    </br>
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

        <!-- Datepicker Theme -->
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="../bower_components/datepicker/locales/bootstrap-datepicker.el.min.js"></script>
        
        <!-- Timepicker -->
        <script type="text/javascript" src="../bower_components/jquery-timepicker-wvega/jquery.timepicker.js"></script>  
        
        <script type="text/javascript" src="../js/add_exssa.js"></script>



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





