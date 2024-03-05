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

        <title> 2ο ΑΚΕ - dashboard </title>

        <!-- Bootstrap Core CSS -->
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../dist/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css"  href="../styles/user_dashboard.css">

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
                    <c class="navbar-brand">Welcome : <i><?php echo $user->sname . " " . $user->fname . " " . $user->asma; ?></i></c>

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
                            <li>
                                <a href="./change_passwd.php"><i class="fa fa-wrench fa-fw"></i> Change Password </a>
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
                                <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Άδειες Προγραμματισμός</a>                
                                <!-- /.nav-second-level -->
                                <ul class="nav nav-second-level">
                                    <li>
                                        <?php
                                        $myHerf = " <a href=\"form_add_pgr_leave.php\"> Εισαγωγή νέας Άδειας </a> ";                                                                                                                                                                                                        
                                        echo $myHerf;                                           
                                        ?>                                                                                  
                                    </li>
                                </ul>    
                                <ul class="nav nav-second-level">
                                    <li>
                                        <?php
                                        //$myHerf = " <a href=\"form_view_personnel_me.php\"> Προβολή Προσωπικού 2ου ΑΚΕ / ΜΕ </a> ";
                                        $myHerf = " <a href=\"form_view_pgrleave.php\"> Προβολή Πργ. Αδειών </a> ";                                                                                                                                                                                                        
                                        echo $myHerf;                                           
                                        ?>                                                                                  
                                    </li>
                                </ul>  
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-bar-chart fa-fw"></i> Προσωπικό</a>
                                <!-- /.nav-second-level -->
                                
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a style="color: red; "> Σύνολο 2ου ΑΚΕ <span class="fa arrow"></span></a>
                                        <ul class="nav nav-second-level">
                                            <li>
                                                <?php
                                                $myHerf = " <a href=\"form_view_personnel_all.php\"> Προβολή Συνόλου Προσωπικού 2ου ΑΚΕ /100 </a> ";
                                                echo $myHerf;
                                                ?>                                                                                  
                                            </li>


                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_bydiv.php\"> Προβολή Προσωπικού 2ου ΑΚΕ / Επιστασία </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>  

                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_all2.php\"> Προβολή Συνόλου Προσωπικού 2ου ΑΚΕ / 500 </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>       

                                        </ul>  

                                    </li>    

                                </ul>

                                
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a style="color: green; "> Μοίρα Επιχειρήσεων <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            

                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_me_all.php\"> Σύνολο 2ου ΑΚΕ / ΜΕ </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>    
                                            
                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_me_epit.php\"> ΕΠΙΤΕΛΕΙΟ</a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>    
                                            
                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_me_sh1.php\"> 1o ΣΜΗΝΟΣ </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>  
                                            
                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_me_sh2.php\"> 2o ΣΜΗΝΟΣ </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>  
                                            
                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_me_sh3.php\"> 3o ΣΜΗΝΟΣ </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>  
                                            
                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_me_sh4.php\"> 4o ΣΜΗΝΟΣ </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>  
                                            
                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_me_sh5.php\"> 5o ΣΜΗΝΟΣ </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>  
                                                                                                                                                                               

                                        </ul>
                                        <!--//.nav-third-level--> 
                                    </li>                                  

                                </ul>
                                <!--/.nav-second-level--> 
                                
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a style="color: black; "> OBA - Σμηνίτες <span class="fa arrow"></span></a>
                                        <ul class="nav nav-second-level">
                                            <li>
                                                <?php
                                                $myHerf = " <a href=\"form_view_personnel_ovasm_all.php\"> Σύνολο ΟΒΑ - Σμηνίτες </a> ";
                                                echo $myHerf;
                                                ?>                                                                                  
                                            </li>


                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_ova.php\"> Σύνολο ΟΒΑ </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>  

                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a href=\"form_view_personnel_sm.php\"> Σύνολο Σμηνίτες </a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>       

                                        </ul>  

                                    </li>    

                                </ul>    
                                
                                
                               <ul class="nav nav-second-level">
                                    <li>
                                        <a style="color: red; "> Φάκελοι Προσωπικού<span class="fa arrow"></span></a>
                                        <ul class="nav nav-second-level">
                                            <li>
                                                <?php
                                                $myHerf = " <a href=\"\"> Προβολή  </a> ";
                                                //echo $myHerf;
                                                ?>                                                                                  
                                            </li>


                                             <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a style=\"color: green;\" href=\"form_view_personnel_files.php\"> Προβολή Φακέλων Προσωπικού</a> ";
                                                    echo $myHerf;
                                                    ?>                                                                                  
                                                </li>
                                            </ul>   

                                            <ul class="nav nav-second-level">
                                                <li>
                                                    <?php
                                                    $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_tpye.php\"> Προβολή ΤΠΥΕ Προσωπικού </a> ";
                                                    if ($user->role == "SYS" || $user->role2 == "MED+" || $user->role == "CMD") {                                        
                                                        echo $myHerf;
                                                    }
                                                    ?>                                                                                  
                                                </li>
                                            </ul>       

                                        </ul>  

                                    </li>    

                                </ul>
                                
                            </li>
                            
                            <li>
                                <a style="color: black; background-color: yellow;" href="#"><i class="fa fa-edit"></i> Στοιχεία Διεύθυνσης <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">                                                                                                             
                                            <li>
                                                <?php
                                                    $myHerf = " <a href=\"form_view_personnel_prsdata.php\" style=\"color: red\"> Σύνολο Προσωπικού  </a> ";                                                                                                                                                                                                        
                                                    echo $myHerf;                                           
                                                ?>            
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a href=\"form_view_personnel_prsdata_epit.php\" style=\"color: black\"> ΕΠΙΤΕΛΕΙΟ  </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>             
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_prsdata_dee.php\"> ΔΕΕ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>  
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a href=\"form_view_personnel_prsdata_dyp.php\" style=\"color: black\"> ΔΥΠ  </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>             
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_prsdata_me.php\"> ΜΕΠ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>  
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_personnel_prsdata_myp.php\"> ΜYΠ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>  
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_prsdata_saf.php\"> ΣΑΦ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_personnel_prsdata_sef.php\"> ΣEΦ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_prsdata_seep.php\"> ΣΕΕΠ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>
                                    
                                </ul>
                                 <!--/.nav-second-level--> 
                            </li>
                            
                            <li>
                                <a style="color: black; background-color: cyan;" href="#"><i class="fa fa-anchor"></i> Καθήκοντα <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">                                                                                                             
                                            <li>
                                                <?php
                                                    $myHerf = " <a style=\"color: black;\" href=\"form_view_personnel_duty.php\">Σύνολο Προσωπικού </a> ";                                                                                                                                                                                                        
                                                    echo $myHerf;                                           
                                                ?>            
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a href=\"form_view_personnel_duty_epit.php\" style=\"color: black\"> ΕΠΙΤΕΛΕΙΟ  </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>             
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_duty_dee.php\"> ΔΕΕ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>  
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_personnel_duty_dyp.php\"> ΔΥΠ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>             
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_duty_me.php\"> ΜΕΠ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>  
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_personnel_duty_myp.php\"> ΜYΠ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>  
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_duty_saf.php\"> ΣΑΦ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_personnel_duty_sef.php\"> ΣEΦ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: red;\" href=\"form_view_personnel_duty_seep.php\"> ΣΕΕΠ </a> ";                                                 
                                                echo $myHerf;                                                
                                                ?>   
                                            </li>
                                    
                                </ul>
                                 <!--/.nav-second-level--> 
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i> Ασκήσεις - Αξιολογήσεις <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <?php
                                        $myHerf = " <a href=\"form_view_logbook.php\"> Προβολή Ημερολογίου ΚΕΠΙΧ 2ου ΑΚΕ </a> ";                                                                                                                                                                                                        
                                        echo $myHerf;;                                           
                                        ?>                                                                                  
                                    </li>
                                    <li>
                                        <a href="#"> TBD ...</a>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> Ρυθμίσεις<span class="fa arrow"> </span></a>
                                <ul class="nav nav-second-level">

                                    <li>
                                        <a href="./change_passwd.php"><i class="fa arrow"></i> Change Password </a>
                                    </li>
                                    <li>
                                        <a href="./form_edit_my_prsdata.php"><i class="fa arrow"></i> Ενημέρωση Προσωπικών Στοιχείων </a>
                                    </li>

                                 </ul>    
                            </li>    
                            
                            <li>
                                <a href="#"><i class="fa fa-mortar-board"></i> Training <span class="fa arrow"> </span></a>
                                <ul class="nav nav-second-level">

                                    <li>
                                        <a href="./form_view_school_private.php"><i class="fa arrow"></i> Προβολή Σχολείων </a>
                                    </li>

                                 </ul>    
                            </li>    
                            
                            <li>
                                <a href="#"><i class="fa fa-thumbs-up"></i> Συνεργασίες / Αναχαιτίσεις <span class="fa arrow"> </span></a>
                                <ul class="nav nav-second-level">

                                    <li>
                                        <a href="./form_add_intercept.php"><i class="fa arrow"></i> Εισαγωγή Συνεργασιών </a>
                                    </li>
                                    
                                    <li>
                                        <a href="./form_view_intercept_asma.php"><i class="fa arrow"></i> Προβολή Συνεργασιών </a>
                                    </li>
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_view_intercept_bydate.php\"> Προβολή Αναχαιτίσεων ανά Ημέρα </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "TRAIN+" || $user->role3 == "TRAIN" || $user->role3 == "MC") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: blue;\" href=\"form_view_intercept_bydate2.php\"> Προβολή Αναχαιτίσεων Περιόδου </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "TRAIN+" || $user->role3 == "TRAIN" | $user->role3 == "MC") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"form_view_intercept_bydiv.php\"> Προβολή Αναχαιτίσεων Προσωπικού </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "TRAIN+" || $user->role3 == "TRAIN" | $user->role3 == "MC") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"form_view_intercept_sum1.php\"> Προβολή Συνόλου Αναχαιτίσεων</a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "TRAIN+" || $user->role3 == "TRAIN" | $user->role3 == "MC") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li> 

                                 </ul>    
                            </li>    
                            
                            
                            <li>
                                <a href="#"><i class="fa fa-bug"></i> SSA Ασκήσεις <span class="fa arrow"> </span></a>
                                <ul class="nav nav-second-level">

                                    <li>
                                        <a href="./form_add_exssa.php"><i class="fa arrow"></i> Εισαγωγή Ασκήσεων </a>
                                    </li>
                                    
                                    <li>
                                        <a href="./form_view_exssa_asma.php"><i class="fa arrow"></i> Προβολή Ασκήσεων </a>
                                    </li>                                                                         

                                 </ul>    
                            </li>   
                            
                            
                            <li>
                                <a href="#"><i class="fa fa-edit"></i> CRF <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">                                                                                                             
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_us_crfiles_user.php\"> Προβολή Ανυπόγραφων CRFs </a> ";                                             
                                                    echo $myHerf;                                                
                                                ?>             
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_sn_crfiles_user.php\"> Προβολή Υπογεγραμένων CRFs </a> ";                                                 
                                                    echo $myHerf;                                                
                                                ?>             
                                            </li>
                                            
                                            <li>
                                                <?php
                                                $myHerf = " <a style=\"color: black;\" href=\"form_view_crfiles.php\"> Προβολή Συνόλου CRFs </a> ";                                                 
                                                    echo $myHerf;                                                
                                                ?>   
                                            </li>                                                                                                                                                     
                                    
                                </ul>
                                 <!--/.nav-second-level--> 
                            </li>
                                                        
                                                                                                                
                            <li>                                
                                <?php
                                $myHerf = " <a style=\"color: red;\"> <i style=\"color: red;\" class=\"fa fa-unlock-alt\"> </i> SECURITY <span class=\"fa arrow\"></span></a> ";
                                if ($user->role == "SYS" || $user->role2 == "SEC+" || $user->role3 == "CMDR" || $user->role3 == "DEE" || $user->role3 == "SEC" || $user->role3 == "SEC1") {
                                    echo $myHerf;
                                }
                                ?>  
                                <ul class="nav nav-second-level">                                                                                                             
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"./form_add_secdata_bydiv.php\"> Εισαγωγή Στοιχείων Ασφαλείας </a> ";
                                        if ($user->role == "SYS" || $user->role2 == "SEC+" || $user->role3 == "SEC") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: purple;\" href=\"./form_add_secmoto_bydiv.php\"> Εισαγωγή Στοιχείων Οχημάτων </a> ";
                                        if ($user->role == "SYS" || $user->role2 == "SEC+" || $user->role3 == "SEC") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  

                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"form_view_personnel_secdata.php\"> Προβολή Στοιχείων Ασφαλείας ΠΡΣ </a> ";
                                        if ($user->role == "SYS" || $user->role2 == "SEC+" || $user->role3 == "CMDR" || $user->role3 == "DEE" || $user->role3 == "SEC" || $user->role3 == "SEC1") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  
                                    
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: purple;\" href=\"form_view_personnel_secmoto.php\"> Προβολή Στοιχείων Ασφαλείας Οχημάτων </a> ";
                                        if ($user->role == "SYS" || $user->role2 == "SEC+" || $user->role3 == "CMDR" || $user->role3 == "DEE" || $user->role3 == "SEC" || $user->role3 == "SEC1") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  

                                    <li>
                                        <?php
                                        $myHerf = "<a href=\" " . "../web/dee/images/classified.jpg" . "\" target=\"_blank\" >" . "Προβολή Διαβαθμισμένων Χώρων" . "</a> ";                                        
                                        if ($user->role == "SYS" || $user->role2 == "SEC+" || $user->role3 == "CMDR" || $user->role3 == "DEE" || $user->role3 == "SEC" || $user->role3 == "SEC1") {
                                            echo $myHerf;
                                            
                                        }
                                        ?>                       
                                    </li>                                                                                                                                                      
                                    
                                </ul>
                                 <!--/.nav-second-level--> 
                            </li>
                            
                            
                            <li>                                
                                <?php
                                $myHerf = " <a style=\"color: black; background-color: cyan;\"> <i style=\"color: black;\" class=\"fa fa-fighter-jet\"> </i> ΕΝΤΟΛΕΣ ΑΓΟΡΩΝ <span class=\"fa arrow\"></span></a> ";
                                //if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "CMDR" || $user->role3 == "SUPPLY") { 
                                    echo $myHerf;
                                //}
                                ?>  
                                <ul class="nav nav-second-level">                                                                                                             
                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"./form_add_supply.php\"> Εισαγωγή Εντολής </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                    </li>  

                                    <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"./form_view_supply_main.php\"> Προβολή Εντολών </a> ";
                                        //if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY") {
                                            echo $myHerf;
                                        //}
                                        ?>                       
                                    </li>  
                                                                     
                                   <li>
                                        <?php
                                        $myHerf = " <a style=\"color: red;\" href=\"./form_view_supply_kae.php\"> Προβολή Εντολών / KAE </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                  </li>
                                  
                                  <li>
                                        <?php
                                        $myHerf = " <a style=\"color: black;\" href=\"./form_view_supply_budget.php\"> Προβολή Εντολών / Budget </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                  </li>
                                  
                                  <li>
                                        <?php
                                        $myHerf = " <a style=\"color: blue;\" href=\"./form_view_supply_kae_own.php\"> Προβολή Εντολών /KAE & Budget  </a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                  </li> 
                                  
                                  <li>
                                        <?php
                                        $myHerf = " <a style=\"color: blue;\" href=\"./form_view_supply_main1.php\"> Σύνολο Εντολών Shorting</a> ";
                                        if ($user->role == "SYS" || $user->role == "CMD" || $user->role3 == "SUPPLY") {
                                            echo $myHerf;
                                        }
                                        ?>                       
                                  </li> 
                                    
                                </ul>
                                 <!--/.nav-second-level--> 
                            </li>
                            
                            <li>

                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Extra Functions<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">


                                    <li>
                                        <a href="#"> MISC Admin Jobs <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                            <?php
                                            $myHerf = " <a style=\"color: green;\" href=\"./form_upload_sfile.php\"> <i class=\"fa fa-pencil fa-fw\"></i> UpLoad File to Division</a> ";
                                            if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "ADP+" || $user->role3 == "ADP") {                                           
                                                echo $myHerf;;
                                            }
                                            ?>               
                                            </li>

                                            <li>
                                            <?php
                                            $myHerf = " <a style=\"color: red;\" href=\"./form_add_post.php\"> <i class=\"fa fa-briefcase fa-adjust\"></i> Ανάρτηση Ανακοίνωσης </a> ";
                                            //$myHerf = " <a href=\"./form_add_post.php\"> Ανάρτηση Ανακοίνωσης </a> ";
                                            if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "ADP+") {                                           
                                                echo $myHerf;;
                                            }
                                            ?>          
                                            </li>

                                            <li>
                                               <?php
                                            $myHerf = " <a href=\"#\"> .. to be determined </a> ";
                                            if ($user->role == "SYS" || $user->role2 == "ADP+") {                                           
                                                echo $myHerf;;
                                            }
                                            ?> 
                                            </li>

                                        </ul>
                                        <!--//.nav-third-level--> 
                                    </li>
                                    
                                    <li>
                                        <a href="#"> Daily OPS Shift <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                            <?php
                                            $myHerf = " <a style=\"color: green;\" href=\"form_upload_shift.php\"> <i class=\"fa fa-pencil fa-fw\"></i> Ανάρτηση Ημερήσιας Επχ. Φυλακής</a> ";
                                            if ($user->role == "SYS" || $user->role == "CMD" || $user->role == "OPR") {                                           
                                                echo $myHerf;;
                                            }
                                            ?>               
                                            </li>
                                          
                                        </ul>
                                        <!--//.nav-third-level--> 
                                    </li>

                                    
                                    <li>
                                        <!--<a style="color: red; background-color: yellow;" href="#"> Ενημέρωση ΠΡΣ - Ανακοινώσεις <span class="fa arrow"></span></a>-->
                                        
                                        <?php
                                            $myHerf = " <a style=\"color: red; background-color: yellow;\"> <i style=\"color: red;\"> </i> Ενημέρωση ΠΡΣ <span class=\"fa arrow\"></span></a> ";
                                            if ($user->role == "SYS" || $user->role3 == "ASSIST" ) {
                                            echo $myHerf;
                                        }
                                         ?>                                        
                                        
                                        <ul class="nav nav-third-level">                                            
                                            <li>
                                            <?php
                                            $myHerf = " <a style=\"color: blue;\" href=\"./form_upload_sfile2.php\"> <i class=\"fa fa-pencil fa-fw\"></i> Ανάρτηση Ενημέρωσης ΠΡΣ</a> ";
                                            if ($user->role == "SYS" || $user->role3 == "ASSIST" ) {                                           
                                                echo $myHerf;;
                                            }
                                            ?>               
                                            </li>
                                          
                                        </ul>
                                       
                                    </li>


                                </ul>
                                <!--/.nav-second-level--> 

                            </li>
                                                       
                            <li>
                                <?php
                                $myStyle = "";
                                // <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                                $myHerf = " <a style=\"color: red;\" href=\"admin_dashboard.php\"> <i class=\"fa fa-wrench fa-fw\"></i> Admin </a> ";
                                if ($user->admin == 0 || $user->admin == NULL) {
                                    $myStyle = 'style="display:none;"';
                                    echo '<a herf="#"' . $myStyle . '>Admin </a>';
                                } else {
                                    echo $myHerf;
                                }
                                ?>       
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
            </nav>

            
            
          <!-- Beginning of the main page -->
            
            
            <!-- /# page wrapper -->   
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">2ο ΑΚΕ Dashboard</h1>
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
                                            <i class="fa fa-group fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <?php 
                                                require_once '../php_functions/Cvutils/utils.php';
                                                require_once '../php_functions/db_config/db_connect.php';
                                                require_once("../php_functions/functions.inc");
                                                $ShareTo = $user->asma;
                                                $Finished = "No";
                                                $sql = "SELECT * FROM taskmain WHERE assign2 = '{$ShareTo}' AND complete='{$Finished}' ";                    
                                                
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $countjobs= mysqli_num_rows($res);
                                                echo "<div class=\"huge\">" . $countjobs . "</div>";
                                            
                                            ?>
                                            
                                            <!--<div class="huge"> 0 </div>-->
                                            <div>Shared Jobs!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="./form_view_job_main.php">
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
                                                $AssignedTo = $user->asma;
                                                $Finished = "No";
                                                $sql = "SELECT * FROM taskmain WHERE (assign1 = '{$AssignedTo}' OR assign2 ='{$AssignedTo}') AND complete='{$Finished}' ";                    
                                                
                                                $db = new DbMgmt;
                                                $res = $db->runQuery($sql);
                                                $countjobs= mysqli_num_rows($res);
                                                echo "<div class=\"huge\">" . $countjobs . "</div>";
                                            
                                            ?>
                                            <!-- <div class="huge"> 0 </div>-->
                                            <div>New Jobs!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="./form_view_job_main.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>


                    <br />
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Προβολές 
                        </div>

                        <?php
                    echo "<table>\n";

                    echo "<tr>\n";
                    echo "<th class=\"code\"> Current OPS    </th>\n";
                    echo "<th class=\"custom\"> OPS Documents </th>\n";
                    echo "<th class=\"sideR\">  Current OPS </th>\n";
                    echo "</tr>\n";

                    //New Line #1
                    echo "<tr>\n";

                    echo "<td class=\"code\"> <a href=\"./form_view_sensor.php\"> View RADAR Status </a> </td>\n";

                    if ($user->role == "SYS" || $user->role == "CMD" || $user->role == "OPR" || $user->role == "OPS" || $user->role == "TDL" || $user->role == "SAM" || $user->role3 == "OPS") {                        
                        echo "<td class=\"code\" style=\"color: black; background-color: yellow;\" > <a href=\"../web/ake/secure_ops\"> ΕΘΝΙΚΑ ΕΠΙΧΕΙΡΗΣΙΑΚΑ  </a> </td>\n";
                    } else {
                        echo "<td class=\"code\"> <a href=\"#\"> TBD... </a> </td>\n";
                    }  
                    
                    echo "<td class=\"sideR\"> <a href=\"./form_view_air_asset.php\"> View Fighter's Readiness Status </a> </td>\n";                    
                    echo "</tr>\n";

                    //New Line #2
                    echo "<tr>\n";

                    echo "<td class=\"code\"> <a href=\"./form_view_radio.php\"> View Radio Status #1 </a> </td>\n";

                   
                    echo "<td class=\"code\" style=\"color: black; background-color: cyan;\"> <a href=\"./form_view_major_sum2.php\"> Προβολή συνόλου Συμβάντων </a> </td>\n";
                                  
                    echo "<td class=\"sideR\"> <a href=\"./form_view_sam_asset.php\"> View SAM/SHORAD Readiness Status </a> </td>\n"; 
                    echo "</tr>\n";

                    //New Line #3
                    echo "<tr>\n";
                    echo "<td class=\"code\"> <a href=\"./form_view_radio2.php\"> View Radio Status #2 </a> </td>\n";
                    if ($user->role == "SYS" || $user->role == "CMD" || $user->role == "OPR" || $user->role == "OPS" || $user->role == "TDL" || $user->role == "SAM" || $user->role3 == "OPS") {                        
                        echo "<td class=\"code\" style=\"color: black; background-color: red;\" > <a href=\"../web/ake/intel\"> INTEL - ΠΛΗΡ  </a> </td>\n";
                    } else {
                        echo "<td class=\"code\"> <a href=\"#\"> TBD... </a> </td>\n";
                    }                     
                    echo "<td class=\"sideR\"> <a href=\"./form_view_resc_asset.php\"> View RESCUE Readiness Status </a> </td>\n";
                    echo "</tr>\n";
                    
                    //New Line #4
                    echo "<tr>\n";
                    echo "<td class=\"code\"> <a href=\"./form_view_tdl.php\"> View TDL Status </a> </td>\n";
                    if ($user->role == "SYS" || $user->role == "CMD" || $user->role == "OPR" || $user->role == "OPS" || $user->role == "TDL" || $user->role == "SAM" || $user->role3 == "OPS") {
                        echo "<td class=\"code\" style=\"color: red; background-color: orange;\" > <a href=\"../web/ake/me_misc\" > Μοίρα ΕΠΧ - MISC  </a> </td>\n";
                    } else {
                        echo "<td class=\"code\"> <a href=\"#\"> TBD... </a> </td>\n";
                    }                                      
                    echo "<td class=\"sideR\"> <a href=\"./form_view_sart.php\"> View Base Status (SART) </a> </td>\n";
                    echo "</tr>\n";

                    //New Line #5
                    echo "<tr>\n";
                    echo "<td class=\"code\"> <a href=\"./form_view_hotline.php\"> View HOTLINE Status </a> </td>\n";
                    if ($user->role == "SYS" || $user->role == "CMD" || $user->role == "OPR" || $user->role == "OPS" || $user->role == "TDL" || $user->role == "SAM" || $user->role3 == "OPS") {
                        echo "<td class=\"code\" style=\"color: red; background-color: cyan;\" > <a href=\"../web/ake/exer\" > ΑΣΚΗΣΕΙΣ - ΑΞΙΟΛΟΓΗΣΕΙΣ  </a> </td>\n";
                    } else {
                        echo "<td class=\"code\"> <a href=\"#\"> TBD... </a> </td>\n";
                    }                
                    echo "<td class=\"sideR\"> <a href=\"./form_view_air_delta.php\"> View Fighter's Readiness DELTA Force </a> </td>\n";  
                    echo "</tr>\n";
                    
                    //New Line #6
                    echo "<tr>\n";
                    echo "<td class=\"code\"> <a href=\"#\"> TBD .... </a> </td>\n"; 
                    echo "<td class=\"code\"> <a href=\"#\"> TBD .... </a> </td>\n";                  
                    echo "<td class=\"sideR\"> <a href=\"./form_view_missions.php\"> View Missions </a> </td>\n";  
                    echo "</tr>\n";

                    echo "</table>\n";
                    ?>

                    </div>

                    
                    <br />
                    <br />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Ανακοινώσεις
                        </div>
                        <div class="panel-body panel-green">
                            <ul class="timeline" id="refresh">                              
                                <?php
                                require_once '../php_functions/db_config/db_connect.php';
                                $db = new DbMgmt;
                                
                                //$sql_show_posts = "SELECT `indate`, `title`, `message`, `asma`, `valid` FROM `postnews` ORDER BY `postnews`.`indate` DESC LIMIT 0, 30 ";
                                $sql_show_posts = "SELECT * FROM `postnews` WHERE valid=1 ORDER BY `postnews`.`indate` DESC LIMIT 0, 30 ";
                                $qry_show_posts = $db->runQuery($sql_show_posts);                                  
                                while ($row_show_posts = mysqli_fetch_array($qry_show_posts)) {
                                    $loop_var = 0;
                                    $HyperLink = $row_show_posts['link'];
                                    $fpath = $row_show_posts['fpath'];
                                    $post_id_parse[$loop_var] = $row_show_posts['post_id'];
                                    echo "<li>";
                                    
                                    echo "<div class=\"timeline-badge\"><i class=\"fa fa-check\"></i></div>";
                                    echo "<div class=\"timeline-panel\">";
                                    echo "<div class=\"timeline-heading\">";
                                                                        
                                    if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "ADP+") {
                                        echo "<h6 class=\"post_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$post_id_parse[$loop_var]" . " \" >" . $row_show_posts['post_id'] . "  </a> </h6>";
                                    } else {
                                        echo "<td class=\"post_id\"> <a class=\"\" >" . $row_show_posts['post_id'] . "  </a> </td>";
                                    }                                    
                                    
                                    //echo "<h6 class=\"post_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$post_id_parse[$loop_var]" . " \" >" . $row_show_posts['post_id'] . "  </a> </h6>";
                                    echo "<h4 style=\"color: red;  background-color: yellow; \">" . $row_show_posts['title'] . "</h4>";
                                    echo "</div>";
                                    echo "<div class=\"timeline-body\">";
                                    echo "<p>" . $row_show_posts['message'] . "</p>";
                                    echo "<br />";
                                    echo "<a href=\"" .$HyperLink. "\" target=\"_blank\" >" ."Url Address : ". $row_show_posts['link'] . "</a>";
                                    echo "<br />";
                                    echo "<a href=\"" .$fpath. "\" target=\"_blank\" >" . "File Path : " . $row_show_posts['fpath'] . "</a>";
                                    echo "<br />";
                                    echo "<div class\"row\">";
                                    
                                    if ($user->role == "SYS" || $user->role2 == "STAFF+") {
                                        echo "<small class=\"pull-right text-primary\" data-toggle=\"modal\" data-target=\"#update" . "$post_id_parse[$loop_var]" . " \" >"  . $row_show_posts['indate'] . "</small>";
                                    }  else {
                                        echo "<small class=\"pull-right text-primary\" >" . $row_show_posts['indate'] . "</small>";
                                    }
                                    
                                    $asma = $row_show_posts['asma'];
                                    $sql = "SELECT `rank`, `sname`  FROM `personnel` WHERE `asma`=$asma ";
                                    $qry = $db->runQuery($sql);
                                    $row = mysqli_fetch_row($qry);
                                    echo "<em class=\"text-center text-muted\">" . $row[0] . " " . $row[1] . "</em>";
                                    
                                    $loop_var = $loop_var + 1;
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";

                                    echo "</li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <!-- 
                    
                    Modal Start
                    
                    -->


                </div>
                <!-- /.container-fluid --> 
            </div>

            <!-- /# page wrapper -->

        </div>
        <!-- /#wrapper -->

                <!-- Modal Start Update Sensor  NEW !! -->
        <?php        
        $sql_update_post = "SELECT * FROM postnews ORDER BY postnews.post_id ASC";
        $db1 = new DbMgmt;
        $qry_update_post = $db1->runQuery($sql_update_post);
        while ($row_update = mysqli_fetch_array($qry_update_post)) {
            $loop_var = 0;
            $post_id_parse[$loop_var] = $row_update['post_id'];

            //Update Modal
            echo "<div class=\"modal fade\" id=\"update" . $post_id_parse[$loop_var] . "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">\n";
            echo "<div class=\"modal-dialog\">\n";
            echo "<div class=\"modal-content\">\n";
            echo "<div class=\"modal-header\">\n";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n";
            echo "<h3 class=\"modal-title text-center \"> Update POST </h3>\n";
            //modal header
            echo "</div>\n";
            $post_id_update = $row_update['post_id'];                       
            $title_update = $row_update['title'];
            $message_update = $row_update['message'];
            $asma_update = $row_update['asma'];
            $link_update = $row_update['link'];
            $fpath_update = $row_update['fpath'];
            $valid_update = $row_update['valid'];
            
            
            echo "<div id=\"errorDiv\">";

            if (isset($_SESSION['error']) && isset($_SESSION['formAttempt'])) {
                unset($_SESSION['formAttempt']);
                print "Errors encountered<br />\n";
                foreach ($_SESSION['error'] as $error) {
                print $error . "<br />\n";
                } //end foreach
                } //end if

            echo "</div>";

            echo "<div class=\"modal-body\">\n";
            echo "<form role=\"form\" id=\"updatePostForm\" name=\"updatePostForm\" action=\"../php_functions/post_update.php\" method=\"POST\">\n";
            echo "<div class=\"form-horizontal\">\n";

            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-8 control-label\"> POST : " . $title_update  . "</label>\n";
            echo "</div>\n";
                        
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> POST ID </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"post_id\" name=\"post_id\" class=\"form-control input-group-lg\" value=\"" . $post_id_update . "\" readonly >";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> TITLE </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"title\" name=\"title\" class=\"form-control input-group-lg\" value=\"" . $title_update . "\"  >";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\">Message </label>\n";
            echo "<div class=\"col-sm-10\">";            
            echo "<textarea id=\"message\" name=\"message\" class=\"form-control\" rows=\"3\" placeholder=\"Message\">$message_update</textarea>";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> File Path </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"fpath\" name=\"fpath\" class=\"form-control input-group-lg\" value=\"" . $fpath_update . "\"  >";
            echo "</div>\n";
            echo "</div>\n";
            
            echo "<div class=\"form-group\">\n";
            echo "<label class=\"col-sm-2 control-label\"> HyperLink </label>\n";
            echo "<div class=\"col-sm-10\">";
            echo "<input type=\"text\" id=\"link\" name=\"link\" class=\"form-control input-group-lg\" value=\"" . $link_update . "\"  >";
            echo "</div>\n";
            echo "</div>\n";
                        
            /*
             * Select Valid
             */
            echo "<div class=\"form-group form-group-sm\">\n";
            echo "<div class=\"col-sm-2\">\n";
            echo "<label class=\"col-sm-2 control-label\">Valid</label>\n";
            echo "</div>\n";
            echo "<div class=\"col-sm-4\">\n";
            echo "<select class=\"col-sm-8 form-control\" id=\"valid\" required=\"valid\" name=\"valid\">\n";
            //echo "<option value=\"\" selected disabled> Valid Status </option>";
            echo "<option class=\"text-primary\" value=\"1\"> Valid </option>"; 
            echo "<option class=\"text-primary\" value=\"0\"> Not Valid </option>";
                                    
            echo "</select>\n";
            echo "</div>\n";
            echo "</div>\n";
            /*
             * End here
             */
            //Select ends here:

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
            
            //echo "<script type=\"text/javascript\" src=\"../js/update_post.js\"></script>\n"; 
            
            
        }
        ?>
                                                      
        
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
