<?php
require_once("../php_functions/functions.inc");
$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));
}

if (!$user->admin == 1 ) { 
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

        <title> 2ο ΑΚΕ - Admin Dashboard </title>

        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css"  href="../styles/admin_dashboard.css">

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
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button> 
                    <a class="navbar-brand" href="../index.php"> <strong style="color: red; "> 2o AKE / </strong> </a>
                     <b class="navbar-brand" > <i><?php echo $user->division . " / " . $user->branch . " / " . $user->office ;  ?></i></b>                                        
                    <c class="navbar-brand">Welcome : <i><?php echo $user->sname . " " . $user->fname; ?></i></c>

                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">

                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="./logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                    <!-- /.dropdown -->
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="./logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout </a>
                            </li>
                            <li>
                                <a style="color: red" href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>

                            <li>
                                <a href="#"><i style="color: red" class="fa fa-bar-chart fa-fw"></i> Προσωπικό</a>
                                 <ul class="nav nav-second-level">                                     
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a href=\"form_add_personnel.php\"> Εισαγωγή Προσωπικού </a> ";
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+") {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                    </li>
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a href=\"form_edit_personnel.php\"> Επεξεργασία Στοιχείων Προσωπικού </a> ";
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+") {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                    </li>
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a href=\"form_view_personnel_all.php\"> Προβολή Συνόλου Προσωπικού 1ου ΑΚΕ </a> ";                                                                                                                                                                                                        
                                        //echo $myHerf;                                           
                                        ?>                                                                                  
                                    </li>                                                                                                                                                                  
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_previous.php\"> Προβολή ΠΡΣ που έχει μετατεθεί </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD") {                                        
                                            echo $myHerf;
                                        }
                                        ?>                                                                                  
                                    </li> 
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_delete_personnel.php\"> ΔΙΑΓΡΑΦΗ ΠΡΣ </a> ";   
                                        if ($user->role == "SYS") {                                        
                                            echo $myHerf;
                                        }
                                        ?>                                                                                  
                                    </li> 
                                    
                                </ul>
                            </li>
                            
                            
                            <li>                                
                                <?php
                                $myHerf = " <a style=\"color: red; background-color: blue;\"> <i style=\"color: red;\" class=\"fa fa-users\"> </i> ΤΠΥΕ ΠΡΟΣΩΠΙΚΟΥ <span class=\"fa arrow\"></span></a> ";
                                if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") {
                                    echo $myHerf;
                                }
                                ?>  
                                <ul class="nav nav-second-level">                                                                                                             
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: purple;\" href=\"form_view_personnel_tpye.php\"> Προβολή ΤΠΥΕ Σύνολο ΠΡΣ </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") { 
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>                                      

                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: green;\" href=\"form_view_personnel_tpye_epit.php\"> ΕΠΙΤΕΛΕΙΟ ΤΠΥΕ Προσωπικού </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") { 
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"form_view_personnel_tpye_dee.php\"> ΔΕΕ ΤΠΥΕ Προσωπικού </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: purple;\" href=\"form_view_personnel_tpye_dyp.php\"> ΔΥΠ ΤΠΥΕ Προσωπικού </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_tpye_me.php\"> ΜΕΠ ΤΠΥΕ Προσωπικού </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") { 
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"form_view_personnel_tpye_myp.php\">  ΜΥΠ ΤΠΥΕ Προσωπικού </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: blue;\" href=\"form_view_personnel_tpye_saf.php\">  ΣΑΦ ΤΠΥΕ Προσωπικού </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: green;\" href=\"form_view_personnel_tpye_sef.php\">  ΣΕΦ ΤΠΥΕ Προσωπικού </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_tpye_seep.php\">  ΣΕΕΠ ΤΠΥΕ Προσωπικού </a> ";   
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role2 == "MED+"|| $user->role == "CMD") {  
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 
                                    
                                </ul>
                                 <!--/.nav-second-level--> 
                            </li>
                            
                            
                            
                            
                            <li>
                                <a href="#"><i class="fa fa-user"></i> Άδειες Προσωπικού <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"form_view_current_leaves.php\"> Προβολή Τρεχουσών Αδειών </a> ";                                                                                
                                            echo $myHerf;;                                        
                                        ?>                                                                                  
                                    </li>                                   
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"form_view_current_pgrleaves.php\"> Προβολή Επικείμενων Προγραμματισμένων Αδειών </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+") {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                    </li>
                                    
                                    
                                     <li>
                                        <?php
                                        $myHerf = " <a style=\"color: blue;\" href=\"form_view_leave_sum1.php\"> Προβολή Συνόλου Αδειών Τρέχοντος 'Ετους </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+") {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                     </li>
                                     
                                     <li>
                                        <?php
                                        $myHerf = " <a style=\"color: orange;\" href=\"form_view_leave_sum3.php\"> Προβολή Συνόλου Αδειών Προηγούμενου 'Ετους </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+") {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                     </li>
                                     
                                     <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_view_pgrleave_sum1.php\"> Προβολή Προγραμματισμένων Αδειών </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+") {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                     </li>
                                     
                                     <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"form_add_leave.php\"> Εισαγωγή νέας Άδειας </a> ";
                                        if ($user->role == "SYS" || $user->role2 == "STAFF+") {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                    </li>
                                    
                                     <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_view_leave_sum2.php\"> Προβολή Συνόλου Αδειών 2 </a> ";
                                        if ($user->role == "SYS" ) {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                     </li>
                                     
                                     <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_delete_all_leavepgr.php\"> Διαγραφή Συνόλου Πργ/μένων Αδειών </a> ";
                                        if ($user->role == "SYS" || $user->role3 == "SYSTEM") {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                    </li>
                                    
                                </ul>
                            </li>
                                                       
                            
                            <li>
                                <a href="#"><i class="fa fa-mortar-board"></i> Training <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                                                        
                                    <li>
                                        <a style="color: black; background-color: yellow;" href="#"> Εισαγωγή <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_add_school.php\"> Εισαγωγή Σχολείων / Σεμιναρίων </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "TRAIN+" || $user->role3 == "TRAIN") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_add_school_bydiv.php\"> Εισαγωγή Σχολείων σε Προσωπικό </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "TRAIN+" || $user->role3 == "TRAIN") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                    
                                    
                                    <li>
                                        <a style="color: red; background-color: cyan;" href="#"> Προβολή <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_schools.php\"> Προβολή Συνόλου Σχολείων </a> ";
                                                 if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "TRAIN+" || $user->role2 == "STAFF+" || $user->role3 == "TRAIN") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_school_bydiv.php\"> Προβολή Σχολείων ανά Επιστασία </a> ";
                                                 if ($user->role == "SYS" || $user->role2 == "TRAIN+" || $user->role == "CMD" || $user->role2 == "STAFF+" || $user->role3 == "TRAIN") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_select_school.php\"> Προβολή Προσωπικού ανά Σχολείο </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "TRAIN+" || $user->role == "CMD" || $user->role2 == "STAFF+" || $user->role3 == "TRAIN") {
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>                                                                        
                                    
                                </ul>
                            </li>
                            
                            
                            
                            

                            <li>
                                <a style="color: black;" href="#"><i class="fa fa-cogs"></i> CRF <span class="fa arrow"> </span></a>
                                <ul class="nav nav-second-level">
                                    
                                    
                                      <li>
                                        <a style="color: black;background-color: orange;" href="#">UpLoad or Replace <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_upload_file.php\"> Upload File </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "CRF+") {   
                                                    echo $myHerf;
                                                }
                                                ?>  
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_replace_file.php\"> Replace File </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "CRF+") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                                                        
                                    <li>
                                        <a style="color: black; background-color: yellow;" href="#"> Εισαγωγή <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_add_crf_all.php\"> Εισαγωγή CRF στο Σύνολο </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "CRF+") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_add_crf_div.php\"> Εισαγωγή CRF ανά Επιστασία </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "CRF+") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_add_crf1_asma.php\"> Εισαγωγή CRF ανά Χρήστη </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "CRF+") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_add_crf_year_asma.php\"> Εισαγωγή CRF ενός Έτους σε Χρήστη </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "CRF+") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                    
                                    
                                      <li>
                                        <a style="color: yellow; background-color: red;" href="#"> Διαγραφή <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_delete_crf_asma.php\"> Διαγραφή CRF από Χρήστη </a> ";
                                                 if ($user->role == "SYS" || $user->role2 == "CRF+") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_delete_crf_asma_all.php\"> Διαγραφή Όλων των CRF από Χρήστη </a> ";
                                                 if ($user->role == "SYS" || $user->role2 == "CRF+") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_delete_crf_div.php\"> Διαγραφή CRF ανά Επιστασία </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "CRF+") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                    
                                    
                                    
                                    <li>
                                        <a style="color: red;background-color: cyan;" href="#"> Προβολή <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_crfiles.php\"> Προβολή Συνόλου CRFs </a> ";
                                                if ($user->role == "SYS" || $user->role2 == "CRF+" || $user->role == "CMD") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_view_crf_bydiv.php\"> Προβολή Status CRFs ανά Επιστασία</a> ";
                                                  if ($user->role == "SYS" || $user->role2 == "CRF+" || $user->role == "CMD") { 
                                                    echo $myHerf;
                                                }
                                                ?>                       
                                            </li>                                            

                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>                                                                                                                                                                                                                        
                                    
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            
                            
                            <li>                                
                                <?php
                                $myHerf = " <a style=\"color: red; background-color: yellow;\"> <i style=\"color: red;\" class=\"fa fa-users\"> </i> ΜΕΤΑΒΟΛΕΣ <span class=\"fa arrow\"></span></a> ";
                                if ($user->role == "SYS" || $user->role2 == "STAFF+" || $user->role == "CMD") {
                                    echo $myHerf;
                                }
                                ?>  
                                <ul class="nav nav-second-level">                                                                                                             
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"./form_add_event_bydiv.php\"> Εισαγωγή Μεταβολών </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+" ) {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  

                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"./form_view_event_bydate.php\"> Προβολή Μεταβολών Περιόδου </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  

                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"./form_view_event_current.php\"> Προβολή Τρέχουσων Μεταβολών </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"./form_view_event_bydiv.php\"> Προβολή Μεταβολών / Επιστασία </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+" ) {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: darkred;\" href=\"./form_view_event_bydate2.php\"> Προβολή Μεταβολών ΠΡΩΗΝ ΠΡΣ  </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+" ) {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"./form_view_event_sum1.php\"> Προβολή Συνόλου Μεταβολών</a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "STAFF+" ) {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 
                                    
                                </ul>
                                 <!--/.nav-second-level--> 
                            </li>
                              
                            
                            <li>                                
                                <?php
                                $myHerf = " <a style=\"color: red; background-color: cyan;\"> <i style=\"color: red;\" class=\"fa fa-bug\"> </i> ΣΥΜΒΑΝΤΑ <span class=\"fa arrow\"></span></a> ";
                                if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "MC" || $user->role3 == "SYSTEM" || $user->role3 == "CMDR") {
                                    echo $myHerf;
                                }
                                ?>  
                                <ul class="nav nav-second-level">                                                                                                             
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"./form_add_major.php\"> Εισαγωγή Συμβάντων </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "MC" || $user->role3 == "SYSTEM" || $user->role3 == "CMDR") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  

                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"./form_view_major_bydate2.php\"> Προβολή Συμβάντων Περιόδου </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "MC" || $user->role3 == "SYSTEM" || $user->role3 == "CMDR") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  

                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"./form_view_major_bydate.php\"> Προβολή Συμβάντων Ημέρας </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "MC" || $user->role3 == "SYSTEM" || $user->role3 == "CMDR") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>       
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"./form_view_major_sum1.php\"> Προβολή Συνόλου Συμβάντων</a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "MC" || $user->role3 == "SYSTEM" || $user->role3 == "CMDR") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>      
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: blue;\" href=\"../web/videos/MajorEvents3.mp4\"> Εισαγωγή Συμβάντος (Βοήθεια) </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "MC" || $user->role3 == "SYSTEM" || $user->role3 == "CMDR") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 
                                    
                                    
                                    
                                </ul>
                                 <!--/.nav-second-level--> 
                            </li>
                                                  
                            <li>                                
                                <?php
                                $myHerf = " <a style=\"color: blue; background-color: orange;\"> <i style=\"color: blue;\" class=\"fa fa-check-square-o\"> </i> TASKs / JOBs <span class=\"fa arrow\"></span></a> ";
                                if ($user->role == "SYS"  || $user->role == "CMD") {
                                    echo $myHerf;
                                }
                                ?>  
                                <ul class="nav nav-second-level">                                                                                                             
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"./form_add_task.php\"> Εισαγωγή Εργασιών </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" ) {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 

                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: blue;\" href=\"./form_view_task_main.php\"> Προβολή Ενεργών Εργασιών </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" ) {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>

                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"./form_view_task_main_close.php\"> Προβολή Ολοκληρωμένων Εργασιών</a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" ) {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>      
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: blue;\" href=\"#\"> Προβολή </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" ) {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>     
                                    
                                </ul>
                                 <!--/.nav-second-level--> 
                            </li>
                                                                                   
                            
                            <li>
                                <a href="#"><i style="color: red" class="fa fa-bomb fa-adjust"></i> Upload Files </a>
                                 <ul class="nav nav-second-level">                                     
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a href=\"form_upload_sfile1.php\"> UpLoad File </a> ";
                                        if ($user->role == "SYS" ) {                                           
                                            echo $myHerf;;
                                        }
                                        ?>                                                                                  
                                    </li>
                                                                                                                                                                                                                                                     
                                    
                                </ul>
                            </li>
                                                                                                                                            
                            
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Extra<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">

                                    <li>
                                       <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"phpinfo.php\"> phpinfo </a> ";                                                                                
                                        if ($user->role == "SYS" ) { 
                                            echo $myHerf;;
                                        }                                                                                  
                                        ?> 
                                    </li>
                                    
                                    <li>
                                       <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"zx_form_sys.php\"> SYS Functions </a> ";                                                                                
                                        if ($user->role == "SYS" ) { 
                                            echo $myHerf;;
                                        }                                                                                  
                                        ?> 
                                    </li>
                                    
                                    <li>
                                       <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_add_supply1.php\"> Test Function </a> ";                                                                                
                                        if ($user->role == "SYS" ) { 
                                            echo $myHerf;;
                                        }                                                                                  
                                        ?> 
                                    </li>
                                    
                                    <li>
                                       <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"form_add_intercept.php\"> intercept </a> ";                                                                                
                                        if ($user->role == "SYS" ) { 
                                            //echo $myHerf;;
                                        }                                                                                  
                                        ?> 
                                    </li>
                                    

                                    <li>
                                        <a href="#">Third Level <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
                                        </ul>
                                        <!-- /.nav-third-level -->
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
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
                            <h1 class="page-header"> 2ο ΑΚΕ Admin Dashboard</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <h2 class="h2"><?php
                                setlocale(LC_ALL, "EL");
                                echo date("l, j F Y");
                                ?></h2>
                        </div>
                    </div>
                    <!-- /wra kai imerominia -->



                    <div class="row">

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            
                                            <?php 
                                                require_once '../php_functions/Cvutils/utils.php';
                                                require_once '../php_functions/db_config/db_connect.php';
                                                require_once("../php_functions/functions.inc");
                                                $ShareTo = $user->asma;
                                                $sql = "SELECT * FROM taskmain WHERE (share1 = '{$ShareTo}' OR share2 ='{$ShareTo}') ";                    
                                                
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $countasks= mysqli_num_rows($res);
                                                echo "<div class=\"huge\">" . $countasks . "</div>";
                                            
                                            ?>
                                            
                                            <div>Shared Tasks!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="./form_view_task_main.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-bell-o fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            
                                             <?php 
                                                require_once '../php_functions/Cvutils/utils.php';
                                                require_once '../php_functions/db_config/db_connect.php';
                                                require_once("../php_functions/functions.inc");
                                                $owner = $user->asma;
                                                $Finished = "No";
                                                $sql = "SELECT * FROM taskmain WHERE owner = '{$owner}' AND complete='{$Finished}'";                    
                                                
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $countasks= mysqli_num_rows($res);
                                                echo "<div class=\"huge\">" . $countasks . "</div>";
                                            
                                            ?>
                                            
                                            <!--<div class="huge"> 07 </div>-->                                          
                                            <div>Owned Tasks!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="./form_view_task_main.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                         <?php 
                         if ($user->role == "SYS" || $user->role2 == "ADP+") {
                            echo "<a href=\"./form_add_post.php\" > <span class=\"pull-left\"><i class=\"fa fa-plus-circle\"></i></span> <span>Νέα Δημοσίευση</span> <div class=\"clearfix\"></div> </a>\n"; 
                         } else {
                            echo "<a href=\"#\" > <span class=\"pull-left\"><i class=\"fa fa-plus-circle\"></i></span> <span>Νέα Δημοσίευση</span> <div class=\"clearfix\"></div> </a>\n";  
                         }
                         
                         ?>
<!--                        <a href="./form_add_post.php" > <span class="pull-left"><i class="fa fa-plus-circle"></i></span> <span>Νέα Δημοσίευση</span> <div class="clearfix"></div> </a>-->

                    </div>
                    <br />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Διαχείριση Εργασιών 
                        </div>
                        
                                <!-- <li>
                                     <div class="timeline-badge warning"><i class="fa fa-beer"></i>
                                     </div>
                                     <div class="timeline-panel"  style="background-color: #ebccd1">
                                         <div class="timeline-heading">
                                             <h4>Test 1</h4>
                                         </div>
                                         <div class="timeline-body">
 
                                             <p>Hellooo!!</p>
                                             <div class="row">
 
                                                 <small class="text-right">Feb 2016</small>
                                                 <em class="text-center text-primary">Gerontopoulos</em>
                                             </div>
                                         </div>
                                     </div>
 
                                 </li> -->
                               
                                
                                <?php
                                
                                echo "<table>\n";
                                
                                echo "<tr>\n";
                                echo "<th class=\"code\"> Adding   </th>\n";
                                echo "<th class=\"custom\"> Editing </th>\n";
                                echo "<th class=\"sideR\">  Deletion </th>\n";                                
                                echo "</tr>\n";
                                //New Line  RADAR 
                                echo "<tr>\n";                                
                                if ($user->role == "SYS" || $user->role2 == "ADP+") {
                                    echo "<td class=\"code\"> <a href=\"./form_add_sensor.php\"> Add RADAR Sensors </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"code\"> <a href=\"#\"> Add RADAR Sensors </a> </td>\n";
                                }                                
                                if ($user->role == "SYS" || $user->role2 == "ADP+") {
                                    echo "<td class=\"custom\"> <a href=\"./form_edit_sensor.php\"> Edit RADAR Sensors </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"custom\"> <a href=\"#\"> Edit RADAR Sensors </a> </td>\n";
                                }   
                               if ($user->role == "SYS") {
                                    echo "<td class=\"sideR\"> <a href=\"./form_delete_sensor.php\"> Delete RADAR Sensors </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"sideR\"> <a href=\"#\"> Delete RADAR Sensors </a> </td>\n";
                                }                                
                                echo "</tr>\n";
                                
                                                                
                                //New Line RADIO
                                echo "<tr>\n";
                                if ($user->role == "SYS" || $user->role2 == "ROIP+") {
                                   echo "<td class=\"code\"> <a href=\"./form_add_radio.php\"> Add Radios </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"code\"> <a href=\"#\"> Add Radios </a> </td>\n";
                                }                                                                
                                if ($user->role == "SYS" || $user->role2 == "ROIP+") {
                                    echo "<td class=\"custom\"> <a href=\"./form_edit_radio.php\"> Edit Radio </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"custom\"> <a href=\"#\"> Edit Radio </a> </td>\n";
                                }  
                               if ($user->role == "SYS" || $user->role2 == "ROIP+") {
                                    echo "<td class=\"sideR\"> <a href=\"./form_delete_radio.php\"> Delete Radios </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"sideR\"> <a href=\"#\"> Delete Radios </a> </td>\n";
                                }         
                                echo "</tr>\n";
                                
                                
                                //New Line Tactical DATA LINK
                                echo "<tr>\n";
                                if ($user->role == "SYS" || $user->role2 == "TDL+") {
                                   echo "<td class=\"code\"> <a href=\"./form_add_tdl.php\"> Add TDLs </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"code\"> <a href=\"#\"> Add TDLs </a> </td>\n";
                                }                                  
                                if ($user->role == "SYS" || $user->role2 == "TDL+") {
                                    echo "<td class=\"custom\"> <a href=\"./form_edit_tdl.php\"> Edit TDL </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"custom\"> <a href=\"#\"> Edit TDL </a> </td>\n";
                                }  
                                if ($user->role == "SYS" || $user->role2 == "TDL+") {
                                    echo "<td class=\"sideR\"> <a href=\"./form_delete_tdl.php\"> Delete TDLs </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"sideR\"> <a href=\"#\"> Delete TDLs </a> </td>\n";
                                }    
                                echo "</tr>\n";
                                
                                
                                //New HOTLINE
                                echo "<tr>\n";
                                if ($user->role == "SYS" || $user->role2 == "COM+" || $user->role2 == "ROIP+") {
                                   echo "<td class=\"code\"> <a href=\"./form_add_hotline.php\"> Add HOTLINE </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"code\"> <a href=\"#\"> Add HOTLINE  </a> </td>\n";
                                }                                  
                                if ($user->role == "SYS" || $user->role2 == "COM+" || $user->role2 == "ROIP+") {
                                    echo "<td class=\"custom\"> <a href=\"./form_edit_hotline.php\"> Edit HOTLINE </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"custom\"> <a href=\"#\"> Edit HOTLINE </a> </td>\n";
                                }  
                                if ($user->role == "SYS" || $user->role2 == "COM+" || $user->role2 == "ROIP+") {
                                    echo "<td class=\"sideR\"> <a href=\"./form_delete_hotline.php\"> Delete HOTLINE </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"sideR\"> <a href=\"#\"> Delete HOTLINE </a> </td>\n";
                                }    
                                echo "</tr>\n";
                                
                                //New Air Assets
                                echo "<tr>\n";
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                   echo "<td class=\"code\"> <a href=\"./form_add_air_asset.php\"> Add Air Asset </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"code\"> <a href=\"#\"> Add Air Asset  </a> </td>\n";
                                }                                  
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                    echo "<td class=\"custom\"> <a href=\"./form_edit_air_asset.php\"> Edit Air Asset </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"custom\"> <a href=\"#\"> Edit Air Asset </a> </td>\n";
                                }  
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                    echo "<td class=\"sideR\"> <a href=\"./form_delete_air_asset.php\"> Delete Air Asset </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"sideR\"> <a href=\"#\"> Delete Air Asset </a> </td>\n";
                                }    
                                echo "</tr>\n";
                                
                                //New Rescue Assets
                                echo "<tr>\n";
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                   echo "<td class=\"code\"> <a href=\"./form_add_resc_asset.php\"> Add RESCUE Asset </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"code\"> <a href=\"#\"> Add RESCUE Asset  </a> </td>\n";
                                }                                  
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                    echo "<td class=\"custom\"> <a href=\"./form_edit_resc_asset.php\"> Edit RESCUE Asset </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"custom\"> <a href=\"#\"> Edit RESCUE Asset </a> </td>\n";
                                }  
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                    echo "<td class=\"sideR\"> <a href=\"./form_delete_resc_asset.php\"> Delete RESCUE Asset </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"sideR\"> <a href=\"#\"> Delete RESCUE Asset </a> </td>\n";
                                }    
                                echo "</tr>\n";
                                
                                //New SART Status
                                echo "<tr>\n";
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                   echo "<td class=\"code\"> <a href=\"./form_add_sart.php\"> Add SART </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"code\"> <a href=\"#\"> Add SART </a> </td>\n";
                                }                                  
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                    echo "<td class=\"custom\"> <a href=\"./form_edit_sart.php\"> Edit SART</a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"custom\"> <a href=\"#\"> Edit SART </a> </td>\n";
                                }  
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                    echo "<td class=\"sideR\"> <a href=\"./form_delete_sart.php\"> Delete SART </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"sideR\"> <a href=\"#\"> Delete SART </a> </td>\n";
                                }    
                                echo "</tr>\n";
                                
                                //New Missions
                                echo "<tr>\n";
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                   echo "<td class=\"code\"> <a href=\"./form_add_missions.php\"> Add New Mission </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"code\"> <a href=\"#\"> Add New Mission </a> </td>\n";
                                }                                  
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                    echo "<td class=\"custom\"> <a href=\"./form_edit_missions.php\"> Edit Mission</a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"custom\"> <a href=\"#\"> Edit Mission </a> </td>\n";
                                }  
                                if ($user->role == "SYS" || $user->role2 == "OPS+") {
                                    echo "<td class=\"sideR\"> <a href=\"./form_delete_missions.php\"> Delete Mission </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"sideR\"> <a href=\"#\"> Delete Mission </a> </td>\n";
                                }    
                                echo "</tr>\n";
                                
                                //New Log Records
                                echo "<tr>\n";
                                if ($user->role == "SYS" || $user->role2 == "EXER+") {
                                   echo "<td class=\"code\"> <a href=\"./form_add_logbook.php\"> Add New Log Record </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"code\"> <a href=\"#\"> Add New Mission </a> </td>\n";
                                }                                  
                                if ($user->role == "SYS" || $user->role2 == "EXER+") {
                                    echo "<td class=\"custom\"> <a href=\"./form_edit_logbook.php\"> Edit Log Record</a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"custom\"> <a href=\"#\"> Edit Mission </a> </td>\n";
                                }  
                                if ($user->role == "SYS" || $user->role2 == "EXER+") {
                                    echo "<td class=\"sideR\"> <a href=\"./form_delete_logbook.php\"> Delete Log Record </a> </td>\n";                                    
                                } else {
                                    echo "<td class=\"sideR\"> <a href=\"#\"> Delete Mission </a> </td>\n";
                                }    
                                echo "</tr>\n";
                                
                                //Last Line
                                echo "<tr>\n";
                                echo "<td class=\"Last\"> </td>\n";
                                echo "<td class=\"Last\"> </td>\n";
                                echo "<td class=\"Last\"> </td>\n";
                                echo "</tr>\n";
                                
                                echo "</table>\n";
                                
                                ?>
                        
                    </div>

                    <!-- 
                    
                    Modal Start
                    
                    -->

                    <div class="modal fade" id="add_new_post" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title text-center">Add New Post</h4>
                                    <div class="modal-body">
                                        <p>Hallo, you are going to add a mew post </p>
                                        <form role="form" id="addPost" name="addNewPost" action="../php_functions/add_New_Post.php" method="POST">
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <?php
                                                    // $user_reg = $_SESSION['login_user'][2];
                                                    $Post_User = $user->sname . " " . $user->fname;
                                                    echo "<div class=\"col-sm-8\"><strong class=\"text-danger\">$Post_User  </strong></div>";
                                                    echo "<input class=\"hidden\" name=\"user_reg\"  value=\"" . $Post_User . "\">";
                                                    ?>

                                                </div>
                                                <div class="form-group bg-primary">
                                                    <label class="col-sm-2 control-label">Title : </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="title" class="form-control input-group-lg" required="Τίτλος" placeholder="Τιτλος">
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" required="Write" name="message"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" id="postNews" class="btn btn-primary">Post</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>

            <!-- /# page wrapper -->

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

        <script>
            $(document).ready(function () {
                $("#postNews").click(function () {
                    $("#addPost").submit();
                });

            });

            function NWin() {
                var NWin = window.open("", "", "width=600, height=800");
            }

            $(document).ready(function () {
                $('#Popup').click(function NWin() {
                    var NWin = window.open(window.open($(this).prop('href'), '', 'height=800,width=800'));
                    if (window.focus)
                    {
                        NWin.focus();
                    }
                    return false;
                });
            });
        </script>


        <script type="text/javascript">
            $(document).ready(function () {
                $('#refresh').load('posts.php');
                refresh();
            });

            function refresh()
            {
                setTimeout(function () {
                    $('#refresh').fadeOut("slow").load('posts.php').fadeIn('800, swing');
                    refresh();
                }, 30000);

            }

        </script>

    </body>

</html>
