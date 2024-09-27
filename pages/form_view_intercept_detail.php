<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));   
}

$myAsma = $user->asma;
$myIndex = $myAsma . "ASMA";
$myIndex2 = $myAsma . "INTER";
$myIndex3 = $myAsma . "INTERM";
//$myUser = $_SESSION[$myIndex];
$userAsma =  $_SESSION[$myIndex];
$myIntercept = $_SESSION[$myIndex2];
$myRemark = $_SESSION[$myIndex3];
 


?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title> Form View Intercept Detail </title>
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
        <link href="../styles/form_edit_intercept_asma.css" type="text/css" rel="stylesheet"  >

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
                    <a class="navbar-brand" href="#"> <strong style="color: red; "> Προβολή Συνεργασίας / Αναχαίτισης </strong> </a>
                    <a class="navbar-brand" href="form_view_intercept_bydate.php"> <strong style="color: blue; ">  Προβολή Αναχαιτίσεων Ημέρας  </strong> </a> 

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
                            <h1 class="page-header" style="color: red; background-color: cyan;"> Προβολή  Συνεργασίας / Αναχαίτισης </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                        <div class="col-sm-4">                                   
                            <input type="text" id="userAsma" name="userAsma" class="form-control" style="display:none" value="<?php echo $userAsma; ?>"  readonly   >
                            <input type="text" id="myIntercept" name="myIntercept" class="form-control"  style="display:none" value="<?php echo $myIntercept; ?>"  >
                        </div>
                    </div>   
                   
                    
                    <!-- /.row -->
                    <div class="row">
                        <form id="form_edit_personnel" class="form-horizontal" action="#" method="POST">
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
                                    <label class="col-sm-2 control-label">ID</label>
                                    <input type="text" id="int_id" name="int_id" class="form-control" placeholder="inter ID" readonly>
                                </div>

                            </div>                            
                                                                                    
                            <?php echo nl2br("**************** *************************** ************** ************** *************************** **************");?>
                            
                            
                            
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> ΚΑΤΗΓΟΡΙΑ </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="cotype"  name="cotype" required readonly>
                                        <option value="" selected disabled> category </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `activity` ORDER BY `act_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['act_name'] . "\">" . $row_res['act_name'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> date </label>
                                    <input type="text" id="mdate" name="mdate" class="form-control date datepicker" required readonly>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-3 control-label"> Start_time </label>
                                    <?php
                                    $MyTime = "12:00";
                                    echo "<input type=\"text\" id=\"stime\" name=\"stime\" class=\"form-control time timepicker\"  readonly required=\"stime\" value=" . $MyTime . ">";
                                    echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-time\"></i></span>"
                                    ?>    
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-3 control-label"> End_time </label>
                                    <?php
                                    $MyTime = "12:00";
                                    echo "<input type=\"text\" id=\"ltime\" name=\"ltime\" class=\"form-control time timepicker\" readonly  required=\"ltime\" value=" . $MyTime . ">";
                                    echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-time\"></i></span>"
                                    ?>    
                                </div>                                                               
                                
                                <div class="col-md-2 mb-3">
                                    <label style="color: red; background-color: yellow;" class="col-sm-2 control-label"> ExtCard </label>
                                        </br>
                                                                     
                                            <select class="form-control" id="extcard" name="extcard" required readonly>
                                           <!-- <option value="" selected disabled> Extra Card </option>-->
                                            <option class="text-primary" value="No">No</option>  
                                            <option class="text-primary" value="Yes">Yes</option>  
                                        </select>                                                                  
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">TBD....</label>
                                    <input type="text" id="tbd1" name="tbd1" class="form-control" placeholder="TBD ..." readonly >
                                </div>

                            </div>
                                
                                <div class="form-row">
                                    </br>
                                    </br>
                                    </br>
                                     </br>
                                    </br>
                                                                 
                                </div>                                                                                                            
                            
                            <?php echo nl2br("**************** *********** 1st Formation **************** **************");?>
                                                                                                                                         
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">CS#1st_Formation</label>
                                    <input type="text" id="fcs1" name="fcs1" class="form-control" placeholder="Call Sign" required readonly>
                                </div>
                                

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Αριθμ. Α/Φ </label>
                                    </br>
                                    </br>                             
                                    <select class="form-control" id="numf1" name="numf1" required readonly>
                                        <option value="" selected disabled> Αριθμ. Α/Φ </option>
                                        <?php
                                        for ($arx = 1; $arx < 13; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                    </select>                                          

                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Fighter_Type </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="typef1"  name="typef1" required readonly>
                                        <option value="" selected disabled> Tύπος Α/Φ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `fighters` ORDER BY `f_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['f_name'] . "\">" . $row_res['f_name'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Squadron </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="sq1"  name="sq1" required readonly>
                                        <option value="" selected disabled> Μοίρα Α/Φ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `squadrons` ORDER BY `sq_pri` ";
                                        $sq = $db->runQuery($sql);
                                        while ($row_sq = mysqli_fetch_array($sq)) {
                                            echo "<option value=\"" . $row_sq['sq_name'] . "\">" . $row_sq['sq_name'] . "</option>";
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
                            
                            <?php echo nl2br("**************** ********** 2nd Formation ***************** **************");?>
                            
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">CS#2nd_Formation</label>
                                    <input type="text" id="fcs2" name="fcs2" class="form-control" placeholder="Call Sign" readonly>
                                </div>
                                

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Αριθμ. Α/Φ </label>
                                    </br>
                                    </br>                             
                                    <select class="form-control" id="numf2" name="numf2" readonly>
                                        <option value="" selected disabled> Αριθμ. Α/Φ </option>
                                        <?php
                                        for ($arx = 1; $arx < 13; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>                                          

                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Fighter_Type </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="typef2"  name="typef2" readonly >
                                        <option value="" selected disabled> Tύπος Α/Φ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `fighters` ORDER BY `f_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['f_name'] . "\">" . $row_res['f_name'] . "</option>";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Squadron </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="sq2"  name="sq2" readonly>
                                        <option value="" selected disabled> Μοίρα Α/Φ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `squadrons` ORDER BY `sq_pri` ";
                                        $sq = $db->runQuery($sql);
                                        while ($row_sq = mysqli_fetch_array($sq)) {
                                            echo "<option value=\"" . $row_sq['sq_name'] . "\">" . $row_sq['sq_name'] . "</option>";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>
                                </div>                                

                            </div>
                                
                                <div class="form-row">
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                                                 
                                </div>                                                                                                            
                            
                            <?php echo nl2br("**************** **********  3rd Formation  ***************** **************");?>
                            
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">CS#3rd_Formation</label>
                                    <input type="text" id="fcs3" name="fcs3" class="form-control" placeholder="Call Sign" readonly >
                                </div>
                                

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Αριθμ. Α/Φ </label>
                                    </br>
                                    </br>                             
                                    <select class="form-control" id="numf3" name="numf3" readonly >
                                        <option value="" selected disabled> Αριθμ. Α/Φ </option>
                                        <?php
                                        for ($arx = 1; $arx < 13; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>                                          

                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Fighter_Type </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="typef3"  name="typef3" readonly>
                                        <option value="" selected disabled> Tύπος Α/Φ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `fighters` ORDER BY `f_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['f_name'] . "\">" . $row_res['f_name'] . "</option>";
                                        }
                                        ?> 
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Squadron </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="sq3"  name="sq3" readonly >
                                        <option value="" selected disabled> Μοίρα Α/Φ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `squadrons` ORDER BY `sq_pri` ";
                                        $sq = $db->runQuery($sql);
                                        while ($row_sq = mysqli_fetch_array($sq)) {
                                            echo "<option value=\"" . $row_sq['sq_name'] . "\">" . $row_sq['sq_name'] . "</option>";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>
                                </div>                                

                            </div>
                                
                                <div class="form-row">
                                    </br>
                                    </br>
                                    </br>
                                    </br>
                                                                 
                                </div>                                                                                                            
                            
                            <?php echo nl2br("**************** **********  4th Formation  ***************** **************");?>
                            
                             <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">CS#4th_Formation</label>
                                    <input type="text" id="fcs4" name="fcs4" class="form-control" placeholder="Call Sign" readonly >
                                </div>
                                

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Αριθμ. Α/Φ </label>
                                    </br>
                                    </br>                             
                                    <select class="form-control" id="numf4" name="numf4" readonly>
                                        <option value="" selected disabled> Αριθμ. Α/Φ </option>
                                        <?php
                                        for ($arx = 1; $arx < 13; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>                                          

                                </div>
                                
                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Fighter_Type </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="typef4"  name="typef4" readonly >
                                        <option value="" selected disabled> Tύπος Α/Φ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `fighters` ORDER BY `f_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['f_name'] . "\">" . $row_res['f_name'] . "</option>";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label class="col-sm-2 control-label"> Squadron </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="sq4"  name="sq4" readonly>
                                        <option value="" selected disabled> Μοίρα Α/Φ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `squadrons` ORDER BY `sq_pri` ";
                                        $sq = $db->runQuery($sql);
                                        while ($row_sq = mysqli_fetch_array($sq)) {
                                            echo "<option value=\"" . $row_sq['sq_name'] . "\">" . $row_sq['sq_name'] . "</option>";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
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
                                    <label class="col-sm-2 control-label">Area</label>
                                    <input type="text" id="area" name="area" class="form-control" placeholder="Περιοχή" required readonly>
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">Altitude</label>
                                    <input type="text" id="alt" name="alt" class="form-control" placeholder=" Ύψη" required readonly>
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> Αριθ.Αναχαιτ#1 </label>
                                    </br>
                                    </br>                             
                                    <select class="form-control" id="numint" name="numint" required readonly >
                                        <option value="" selected disabled> Αριθ.Αναχαιτ.</option>
                                        <?php
                                        for ($arx = 1; $arx < 13; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>                                          

                                </div>                                

                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> Είδος_ΑΝΧ#1 </label >
                                    </br>
                                    </br>
                                    <select class="form-control"  id="intype"  name="intype" required readonly>
                                        <option value="" selected disabled> Είδος_ΑΝΧ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `intertype` ORDER BY `inter_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['intertype'] . "\">" . $row_res['intertype'] . "</option>";
                                        }
                                        ?>                                         
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>
                                </div> 
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> Αριθ.Αναχαιτ#2 </label>
                                    </br>
                                    </br>                             
                                    <select class="form-control" id="numint2" name="numint2" readonly>
                                        <option value="" selected disabled> Αριθ.Αναχαιτ.</option>
                                        <?php
                                        for ($arx = 1; $arx < 13; $arx++) {
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                        }
                                        ?>
                                        echo "<option value="NULL">NULL</option>\n";
                                    </select>                                          

                                </div>                                

                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> Είδος_ΑΝΧ#2 </label >
                                    </br>
                                    </br>
                                    <select class="form-control"  id="intype2"  name="intype2" readonly >
                                        <option value="" selected disabled> Είδος_ΑΝΧ </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `intertype` ORDER BY `inter_id` ";
                                        $res = $db->runQuery($sql);
                                        while ($row_res = mysqli_fetch_array($res)) {
                                            echo "<option value=\"" . $row_res['intertype'] . "\">" . $row_res['intertype'] . "</option>";
                                        }
                                        ?>                                         
                                        echo "<option value="NULL">NULL</option>\n";
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
                                    <input type="text" id="freq" name="freq" class="form-control" placeholder="Συχνότητα" required readonly>
                                </div>

                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label">Radio</label>
                                    <input type="text" id="radio" name="radio" class="form-control" placeholder="Ασύρματος" required readonly>
                                </div>
                                </div>

                                 <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> Position </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="post"  name="post" readonly >
                                        <option value="" selected disabled> Θέση Εργασίας </option>
                                        <?php
                                        require_once '../php_functions/db_config/db_connect.php';
                                        $db = new DbMgmt;
                                        $sql = "SELECT  * FROM `position` ORDER BY `post_id` ";
                                        $sq = $db->runQuery($sql);
                                        while ($row_sq = mysqli_fetch_array($sq)) {
                                            echo "<option value=\"" . $row_sq['position'] . "\">" . $row_sq['position'] . "</option>";
                                        }
                                        ?>                                        
                                    </select>
                                </div>                 
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> AJ_Yes_No </label>
                                        </br>
                                        </br>                                
                                            <select class="form-control" id="aj" name="aj" required readonly>
                                            <option value="" selected disabled> AJ </option>
                                            <option class="text-primary" value="No">No</option>  
                                            <option class="text-primary" value="Yes">Yes</option>  
                                        </select>                                                                  
                                </div>
                                
                               <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> AJ_NET </label>
                                    </br>
                                    </br>
                                    <select class="form-control"  id="ajnet"  name="ajnet" readonly >
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
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> Crypto_Yes_No </label>
                                        </br>
                                        </br>                                
                                            <select class="form-control" id="crypto" name="crypto" required readonly>
                                            <option value="" selected disabled> CRYPTO </option>
                                            <option class="text-primary" value="No">No</option>  
                                            <option class="text-primary" value="Yes">Yes</option>  
                                        </select>                                                                  
                                </div>

                            </div>                            
                                                                                    
                            <?php echo nl2br("**************** *************************** Additional Data ************** *************************** **************");?>
                    
                                                        
                            <div class="form-row">
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> L-16_Yes_No </label>
                                        </br>
                                                                        
                                            <select class="form-control" id="mids" name="mids" required readonly>
                                            <option value="" selected disabled> L-16 TDL </option>
                                            <option class="text-primary" value="No">No</option>  
                                            <option class="text-primary" value="Yes">Yes</option>  
                                        </select>                                                                  
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> Com_Quality </label>
                                        </br>
                                                                        
                                            <select class="form-control" id="comq" name="comq" required readonly>
                                            <option value="" selected disabled> Comm Quality </option>
                                            <option class="text-primary" value="ΑΡΙΣΤΗ">ΑΡΙΣΤΗ</option> 
                                            <option class="text-primary" value="ΠΟΛΥ ΚΑΛΗ">ΠΟΛΥ ΚΑΛΗ</option>  
                                            <option class="text-primary" value="ΜΕΤΡΙΑ">ΜΕΤΡΙΑ</option>  
                                            <option class="text-primary" value="ΔΙΑΚΟΠΤΟΜΕΝΗ">ΔΙΑΚΟΠΤΟΜΕΝΗ</option>
                                            <option class="text-primary" value="ΧΑΜΗΛΗ">ΧΑΜΗΛΗ</option>
                                            <option class="text-primary" value="ΚΑΚΗ">ΚΑΚΗ</option> 
                                        </select>                                                                  
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> English_Yes_No </label>
                                        </br>
                                                                        
                                            <select class="form-control" id="eng" name="eng" required readonly>
                                           <!-- <option value="" selected disabled> in English </option>-->
                                            <option class="text-primary" value="No">No</option>  
                                            <option class="text-primary" value="Yes">Yes</option>  
                                        </select>                                                                  
                                </div>
                                
                                <div class="col-md-2 mb-3">
                                    <label class="col-sm-2 control-label"> IFF_STBY_Yes_No </label>
                                        </br>
                                                                        
                                            <select class="form-control" id="iff" name="iff" required readonly>
                                           <!-- <option value="" selected disabled> in English </option>-->
                                            <option class="text-primary" value="No">No</option>  
                                            <option class="text-primary" value="Yes">Yes</option>  
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
                            </br>
                    
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Λόγος ΜΗ Μετάπτωσης σε AJ NET  : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="reason" name="reason" class="form-control" placeholder="Λόγος μη Μετάπτωσης σε AJ NET " required readonly>
                                    <span class="errorFeedback errorSpan" id="abm_loc_nameError">ABM should be only capital letters </span>
                                </div>
                            </div>
                            
                            </br>
                            </br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Λόγος ΜΗ Μετάπτωσης σε ΚΡΙΚΟ : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="reason2" name="reason2" class="form-control" placeholder="Λόγος μη Μετάπτωσης σε KRIKO" required readonly>
                                    <span class="errorFeedback errorSpan" id="abm_loc_nameError">ABM should be only capital letters </span>
                                </div>
                            </div>
                            </br>
                            </br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"> Σχόλια :(Θα αναγράφονται τα στοιχεία των ΤΕ, ίχνος, Α/Φ, όπλα, διαμόρφωση και οποιοδήποτε άλλο σχόλιο, max 512 χαρακτήρες.)  </label>
                                <div class="col-sm-4">
                                    
                                    <textarea  id="message" name="remark" class="form-control" rows="5" placeholder="remark" readonly ><?php echo $myRemark; ?></textarea>
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

                                                                                                                
<!--                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-4">
                                    <button id="submit" type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>-->
                                    
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
        
        <script type="text/javascript" src="../js/form_view_intercept_detail.js"></script>



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





