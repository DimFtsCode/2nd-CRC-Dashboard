<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!($user->role == "SYS" || $user->role2 == "CRF+" || $user->role == "CMD")) { 
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

        <?php
        $myUnit = MyUNIT;
        $myAsma = $user->asma;
           
        $myDIVp1 = $myAsma . "XID";
        $myDIVp2 = $myAsma . "DIV";       
        $myDivID = $_SESSION[$myDIVp1];
        $myDivName = $_SESSION[$myDIVp2];
        
        $myCRFp1 = $myAsma . "FID";
        $myCRFp2 = $myAsma . "FDES";
        $myCRFp3 = $myAsma . "PATH";
        
        $myFileID = $_SESSION[$myCRFp1];
        $myFileDes = $_SESSION[$myCRFp2];
        $myFilePath = $_SESSION[$myCRFp3];       
        ?>

        <title> Form View CRF by Division</title> 
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">


        <!--        <link rel="stylesheet" type="text/css"  href="../styles/form_view_sensor.css">-->

        <!-- Morris Charts CSS -->
        <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <!--  -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" >

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> <strong style="color: red;">  View CRF  by Division </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>    
                    <a class="navbar-brand" href="./admin_dashboard.php"> <strong style="color: darkred; ">  Admin </strong> </a>  
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>

            </nav>
            
            
            <div class="col-sm-2">
                <input type="text" id="my_asma" name="my_asma" class="form-control"  style="display:none" value="<?php echo $user->asma; ?>"  readonly   >   
                <input type="text" id="my_division" name="my_division" class="form-control"  style="display:none" value="<?php echo $myDivID; ?>"    > 
                <span class="errorFeedback errorSpan" id="asmaError">ΑΣΜΑ should be only numbers</span>               
            </div>
            
           <div class="panel-heading text-center">
                        <div class="col-lg-12">
                            <h1 class="page-header" style="color: red;"> Προβολή CRF / Επιστασία --- <?php  echo  "<strong style=\"color: black; font-size: 40px; background-color: yellow;\">" .  $myDivName . "</strong>"; ?>  ---- <?php echo date("j - m - Y"); ?> </h1>
                        </div>
                        <!-- /.col-lg-12 -->
             </div>                 
                    
            <div class="panel-heading text-center">                
                                <strong class="form-group">
                                <label class="col-sm-2 control-label" style="color: red" >Διεύθυνση / Μοίρα : </label>  
                                <div class="col-sm-2">

                                    <select class="form-control"  id="directorate"  name="directorate" required >
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
                            </strong>   
                
            </div>      
            
            <div class="form-group">
                <label class="col-sm-2 control-label">ID ΕΓΓΡΑΦΟΥ : </label>
                <div class="col-sm-2">

                    <select class="form-control"  id="fileID"  name="fileID" required>
                        <option value="" selected disabled> file ID </option>
                        <?php
                        require_once '../php_functions/db_config/db_connect.php';
                        $db = new DbMgmt;
                        $sql = "SELECT fid, description FROM crfiles ORDER by fid DESC";
                        $file_id = $db->runQuery($sql);
                        while ($row_file = mysqli_fetch_array($file_id)) {
                            echo "<option value=\"" . $row_file['fid'] . "\">" . $row_file['fid'] . "--" . $row_file['description'] . "</option>";
                        }
                        ?>                                        
                    </select>
                </div>
                                
            </div>
            
            <div class="panel-heading text-center">
                <div class="col-lg-12">
                    <h3 class="page-header" id="crf_header"> <strong style="color: blue; ">  CRF : <?php echo $myFileID . " -- " . $myFileDes; ?> ---- Path : <?php echo "<a href=\" " . $myFilePath . "\" target=\"_blank\" >" . "<style=\"color: red; font-size: 16px;\">" . $myFilePath . " </a>"  ; ?> </strong></h3>                                          
                </div>
                <!-- /.col-lg-12 -->
            </div>     

            
                
            <div class="panel-body">
                <div class="dataTables_wrapper">
                    <?php
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    require_once("../php_functions/functions.inc");
                    $class = "table";
                    $headArray = array("SN", "ΑΣΜΑ", "Βαθμός", "Ειδ.", "Επιθετο", "Ονομα", "Signed", "Date Signed");
                    $head = count($headArray);
                                       
                    $sql = "SELECT personnel.*, crf.*, ranks.* FROM personnel, crf, ranks WHERE personnel.asma=crf.asma AND personnel.rank=ranks.rank AND personnel.unit ='{$myUnit}'  AND crf.division='{$myDivID}'  AND crf.fid='{$myFileID}' ORDER BY ranks.priority, crf.asma ASC";
                    $db = new DbMgmt;
                    $res = $db->runQuery($sql);
                    $serial = 1;
                    $test = "test";
                    echo "<table class=\"table table-striped table-bordered table-hover\" id=\"personnel\">";
                    //echo "<caption class=\"text-center \">Προβολή Προσωπικού</caption>";
                    echo "<thead>";
                    echo "<tr>";
                    for ($i = 0; $i < $head; $i++) {
                        echo "<th>" . $headArray[$i] . "</th>";
                    }
                    echo "</tr>";
                    echo "</thead>"; 

                    echo "<tbody>";
                    while ($row_personnel = mysqli_fetch_array($res)) {
                        $sign = $row_personnel['sign'];
                        $Signature = null;
                        if ($sign == 1) {
                            $Signature = "Yes";
                        } else {
                            $Signature = "No";
                        }

                        echo "<tr>";                        
                        echo "<td class=\"serial\">" . $serial . "</td>";
                        
                         echo "<td class=\"asma\" > <a href=\"./form_view_crfiles_user.php\" >" . "<strong style=\"color: blue; font-size: 16px;\">" . $row_personnel['asma'] . "</strong>". " </a> </td>";
                        
                        echo "<td>" . $row_personnel['rank'] . "</td>";
                        echo "<td>" . $row_personnel['splty'] . "</td>";
                        echo "<td>" . $row_personnel['sname'] . "</td>";
                        echo "<td>" . $row_personnel['fname'] . "</td>";
                        
                        //echo "<td>" . $row_personnel['sign'] . "</td>";
                        echo "<td>" . $Signature . "</td>";
                        echo "<td>" . $row_personnel['date_sign'] . "</td>";
                        echo "</tr>";
                        $serial = $serial + 1;
                    }

                    echo "</tbody>";
                                      

                    echo "</table>";


                    //table($class, $headArray, $res);
                    ?>
                </div>
            </div>

        
            
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

        <script type="text/javascript" src="../js/form_view_crf_bydiv.js"></script>  
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                $("#personnel").DataTable({
                    responsive: true,
                    "pageLength": 200
                });
            });
        </script>


    </body>
</html>




