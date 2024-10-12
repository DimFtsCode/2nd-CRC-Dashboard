<?php
require_once("../php_functions/functions.inc");
?>
<html>
    <head>
        <title> 2o AKE / Site Status </title>  
        <link rel="stylesheet" type="text/css" href="../index1.css">
        <link rel="stylesheet" type="text/css" href="../styles1/Unit_Status0.css">
        <meta charset="UTF-8">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet"> -->
        <link rel="stylesheet" href="../assets/font-awesome-4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container-fluid d-flex flex-column min-vh-100 " style="background: #1c4b82;">
            <div class="row">
                <div class="col-2 header-content" >
                    <div class="header-image">
                        <a href="./index3.php" >
                            <img src="/images/2ake_emb5.gif" alt="Logo" style="width: 80px; height: auto; cursor: pointer;">
                        </a>
                    </div>    
                </div>
                <div class="col-8 text-black text-center py-3 header-content position-relative" >
                    <div class="header-text">
                        <h1 style="font-weight: bold;">2ο ΑΚΕ</h1>
                        <p style="font-weight: bold;">ΑΕΡΟΠΟΡΙΚΟΣ ΕΛΕΓΧΟΣ ΜΕΣΩΝ ΑΕΡΑΜΥΝΑΣ – ΚΕΝΤΡΟ ΣΥΝΘΕΣΗΣ & ΠΑΡΑΓΩΓΗΣ ΑΕΡΟΠΟΡΙΚΗΣ ΕΙΚΟΝΑΣ</p>
                    </div>
                </div>
                <div class="col-2 header-content" >
                    <div class="header-image">
                        <a  href="./dee_init0.php">
                            <img src="/images/2ake_emb5.gif" alt="Logo" style="width: 80px; height: auto; cursor: pointer;">
                        </a>                    
                    </div>
                </div>
            </div>
            <div class="row flex-grow-1" >
                <div class="col-2 px-0 ">
                <!-- side bar -->
                    <div  class="main-menu" >
                        <ul>
                        <li class="has-subnav">
                                <a href="../index3.php">
                                    <i class="fa fa-home fa-2x"></i>
                                    <span class="nav-text " style="font-weight: bold;">
                                        ΑΡΧΙΚΗ
                                    </span>
                                </a>
                            
                            </li>
                            <li class="has-subnav">
                                <a href="./dktis_init0.php">
                                    <i class="fa fa-star fa-2x  "></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΔΚΤΗΣ
                                    </span>
                                </a> 
                            </li>
                            <li class="has-subnav">
                                <a href="./ydktis_init0.php">
                                <i class="fa fa-star-half-full fa-2x "></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΥΔΚΤΗΣ
                                    </span>
                                </a>
                            </li>
                            <li class="has-subnav">
                                <a href="./epit_init0.php">
                                <i class="fa fa-comments fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΕΠΙΤΕΛΕΙΟ
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="./dee_init0.php">
                                    <i class="fa fa-fighter-jet fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΔΕΕ
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="./dyp_init0.php">
                                    <i class="fa fa-folder-open fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΔΥΠ
                                    </span>
                                </a>
                            </li>
                            <li>
                            <a href="./me_init0.php">
                                <i class="fa fa-headphones fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        Μ. ΕΠΙΧΕΙΡΗΣΕΩΝ
                                    </span>
                                </a>
                            </li>
                            <li>
                            <a href="./myp_init0.php">
                                    <i class="fa fa-cogs fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        Μ. ΥΠΟΣΤΗΡΙΞΗΣ
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="./saf_init0.php">
                                <i class="fa fa-shield fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΣΑΦ
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="./sef_init0.php">
                                <i class="fa fa-archive fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΣΕΦ
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="./seep_init0.php">
                                <i class="fa fa-minus fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΣΕΕΠ
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="./ake_init0.php">
                                <i class="fa fa-group fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΕΝΗΜΕΡΩΣΗ ΠΡΣ
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="./Unit_Status0.php">
                                <i class="fa fa-info fa-2x fa-spin"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΚΑΤΑΣΤΑΣΗ ΣΕΛΙΔΑΣ
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <ul class="logout">
                            <li>
                                <a href="./login.php">
                                    <i class="fa fa-sign-in fa-2x"></i>
                                    <span class="nav-text" style="font-weight: bold;">
                                        ΕΙΣΟΔΟΣ
                                    </span>
                                </a>
                            </li>  
                        </ul>
                    </div>
                </div>
                <div class="background1-image-wrapper col-10">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <div class="bordered-box " style="background-color: rgba(255,255,255,0.8); border-radius:10%;">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 style="text-align: center;"><strong>Τρέχουσα Επιχειρησιακή Κατάσταση</strong> </h2>
                                        <p style="font-size: 16px; margin-top: 2rem;text-align: center;"><strong>" Από την παρούσα σελίδα δίδεται πρόσβαση στην απεικόνιση της Τρέχουσα Επιχειρησιακής Κατάστασης του 2ου ΑΚΕ"</strong></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-4">
                            <div class="container " style="border: 1px solid #000; margin-top: 2rem; background-color: #1c4b82;border-radius:10%;">
                                <ul class="nav nav-tabs" style="margin-top: 1rem; border-bottom: 1px solid #000;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#general" role="tab" data-toggle="tab" >Current OPS Εθνικά</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="#general1" role="tab" data-toggle="tab" >Current OPS ΝΑΤΟ</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="general">
                                        <table class="table">
                                            <thead>
                                                <tr >
                                                    <th style="border-bottom: 2px solid #000;">#</th>
                                                    <th style="border-bottom: 2px solid #000;">Περιγραφή</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td> <a href="../pages/form_view_air_asset_public.php"> <span style="color: dd6b4d"><strong> RADAR Status </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td> <a href="../pages/form_view_air_delta_public.php"> <span style="color: dd6b4d"><strong> ΔΥΝΑΜΗ "Δ" </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td> <a href="../pages/form_view_sart_public.php"> <span style="color: dd6b4d"><strong> ΚΑΤΑΣΤΑΣΗ Α/Δ </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td> <a href="../pages/form_view_resc_asset_public.php"> <span style="color: dd6b4d"><strong> ΕΤΟΙΜΟΤΗΤΕΣ Α/N  </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">5</th>
                                                    <td> <a href="../pages/form_view_resc_asset_public.php"> <span style="color: dd6b4d"><strong> ΕΤΟΙΜΟΤΗΤΕΣ SAM / SHORAND  </strong></span></a> </td>                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="general1">
                                        <table class="table">
                                            <thead>
                                                <tr >
                                                    <th style="border-bottom: 2px solid #000;">#</th>
                                                    <th style="border-bottom: 2px solid #000;">Περιγραφή</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td> <a href="../web/ydktis/docs/RV_Slides_ROEs.pdf"> <span style="color: dd6b4d"><strong> Rules of Engagments </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td> <a href="../web/ydktis/docs/RV_Slides_TBMFs.pdf"> <span style="color: dd6b4d"><strong> TBMFs </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">5</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>      
                        </div>
                        <div class="col-1">
                        </div>
                        <div class="col-5">
                            <div class="container " style="border: 1px solid #000; margin-top: 2rem; background-color: #1c4b82;border-radius:7%; margin-bottom: 1rem;">
                                <ul class="nav nav-tabs"style="margin-top: 1rem; border-bottom: 1px solid #000;">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#more" role="tab" data-toggle="tab">OPS Daily Status</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="#more1" role="tab" data-toggle="tab">OPS National EX / WAR</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="#more2" role="tab" data-toggle="tab">OPS NATO Status</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="more">
                                        <table class="table">
                                            <thead>
                                                <tr >
                                                    <th style="border-bottom: 2px solid #000;">#</th>
                                                    <th style="border-bottom: 2px solid #000;">Περιγραφή</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td> <a href="../pages/form_view_sensor_public.php"> <span style="color: dd6b4d"><strong> RADAR Status </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td> <a href="../pages/form_view_radio_public.php"> <span style="color: dd6b4d"><strong> ΑΣΥΡΜΑΤΟΙ#1 Status </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td> <a href="../pages/form_view_radio2_public.php"> <span style="color: dd6b4d"><strong> ΑΣΥΡΜΑΤΟΙ#2 Status </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td> <a href="../pages/form_view_tdl_public.php"> <span style="color: dd6b4d"><strong> ΔΙΑΣΥΝΔΕΣΕΙΣ (TDLs) Status  </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">5</th>
                                                    <td> <a href="../pages/form_view_hotline_public.php"> <span style="color: dd6b4d"><strong> HOT Lines Status  </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">6</th>
                                                    <td> <a href="../pages/form_view_air_asset_public.php"> <span style="color: dd6b4d"><strong> ΕΤΟΙΜΟΤΗΤΕΣ Α/Φ  </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">7</th>
                                                    <td> <a href="../pages/form_view_air_delta_public.php"> <span style="color: dd6b4d"><strong> ΔΥΝΑΜΗ "Δ"  </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">8</th>
                                                    <td> <a href="../pages/form_view_sart_public.php"> <span style="color: dd6b4d"><strong> ΚΑΤΑΣΤΑΣΗ Α/Δ  </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">9</th>
                                                    <td> <a href="../pages/form_view_resc_asset_public.php"> <span style="color: dd6b4d"><strong> ΕΤΟΙΜΟΤΗΤΕΣ Α/N </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">10</th>
                                                    <td> <a href="../pages/form_view_sam_asset_public.php"> <span style="color: dd6b4d"><strong> ΕΤΟΙΜΟΤΗΤΕΣ SAM / SHORAND </strong></span></a> </td>                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="more1">
                                        <table class="table">
                                            <thead>
                                                <tr >
                                                    <th style="border-bottom: 2px solid #000;">#</th>
                                                    <th style="border-bottom: 2px solid #000;">Περιγραφή</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">11</th>
                                                    <td> <a href="../pages/form_view_missions_public.php"> <span style="color: dd6b4d"><strong> ΠΙΝΑΚΑΣ ΤΑΚΤΙΚΩΝ ΑΠΟΣΤΟΛΩΝ </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">12</th>
                                                    <td> <a href="../pages/form_view_logbook_public.php"> <span style="color: dd6b4d"><strong> ΗΜΕΡΟΛΟΓΙΟ ΚΕΠΙΧ </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">13</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">14</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">15</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">16</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">17</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">18</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">19</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">20</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="more2">
                                        <table class="table">
                                            <thead>
                                                <tr >
                                                    <th style="border-bottom: 2px solid #000;">#</th>
                                                    <th style="border-bottom: 2px solid #000;">Περιγραφή</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">21</th>
                                                    <td> <a href="../pages/form_view_air_asset_nato_public.php"> <span style="color: dd6b4d"><strong> Fighter's Readiness Status </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">22</th>
                                                    <td> <a href="../pages/form_view_sart_public.php"> <span style="color: dd6b4d"><strong> Base Status </strong></span></a> </td>                                                    
                                                </tr>
                                                <tr>
                                                    <th scope="row">23</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">24</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">25</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">26</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">27</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">28</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">29</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">30</th>
                                                    <td> <a href=""> <span ><strong>...TDB</strong></span></a> </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row " style="background: #1c4b82;">
                <div class="col-4 text-center footer-content" >
                    <p style="color: #dae1e7"><strong>E-mail:</strong> <a href="mailto:2ake@haf.gr" style="color: #dd6b4d; font-weight: bold; text-decoration: none;">2ake@haf.gr</a></p>
                </div>
                <div class="col-4  text-center  footer-content" > 
                    <p style="color: #dae1e7"><strong>Copyright (c) 2017 znk</strong></p>
                </div>
                <div class="col-4  text-center  footer-content" > 
                    <p style="color: #dae1e7"><strong>Τηλέφωνο Επικοινωνίας:</strong> 210-2425001</p>
                </div>
            </div>
        </div>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="../assets/js/jquery-3.5.1.slim.min.js"></script>
        <script src="../assets/js/popper-2.5.2.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->
        <script>
            $(document).ready(function(){
                $('.dropdown-toggle').dropdown();
            });
        </script>

    </body>
</html>