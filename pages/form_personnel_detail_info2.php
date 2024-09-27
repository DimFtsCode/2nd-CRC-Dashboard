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

        <?php
        // The following is used to force the browser to clear cashe every time the page is loaded  
        //echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/form_view_sensor.css?v=" . rand() . "\">" );
        ?>

        <title> Form View Personnel Detail Info </title> 
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
            <nav class="navbar navbar-default navbar-static-top" role="navigation" >

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> <strong style="color: red;">  View Personnel Detail Info </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>  
                    <a class="navbar-brand" href="admin_dashboard.php"> <strong style="color: red; ">  Admin </strong> </a> 
                    <a class="navbar-brand" href="form_view_personnel_all.php"> <strong style="color: darkred; ">  Προβολή Συνόλου ΠΡΣ </strong> </a>                   
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>

                <div class="panel-heading text-center">
                    <div class="col-lg-12">
                        <h1 class="page-header" style="color: red;"> Προβολή Αναλυτικών Στοιχείων Προσωπικού 2ου ΑΚΕ </h1>
                        <strong style="color: black; font-size: 20px;">  <?php echo date("j - m - Y"); ?>  </strong>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>     

            </nav>



            <style>
                * {
                    box-sizing: border-box;
                }

                .container {
                    width: 97%;
                    height: 80%;
                }

                /* Create three unequal columns that floats next to each other */
                .column {
                    float: left;
                    padding: 10px;
                    height: 900px;  
                    /*height: 100%;*/ 
                }

                .left, .right {
                    width: 33.3%;
                }

                .middle {
                    width: 33.3%;
                }

                /* Clear floats after the columns */
                .row:after {
                    content: "";
                    display: table;
                    clear: both;
                }
            </style>

            <div class="container">

                <h2> Προβολή Αναλυτικών Στοιχείων Προσωπικού </h2>
                         <div class="form-group">
                            <label class="col-sm-4 control-label"  style="display:none" >userAsma : </label>
                            <div class="col-sm-4">
                                <!--<input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" style="display:none"  readonly>-->  
                                 <input type="text" id="userAsma" name="userAsma" class="form-control"  style="display:none"  value="<?php $myVar = $user->asma;  $myVar = $myVar . "XID";echo $_SESSION[$myVar]?>"  >
                                 <input type="text" id="my_asma" name="my_asma" class="form-control"  style="display:none" value="<?php echo $user->asma; ?>"  readonly >

                            </div>
                        </div>
                <span class="input-group-btn"><button class="btn btn-outline-secondary" type="button" id="btn_getdata" name ="btn_getdata" style="display:none" >Get Data</button></span>    

                <div class="row">
                    <div class="column left" style="background-color:#aaa;">
                        <h2> <u> ΒΑΣΙΚΑ ΣΤΟΙΧΕΙΑ </u> </h2>

                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΑΣΜΑ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input  type="text" id="asma" name="asma" class="form-control" placeholder="asma"  readonly>                                  
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΒΑΘΜΟΣ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="rank" name="rank" class="form-control" placeholder="rank"  readonly>                                  
                                </div>
                            </div>
                        </div> 

                         <div class="form-group">
                            <label class=" col-sm-4 control-label">ΕΙΔΙΚΟΤΗΤΑ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty"  readonly>                                  
                                </div>

                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΕΠΙΘΕΤΟ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="last_name" readonly>                                 
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΟΝΟΜΑ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="first_name" readonly>                                
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΔΙΕΥΘΥΝΣΗ/ ΜΟΙΡΑ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="directorate" name="directorate" class="form-control" placeholder="directorate" readonly>                                
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label"> ΤΜΗΜΑ / ΣΜΗΝΟΣ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="branch" name="branch" class="form-control" placeholder="branch" readonly>                                
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label"> ΓΡΑΦΕΙΟ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="office" name="office" class="form-control" placeholder="office" readonly>                                
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label"> ΗΜ. ΓΕΝΝΗΣΗΣ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="dateofbirth" name="dateofbirth" class="form-control" placeholder="dateofbirth" readonly>                                
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label"> ΗΜ. ΤΟΠΟΘΕΤΗΣΗΣ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="dateofassign" name="dateofassign" class="form-control" placeholder="dateofassign" readonly>                                
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label"> ΗΜ. ΔΙΑΓΡΑΦΗΣ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="dateofrelease" name="dateofrelease" class="form-control" placeholder="dateofrelease" readonly>                                
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label"> ΑΡΙΘΜ. ΤΑΥΤΟΤΗΤΑΣ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="idnumber" name="idnumber" class="form-control" placeholder="idnumber" readonly>                                
                                </div>
                            </div>
                        </div> 
                                                                                                                
                        <?php
                       echo nl2br("*************************************************************************************  \n ************************************************************************************** ");
                        ?>                        
                        <h2> <u> ΚΑΘΗΚΟΝΤΑ </u> </h2>
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΚΑΘΗΚΟΝ#1 : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="duty1" name="duty1" class="form-control" placeholder="duty1" readonly>                                 
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΗΜΕΡΟΜΗΝΙΑ#1 : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="date1" name="date1" class="form-control" placeholder="date1" readonly>                                 
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΚΑΘΗΚΟΝ#2 : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="duty2" name="duty2" class="form-control" placeholder="duty2" readonly>                                 
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΗΜΕΡΟΜΗΝΙΑ#2 : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="date2" name="date2" class="form-control" placeholder="date2" readonly>                                 
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΚΑΘΗΚΟΝ#3 : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="duty3" name="duty3" class="form-control" placeholder="duty3" readonly>                                 
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΗΜΕΡΟΜΗΝΙΑ#3 : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="date3" name="date3" class="form-control" placeholder="date3" readonly>                                 
                                </div>
                            </div>
                        </div> 
                        
                     <!--  second column -->  
                    </div>
                    <div class="column middle" style="background-color:#bbb;">
                        <h2> <u>ΣΤΟΙΧΕΙΑ ΔΙΕΥΘΥΝΣΗΣ / ΚΑΤΟΙΚΙΑΣ </u></h2>
                       <div class="form-group">
                            <label class=" col-sm-4 control-label">ΠΟΛΗ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="city" name="city" class="form-control" placeholder="city"  readonly>                                  
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΔΙΕΥΘΥΝΣΗ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="address" name="address" class="form-control" placeholder="address"  readonly>                                  
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΤΑΧ. ΚΩΔΙΚΑΣ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="pscode" name="pscode" class="form-control" placeholder="pscode"  readonly>                                  
                                </div>
                            </div>
                        </div> 
                        
                         <div class="form-group">
                            <label class=" col-sm-4 control-label">ΚΙΝΗΤΟ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="mphone" name="mphone" class="form-control" placeholder="mphone"  readonly>                                  
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΤΗΛΕΦΩΝΟ #1 : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="phone1" name="phone1" class="form-control" placeholder="phone1"  readonly>                                  
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΤΗΛΕΦΩΝΟ #2 : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="phone2" name="phone2" class="form-control" placeholder="phone2"  readonly>                                  
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΕΣΩΤ. ΤΗΛ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="iphone" name="iphone" class="form-control" placeholder="iphone"  readonly>                                  
                                </div>
                            </div>
                        </div>
                        
                        <?php
                       echo nl2br("************************************************************************************* \n ************************************************************************************** ");
                        ?> 
                        
                       <h2> <u> ΙΑΤΡΙΚΕΣ ΕΞΕΤΑΣΕΙΣ ΤΠΥΕ </u> </h2>
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΤΕΛΕΥΤΑΙΟ ΤΠΥΕ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="tpye_last" name="tpye_last" class="form-control" placeholder="last tpye" readonly>                                 
                                </div>
                            </div>
                        </div> 
                        
                        <div class="form-group">
                            <label class=" col-sm-4 control-label">ΕΙΔΟΣ ΕΞΕΤΑΣΗΣ : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <input type="text" id="tpye" name="tpye" class="form-control" placeholder="ΕΞΕΤΑΣΗ" readonly>                                 
                                </div>
                            </div>
                        </div> 
                       
                       <?php
                       echo nl2br("************************************************************************************* \n ************************************************************************************** ");
                        ?> 
                       <h2> <u>ΠΡΟΣΩΠΙΚΟΙ ΦΑΚΕΛΟΙ </u></h2>
                       <div class="form-group">
                            <label class=" col-sm-4 control-label">ΙΑΤΡ. ΦΑΚ. : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="medfolder_yn" name="medfolder_yn" class="form-control" placeholder="medfolder_yn"  readonly>                                  
                                </div>
                            </div>
                        </div>
                       
                       <div class="form-group">
                            <label class=" col-sm-4 control-label">ΘΕΣΗ ΙΑΤΡ. ΦΑΚ. : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="medfolder_loc" name="medfolder_loc" class="form-control" placeholder="medfolder_loc"  readonly>                                  
                                </div>
                            </div>
                        </div>
                       
                       <div class="form-group">
                            <label class=" col-sm-4 control-label">ΦΑΚΕΛΟΣ ΕΚΠ. : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="trfolder_yn" name="trfolder_yn" class="form-control" placeholder="trfolder_yn"  readonly>                                  
                                </div>
                            </div>
                        </div>
                       
                       <div class="form-group">
                            <label class=" col-sm-4 control-label">ΘΕΣΗ ΦΑΚ. ΕΚΠ. : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="trfolder_loc" name="trfolder_loc" class="form-control" placeholder="trfolder_loc"  readonly>                                  
                                </div>
                            </div>
                        </div>
                       
                       <div class="form-group">
                            <label class=" col-sm-4 control-label">ABM : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="abm_yn" name="abm_yn" class="form-control" placeholder="abm_yn"  readonly>                                  
                                </div>
                            </div>
                        </div>
                       
                       <div class="form-group">
                            <label class=" col-sm-4 control-label">ΘΕΣΗ ABM : </label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                     <input type="text" id="abm_loc" name="abm_loc" class="form-control" placeholder="abm_loc"  readonly>                                  
                                </div>
                            </div>
                        </div>
                       
                                                
                      <!--  third column -->  
                    </div>
                    <div class="column right" style="background-color:#ccc;">
                        <h2> <u> ΕΠΙΠΛΕΟΝ ΣΤΟΙΧΕΙΑ </u> </h2>
                        
                       <div >
                            <?php
                            if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD") {
                                $myHerf = " <a id=\"view_school\" style=\"color: red; font-size: 20px; background-color: white;\" href=\"form_view_school_asma.php\"> Προβολή Σχολείων Προσωπικού </a> ";
                                echo $myHerf;
                            }
                            ?>           
                         </div>   
                        
                        <?php
                             echo nl2br("**************** *************************** **************");
                         ?>  
                        
                         <div >
                            <?php
                            if ($user->role == "SYS") {
                                $myHerf = " <a id=\"edit_personnel\" style=\"color: red; font-size: 20px; background-color: white;\" href=\"form_edit_personnel2.php\"> Επεξεργασία Στοιχείων Προσωπικού </a> ";
                                echo $myHerf;
                            }
                            ?>           
                         </div>   
                        
                        <?php
                             echo nl2br("**************** *************************** **************");
                         ?>  
                                                
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD") {
                                $myHerf = " <a id=\"view_leave\" style=\"color: red; font-size: 20px; background-color: yellow;\" href=\"form_view_leave.php\"> Προβολή Αδειών Προσωπικού </a> ";
                                echo $myHerf;
                            }
                            ?>           
                         </div>  
                        
                            <?php
                             echo nl2br("**************** *************************** **************");
                            ?>   
                        
                          <div >
                            <?php
                            if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD") {
                                $myHerf = " <a id=\"view_pgrleave\" style=\"color: red; font-size: 20px; background-color: yellow;\" href=\"form_view_pgrleave2.php\"> Προβολή Προγραμματισμένων Αδειών Προσωπικού </a> ";
                                echo $myHerf;
                            }
                            ?>           
                         </div>   
                        
                        <?php
                             echo nl2br("**************** *************************** **************");
                         ?>  
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                                $myHerf = " <a id=\"add_prsdata\" style=\"color: red; font-size: 20px; background-color: cyan;\" href=\"form_add_prsdata.php\"> Εισαγωγή Στοιχείων Διεύθυνσης Προσωπικού </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>                           
                        
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                                $myHerf = " <a id=\"edit_prsdata\" style=\"color: red; font-size: 20px; background-color: cyan;\" href=\"form_edit_prsdata2.php\"> Διόρθωση Στοιχείων Διεύθυνσης Προσωπικού </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>    
                        
                         <div >
                            <?php
                            if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                                $myHerf = " <a id=\"add_duty\" style=\"color: red; font-size: 20px; background-color: orange;\" href=\"form_add_duty.php\"> Εισαγωγή Καθηκόντων Προσωπικού </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>                           
                        
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                                $myHerf = " <a id=\"edit_duty\" style=\"color: red; font-size: 20px; background-color: orange;\" href=\"form_edit_duty.php\"> Διόρθωση Καθηκόντων Προσωπικού </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>  
                        
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role == "MED" || $user->role2 == "MED+") {
                                $myHerf = " <a id=\"add_medata\" style=\"color: red; font-size: 20px; background-color: cyan;\" href=\"form_add_medata_asma.php\"> Εισαγωγή Ιατρικών Στοιχείων </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>  
                        
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role == "MED" || $user->role2 == "MED+") {
                                $myHerf = " <a id=\"edit_medata\" style=\"color: red; font-size: 20px; background-color: cyan;\" href=\"form_edit_medata_asma.php\"> Διόρθωση Ιατρικών Στοιχείων </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>                           

                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role == "MED" || $user->role2 == "MED+" || $user->role == "CMD" || $user->role2 == "STAFF+") {
                                $myHerf = " <a id=\"edit_tpye\" style=\"color: black; font-size: 20px; background-color: yellow;\" href=\"form_view_tpye_user.php\"> Προβολή ΤΠΥΕ & ΙΑΤΡ. ΕΞΕΤΑΣΕΩΝ Προσωπικού </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>   
                        
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role == "MED" || $user->role2 == "MED+" || $user->role == "CMD" || $user->role2 == "STAFF+") {
                                $myHerf = " <a id=\"view_sum_tpye\" style=\"color: black; font-size: 20px; background-color: orange;\" href=\"form_view_personnel_tpye.php\"> Σύνολο Τελευταίου ΤΠΥΕ ή ΙΑΤΡ. ΕΞΕΤΑΣΕΩΝ Προσωπικού </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>   
                        
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+") {
                                $myHerf = " <a id=\"view_event\" style=\"color: black; font-size: 20px; background-color: cyan;\" href=\"form_view_event_asma.php\"> Προβολή Μεταβολών Προσωπικού </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>   
                                                                                             
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role == "TRAIN" || $user->role2 == "TRAIN+" || $user->role == "CMD" || $user->role3 == "TRAIN"){
                                $myHerf = " <a id=\"edit_duty\" style=\"color: red; font-size: 20px; background-color: orange;\" href=\"form_edit_trfolder_asma.php\"> Διόρθωση Στοιχείων Φακέλου ΕΚΠ </a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>  
                        
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role == "STAFF" || $user->role2 == "STAFF+" || $user->role == "CMD" || $user->role3 == "TRAIN") {
                                $myHerf = " <a id=\"edit_medata\" style=\"color: red; font-size: 20px; background-color: cyan;\" href=\"form_edit_abm_asma.php\"> Διόρθωση Στοιχείων ABM</a> ";                               
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?>   
                       
                        <div >
                            <?php
                            if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "TRAIN") {
                                 $myHerf = " <a id=\"intercept\" style=\"color: red; font-size: 20px; background-color: cyan;\" href=\"form_view_intercept_by_asma.php\"> Προβολή Αναχαιτίσεων</a> ";
                                echo $myHerf;
                            }                            
                            ?>                                                                                  
                        </div>    
                        
                        <?php
                       echo nl2br("**************** *************************** **************");
                        ?> 
                                               
                    </div>
                                      
                </div>
                               
            </div>
                                                            
            
            <h2> ************************************************************************ </h2>
            
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"> <strong style="color: red;">  View Personnel Detail Info </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>  
                    <a class="navbar-brand" href="admin_dashboard.php"> <strong style="color: red; ">  Admin </strong> </a>  
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 
                    
                    <?php
                       echo nl2br(" .\n ***************************************************************************************************************.");
                      ?>                       
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

        <script type="text/javascript" src="../js/form_personnel_detail_info.js"></script>  
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



