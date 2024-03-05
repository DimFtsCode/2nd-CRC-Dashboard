 <?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php")); 
}

if (!($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD")) { 
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
        // The following is used to force the browser to clear cashe every time the page is loaded  
        //echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_sensor.css?v=" .rand() . "\">" );        
        ?>

        <title> Form View Leaves </title>   
        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        
        
        <link rel="stylesheet" type="text/css"  href="../styles/form_view_pgrleave.css">

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
        <div id="container">
            <div id="header">
                <h1> 2o AKE -- Προβολή  Αδειών Προσωπικού </h1>
            </div> <!-- end header -->
            <div id="menu">
                <ul>
                    <li><a href="./logout.php"> Logout </a></li>
                    <li><a href="dashboard.php"> Dashboard</a> </li>
                    <li><a href="admin_dashboard.php"> Admin </a> </li>
                    <li><a href="./form_personnel_detail_info.php"> Αναλυτική Προβολή </a> </li> 
                    <li><a href="./form_view_personnel_all.php"> Προβολή Συνόλου ΠΡΣ</a> </li> 
                    
                    <li>
                        <?php
                        $myHerf = " <a style=\"color: yellow;\" href=\"./form_add_leave2.php\"> Εισαγωγή Νέας 'Αδειας </a> ";
                        if ($user->role == "SYS" || $user->role2 == "STAFF+" ) {
                            echo $myHerf;
                        }
                        ?>                       
                    </li>  
                    
<!--                    <li><a id="add_new_leave" style="color : yellow;" href="./form_add_leave2.php"> Εισαγωγή Νέας 'Αδειας</a> </li>-->

                </ul>
            </div> <!-- end menu -->          

            <div id="mainContainer">


                <div id="content">
                    <div class="container-fluid">
                        <!--<div class="row">-->

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading text-center">                                          
                                            <strong style="color: black; background-color: yellow; font-size: 18px;"> ΠΡΟΒΟΛΗ  ΑΔΕΙΩΝ του :  </strong> 
                                            <label id="blank"> ... >>>   </label>
                                            <label id="Head_asma" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                            <label id="blank"> ...   </label>
                                            <label id="Head_rank" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                            <label id="blank"> ...   </label>
                                            <label id="Head_specialty" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                             <label id="blank"> ...   </label>
                                             <label id="Head_last_name" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                             <label id="blank"> ...   </label>
                                             <label id="Head_first_name" style="color: yellow; background-color: red; font-size: 18px;">    </label>
                                        </div>
                                      
                                        <div class="form-group">
                                           <label class="col-sm-4 control-label" style="display:none" >userAsma : </label>
                                           <div class="col-sm-4">                                           
                                           <input type="text" id="userAsma" name="userAsma" class="form-control"  style="display:none"  value="<?php $myVar = $user->asma;  $myVar = $myVar . "XID";echo $_SESSION[$myVar]?>"  >
                                           <input type="text" id="my_asma" name="my_asma" class="form-control"  style="display:none" value="<?php echo $user->asma; ?>"  readonly >
                                          </div>
                                       </div>   
     
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                //global $_SESSION['MyID'] = array();
                                                $_SESSION['MyIDE'][100] = 4;
                                                
                                                $myVar2 = $user->asma;
                                                $myVar2 = $myVar2 . "XID";
                                                $sp_userAsma = $_SESSION[$myVar2];
                                                
                                                
                                                require_once '../php_functions/db_config/db_connect.php';
                                                $class = "table";
                                                $headArray = array("SN", "ID", "ASMA", "DATE", "Num", "Leave_type", "Location", "EF_year", "REG_date", "USER_reg", "DEL");
                                                $head = count($headArray);
                                                $Scope = "LIVE";

                                                $sql = "SELECT leaves.*, leave_type.id, leave_type.description as My_type FROM leaves, leave_type WHERE leaves.asma =$sp_userAsma AND leaves.leave_type = leave_type.id ORDER BY start_date DESC";
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $serial = 1;
                                                $loop_var = 0;
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"view_leave\">";

                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head; $i++) {
                                                    echo "<th>" . $headArray[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";   
                                                
                                                $c10 = 0 ;      $p10 = 0 ;
                                                $c11 = 0 ;      $p11 = 0 ;
                                                $c12 = 0 ;      $p12 = 0 ;
                                                $c13 = 0 ;      $p13 = 0 ;
                                                $c14 = 0 ;      $p14 = 0 ;
                                                $c15 = 0 ;      $p15 = 0 ;
                                                $c17 = 0 ;      $p17 = 0 ;
                                                $c19 = 0 ;      $p19 = 0 ;
                                                $c21 = 0 ;      $p21 = 0 ;
                                                
                                                while ($row_air = mysqli_fetch_array($res)) {
                                                     $CheckYear = $row_air['efyear'];
                                                     $CheckIDLeave = $row_air['id'];
                                                     $efyear = date('Y');
                                                     $efyear2 = $efyear - 1 ; 
                                                     $Days = $row_air['num_days'] ;
                                                    
                                                     if ($CheckYear == $efyear || $CheckYear == $efyear2) { 
                                                         
                                                         if ($CheckYear == $efyear ) {
                                                             
                                                            switch ($CheckIDLeave) {
                                                                case  10 :
                                                                    $c10 = $c10 + $Days ;
                                                                    break; 
                                                                case  11 :
                                                                    $c11 = $c11 + $Days ;
                                                                    break; 
                                                                case  12 :
                                                                    $c12 = $c12 + $Days ;
                                                                    break;  
                                                                case  13 :
                                                                    $c13 = $c13 + $Days ;
                                                                    break;  
                                                                case  14 :
                                                                    $c14 = $c14 + $Days ;
                                                                    break;  
                                                                case  15 :
                                                                    $c15 = $c15 + $Days ;
                                                                    break;  
                                                                case  17 :
                                                                    $c17 = $c17 + $Days ;
                                                                    break;  
                                                                case  19 :
                                                                    $c19 = $c19 + $Days ;
                                                                    break;  
                                                                case  21 :
                                                                    $c21 = $c21 + $Days ;
                                                                    break;  
                                                         }
                                                         
                                                         }
                                                         
                                                         
                                                         if ($CheckYear == $efyear2 ) {
                                                             
                                                            switch ($CheckIDLeave) {
                                                                case  10 :
                                                                    $p10 = $p10 + $Days ;
                                                                    break; 
                                                                case  11 :
                                                                    $p11 = $p11 + $Days ;
                                                                    break; 
                                                                case  12 :
                                                                    $p12 = $p12 + $Days ;
                                                                    break;  
                                                                case  13 :
                                                                    $p13 = $p13 + $Days ;
                                                                    break;  
                                                                case  14 :
                                                                    $p14 = $p14 + $Days ;
                                                                    break;  
                                                                case  15 :
                                                                    $p15 = $p15 + $Days ;
                                                                    break;  
                                                                case  17 :
                                                                    $p17 = $p17 + $Days ;
                                                                    break;  
                                                                case  19 :
                                                                    $p19 = $p19 + $Days ;
                                                                    break;  
                                                                case  21 :
                                                                    $p21 = $p21 + $Days ;
                                                                    break;  
                                                         }
                                                         
                                                         }

                                                    echo "<tr>";

                                                    $id_parse[$loop_var] = $row_air['tbl_id'];
                                                   

                                                    echo "<td class=\"serial\">" . $serial . "</td>";                                                       
                                                                                                  
                                                    if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                                                        echo "<td class=\"tbl_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$id_parse[$loop_var]" . " \" >" . $row_air['tbl_id'] . "  </a> </td>";
                                                    }else {
                                                       echo "<td class=\"tbl_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_air['tbl_id'] . "  </a> </td>"; 
                                                    }
                                                    
                                                    echo "<td class=\"asma\" id=\"asma\">" . $row_air['asma'] . "</td>";
                                                    echo "<td class=\"start_date\">" . $row_air['start_date'] . "</td>";
                                                    echo "<td class=\"numofdays\">" . $row_air['num_days'] . " </strong> </td>";
                                                    echo "<td class=\"leave_type\">" . $row_air['My_type'] . "</td>";
                                                    echo "<td class=\"location\" >" . $row_air['location'] . "</td>";
                                                    echo "<td class=\"efyear\" >" . $row_air['efyear'] . "</td>";
                                                    echo "<td class=\"date_reg\">" . $row_air['date_reg'] . "</td>";
                                                    echo "<td class=\"user_reg\">" . $row_air['user_reg'] . "</td>";
                                                    
                                                    if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                                                        echo "<td class=\"del_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#delete" ."$id_parse[$loop_var]"."\">".$row_air['tbl_id']." </a> </td>";
                                                    }else{
                                                        echo "<td class=\"del_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_air['tbl_id'] . "  </a> </td>";  
                                                    }
                                                    echo "</tr>";
                                                    $loop_var = $loop_var + 1;
                                                    $serial = $serial + 1;
                                                    
                                                    }    
                                                }

                                                echo "</tbody>";

                                                echo "</table>";

                                                //table($class, $headArray, $res);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <!--</div>-->
                        <!-- /.row -->
                      

                    </div>
                </div>
                <!--       //////////////////////////////////////////////////////////////////////////      -->
                
                <div id="content2">
                    <div class="container-fluid">
                        <!--<div class="row">-->

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-heading text-center">                                          
                                            <strong style="color: black; background-color: yellow; font-size: 18px;"> ΣΥΝΟΛΑ ΑΔΕΙΩΝ ΤΡΕΧΟΝΤΟΣ ΕΤΟΥΣ </strong> 
                                            
                                        </div>
                                                                              
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                
                                                $class2 = "table";
                                                $headArray2 = array("ΚΑΝΟΝΙΚΗ", "ΜΙΚΡΑΣ", "ΗΜΕΡΗΣΙΑ", "ΓΟΝΙΚΗ", "ΑΝΑΡΡΩΤΙΚΗ", "ΜΕΤΑΘΕΣΗΣ", "ΦΟΙΤΗΤΙΚΗ", "ΑΙΜΟΔΟΤΙΚΗ", "ΕΙΔ. ΣΚΟΠΟΥ");
                                                $head2 = count($headArray2);
                                               
                                                $sequal = 1;
                                               
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"sum_leave1\">";

                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head2; $i++) {
                                                    echo "<th>" . $headArray2[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";   
                                                
                                                    echo "<tr>";

                                                    $id_parse[$loop_var] = $row_air['tbl_id'];
                                                   
                                                    //echo "<td class=\"serial\">" . $sequal . "</td>";                                                                                                                                                      
                                                    
                                                    echo "<td class=\"sum\" id=\"sum1\">" . $c10 . "</td>";

                                                    echo "<td class=\"sum\" id=\"sum2\">" . $c11 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum3\">" . $c12 . "</td>";
                                                    
                                                    echo "<td class=\"sum\" id=\"sum4\">" . $c13 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum5\">" . $c14 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum6\">" . $c15 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum7\">" . $c17 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum8\">" . $c19 . "</td>";
                                                    
                                                    echo "<td class=\"sum\" id=\"sum9\">" . $c21 . "</td>";
                                                                                                                                                     
                                                    echo "</tr>";

                                                echo "</tbody>";

                                                echo "</table>";

                                                //table($class, $headArray, $res);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <!--</div>-->
                        <!-- /.row -->
                      

                    </div>
                </div>

                                                                
                <!--   //////////////////////////////////////////////////////////////////////////////////  -->  
                    <div id="content3">
                    <div class="container-fluid">
                        <!--<div class="row">-->

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-heading text-center">                                          
                                            <strong style="color: black; background-color: cyan; font-size: 18px;"> ΣΥΝΟΛΑ ΑΔΕΙΩΝ ΠΡΟΗΓΟΥΜΕΝΟΥ ΕΤΟΥΣ </strong> 
                                            
                                        </div>
                                                                              
                                        <div class="panel-body">
                                            <div class="dataTables_wrapper">
                                                <?php
                                                
                                                $class3 = "table";
                                                $headArray3 = array("ΚΑΝΟΝΙΚΗ", "ΜΙΚΡΑΣ", "ΗΜΕΡΗΣΙΑ", "ΓΟΝΙΚΗ", "ΑΝΑΡΡΩΤΙΚΗ", "ΜΕΤΑΘΕΣΗΣ", "ΦΟΙΤΗΤΙΚΗ", "ΑΙΜΟΔΟΤΙΚΗ", "ΕΙΔ. ΣΚΟΠΟΥ");
                                                $head3 = count($headArray3);
                                               
                                                $sequal = 1;
                                               
                                                echo "<table class=\"table table-striped table-bordered table-hover\" id=\"sum_leave2\">";

                                                echo "<thead>";
                                                echo "<tr class=\"table_head\">";
                                                for ($i = 0; $i < $head3; $i++) {
                                                    echo "<th>" . $headArray2[$i] . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";   
                                                
                                                    echo "<tr>";

                                                    $id_parse[$loop_var] = $row_air['tbl_id'];
                                                   
                                                    //echo "<td class=\"serial\">" . $sequal . "</td>";                                                                                                                                                      
                                                    
                                                    echo "<td class=\"sum\" id=\"sum1\">" . $p10 . "</td>";

                                                    echo "<td class=\"sum\" id=\"sum2\">" . $p11 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum3\">" . $p12 . "</td>";
                                                    
                                                    echo "<td class=\"sum\" id=\"sum4\">" . $p13 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum5\">" . $p14 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum6\">" . $p15 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum7\">" . $p17 . "</td>";
                                                    echo "<td class=\"sum\" id=\"sum8\">" . $p19 . "</td>";
                                                    
                                                    echo "<td class=\"sum\" id=\"sum9\">" . $p21 . "</td>";
                                                                                                                                                     
                                                    echo "</tr>";

                                                echo "</tbody>";

                                                echo "</table>";

                                                //table($class, $headArray, $res);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <!--</div>-->
                        <!-- /.row -->
                      

                    </div>
                </div>
                                                               
                 <!--       //////////////////////////////////////////////////////////////////////////      -->
                
            </div>
        </div>
                        
        <!-- Modal Edit Leave !! -->
        <?php
        //$sp1_userAsma = 16518;
        $sql_update_leave = "SELECT leaves.*, leave_type.id, leave_type.description as My_type FROM leaves, leave_type WHERE leaves.asma =$sp_userAsma AND leaves.leave_type = leave_type.id ORDER BY start_date DESC";
        
        $db2 = new DbMgmt;
        $qry_update_leave = $db2->runQuery($sql_update_leave);      
        
        while ($row_update = mysqli_fetch_array($qry_update_leave)) {
            //$loop_var = 0;
            $id_parse[$loop_var] = $row_update['tbl_id'];

            //Update Modal
            echo "<div class=\"modal fade\" id=\"update" . $id_parse[$loop_var] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";            
            echo "<div class=\"modal-dialog\">\n";            
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> ΔΙΟΡΘΩΣΗ  ΑΔΕΙΑΣ </h3>\n";
            //modal header
            echo "</div>\n";
            $id_update = $row_update['tbl_id'];
            $start_date_update = $row_update['start_date'];
            $num_days_update = $row_update['num_days'];
            $leave_type_update = $row_update['My_type'];
            $efyear = $row_update['efyear'];
            $location_update = $row_update['location'];


            //echo "Sensor ID : " . $sensor_id_update;
            //$_SESSION['MyError'][1] = $sensor_id_update;
            //$_SESSION['MyError'][3] = "NO-USER";
            //echo "<input class=\"hidden\" id=\"sensor_id\" name=\"sensor_id\" value=\"" . $sensor_id_update . "\">\n";


            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"updateLeaveForm\" name=\"updateLeaveForm\" action=\"../php_functions/leave_edit.php\" method=\"POST\">\n";  //action
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\">Update Leave </label>\n";
            echo "</div>\n";


            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Leave ID </label>\n";
            echo "<div class=\"col-sm-4\">";
            echo "<input type=\"text\" id=\"tbl_id\" name=\"tbl_id\" class=\"form-control input-group-lg\" value=\"" . $id_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";
                        
            /*
             * Select days
             */
            echo "<div class=\"form-group form-group-sm\">\n";
            echo "<div class=\"col-sm-2\">\n";
            echo "<label class=\"col-sm-2 control-label\">Days</label>\n";
            echo "</div>\n";
            echo "<div class=\"col-sm-4\">\n";
            echo "<select class=\"col-sm-8 form-control\" id=\"num_days\" required=\"num_days\" name=\"num_days\">\n";
            echo "<option value=\"\" selected disabled> num of days </option>";
            for ($arx = 1; $arx < 31; $arx++) {
                                            
                                            echo "<option value=\"" . $arx . "\">" . $arx . "</option>\n";
                                            
                                        }
                                        echo "<option value=\"45\">" . "45". "</option>";
                                        echo "<option value=\"60\">" . "60". "</option>";
                                        echo "<option value=\"90\">" . "90". "</option>";
                                        echo "<option value=\"180\">" . "180". "</option>";
            echo "</select>\n";
            echo "</div>\n";
            echo "</div>\n";
            /*
             * End here
             */
            //Select ends here:
            
            
            /*
             * Select leave type
             */
            echo "<div class=\"form-group form-group-sm\">\n";
            echo "<div class=\"col-sm-2\">\n";
            echo "<label class=\"col-sm-2 control-label\">Leave Type</label>\n";
            echo "</div>\n";
            echo "<div class=\"col-sm-4\">\n";
            echo "<select class=\"col-sm-8 form-control\" id=\"leave_type\" required=\"leave_type\" name=\"leave_type\">\n";
            
            require_once '../php_functions/db_config/db_connect.php';
            $db3 = new DbMgmt;
            $sql = "SELECT  * FROM `leave_type` ORDER BY `id` ";
            $div = $db3->runQuery($sql);
             echo "<option value=\"\" selected disabled> leave type </option>";
            while ($row_div = mysqli_fetch_array($div)) {
                echo "<option value=\"" . $row_div['id'] . "\">" . $row_div['description']   . "</option>";
            }

            //echo "<option selected=\"selected\" value=\" ". $status_update ."\"> $status_update </option>";
            echo "</select>\n";
            echo "</div>\n";
            echo "</div>\n";
            /*
             * End here
             */
            //Select ends here:
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">  </label>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-4 control-label\">Έτος Άδειας:</label>\n";
            echo "<div class=\"col-sm-4\">";
            echo "<input type=\"text\" id=\"efyear\" name=\"efyear\" required=\"efyear\" class=\"form-control input-group-lg\" placeholder=\"efyear\" value=\"" . $efyear . "\">";
            echo "</div>\n"; 
            echo "</div>\n";
                        
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">Start Date</label> ";
            echo "<div  class=\"input-group date col-sm-4\" > ";
            echo "<input type=\"text\" id=\"start_date\"  name=\"start_date\" class=\"form-control date datepicker\" value=\" " . $start_date_update . "\"> ";
            echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-calendar\"></i></span> ";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">  </label>\n";
            echo "</div>\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Location </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"loction\" name=\"loction\" required=\"location\" class=\"form-control input-group-lg\" placeholder=\"location\" value=\"" . $location_update . "\">";
            echo "</div>\n"; 
            echo "</div>\n";

            echo "</div>";
            //Modal Body
            echo "</div>";
            echo "<div class=\"modal-footer\">";
            echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
            echo "<button type=\"submit\" id=\"update\" class=\"btn btn-primary\">Update</button>";
            echo "</form>";

            //Modal Footer
            echo "</div>";

            // modal content
            echo "</div>";

            // modal dialog
            echo "</div>";

            //modal end
            echo "</div>";
            //$loop_var = $loop_var + 1;
        }
        ?>
             
        
        <!-- Modal Delete  Leave !! -->
        <?php
        $sql_delete_leave = "SELECT leaves.*, leave_type.id, leave_type.description as My_type FROM leaves, leave_type WHERE leaves.asma =$sp_userAsma AND leaves.leave_type = leave_type.id ORDER BY start_date DESC";
        
        $db3 = new DbMgmt;
        $qry_delete_leave = $db3->runQuery($sql_delete_leave);      
        
        while ($row_delete = mysqli_fetch_array($qry_delete_leave)) {
            //$loop_var = 0;          
            $del_id_parse[$loop_var] = $row_delete['tbl_id'];

            //Delete Modal           
            echo "<div class=\"modal fade\" id=\"delete" . $del_id_parse[$loop_var] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n"; 
                
            echo "<div class=\"modal-dialog\">\n";
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> ΔΙΑΓΡΑΦΗ  ΑΔΕΙΑΣ </h3>\n";
            //modal header
            echo "</div>\n";
            
            $del_id_delete = $row_delete['tbl_id'];

            $start_date_delete = $row_delete['start_date'];
            $num_days_delete = $row_delete['num_days'];
            $leave_type_delete = $row_delete['My_type'];

            $location_delete = $row_delete['location'];
           
            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"deletePGRLeaveForm\" name=\"deletePGRLeaveForm\" action=\"../php_functions/leave_delete.php\" method=\"POST\">\n";  //action 
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\">Delete  Leave </label>\n";
            echo "</div>\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Leave ID </label>\n";
            echo "<div class=\"col-sm-4\">";
            echo "<input type=\"text\" id=\"del_id\" name=\"del_id\" class=\"form-control input-group-lg\" value=\"" . $del_id_delete . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";            
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">Start Date</label> ";
            echo "<div  class=\"input-group date col-sm-4\" > ";
            echo "<input type=\"text\" id=\"start_date\"  name=\"start_date\" class=\"form-control date datepicker\" value=\" " . $start_date_delete . "\" readonly> ";
            echo "<span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-calendar\"></i></span> ";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Days </label>\n";
            echo "<div class=\"col-sm-4\">";
            echo "<input type=\"text\" id=\"pl_id\" name=\"pl_id\" class=\"form-control input-group-lg\" value=\"" . $num_days_delete . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";            
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Leave Type </label>\n";
            echo "<div class=\"col-sm-6\">";
            echo "<input type=\"text\" id=\"pl_id\" name=\"pl_id\" class=\"form-control input-group-lg\" value=\"" . $leave_type_delete . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";    
                                  
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> Location </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"pl_loction\" name=\"pl_loction\" required=\"pl_location\" class=\"form-control input-group-lg\" placeholder=\"location\" value=\"" . $location_delete . "\" readonly >";
            echo "</div>\n"; 
            echo "</div>\n";

            echo "</div>";
            //Modal Body
            echo "</div>";
            echo "<div class=\"modal-footer\">";
            echo "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>";
            echo "<button type=\"submit\" id=\"delete\" class=\"btn btn-primary\">Delete</button>";
            echo "</form>";

            //Modal Footer
            echo "</div>";

            // modal content
            echo "</div>";

            // modal dialog
            echo "</div>";

            //modal end
            echo "</div>";
            //$loop_var = $loop_var + 1;
        }
        ?>
                       
        <!-- jQuery -->
        <script src="../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../bower_components/jquery/dist/jquery.js"></script>
        <script src="../bower_components/jquery/dist/jquery.ui.js"></script>

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
        
        <!--  <script type="text/javascript" src="../js/insert_personnel.js"></script>  -->
        <!-- DataTables JavaScript -->
        <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
        
        <!-- Change the background color of certain fields -->
        <script src="../js/form_view_leave.js"></script>

                
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
        
       <script>
            $(document).ready(function () {
                $("#view_leave").DataTable({
                    responsive: true,
                    "pageLength": 100 
                });
            }); 
        </script> 
                            
    
</body>
</html>



