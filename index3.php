<!DOCTYPE html>
<html>
<head>
    <title> 2o Αεροπορικό Κέντρο Ελέγχου </title>
    <link rel="stylesheet" type="text/css" href="index1.css">
    <meta charset="UTF-8">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container-fluid d-flex flex-column min-vh-100 " style="background: #1c4b82;">
        <div class="row">
            <div class="col-1 header-content" ></div>
            <div class="col-1 header-content" >
                <div class="header-image">
                    <a href="./index3.php" >
                        <img src="/images/2ake_emb5.gif" alt="Logo" style="width: 80px; height: auto; cursor: pointer;">
                    </a>
                </div>    
            </div>
            <div class="col-1 header-content">
                <!-- <div class="header-image">
                    <a  href="./pages1/dee_init0.php">
                        <img src="/images/patch.png" alt="Logo" style="width: 90px; height: auto; cursor: pointer; ">
                    </a>                    
                </div> -->
            </div>
            <div class="col-6 text-black text-center py-3 header-content position-relative" >
                <div class="header-text">
                    <h1 style="font-weight: bold;">2ο ΑΚΕ</h1>
                    <p style="font-weight: bold;">ΑΕΡΟΠΟΡΙΚΟΣ ΕΛΕΓΧΟΣ ΜΕΣΩΝ ΑΕΡΑΜΥΝΑΣ – ΚΕΝΤΡΟ ΣΥΝΘΕΣΗΣ & ΠΑΡΑΓΩΓΗΣ ΑΕΡΟΠΟΡΙΚΗΣ ΕΙΚΟΝΑΣ</p>
                </div>
            </div>
            <div class="col-3 header-content">
                <div class="login-panel" style="height: 100%;">
                    <form id="loginForm" action="../php_functions/login-process.php" method="post" role="form" style="width: 100%; display: flex; align-items: center; justify-content: space-around;">
                        <div class="form-group" style="margin: 0 5px;">
                            <input type="text" class="form-control form-control-sm" id="asma" name="asma" placeholder="Asma" style="font-size: 0.8rem;">
                        </div>
                        <div class="form-group" style="margin: 0 5px;">
                            <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Password" style="font-size: 0.8rem;">
                        </div>
                        <div class="form-group" style="margin: 0 5px;">
                            <button type="submit" id="submit" class="btn btn-sm" style="color: #dae1e7; font-weight: bold; text-decoration: underline;" name="submit" value="">Είσοδος</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row flex-grow-1" >
            <div class="col-2 px-0 ">
                <!-- side bar -->
                <div  class="main-menu" >
                    <ul>
                        <li class="has-subnav">
                            <a href="./index3.php">
                                <i class="fa fa-home fa-2x fa-spin"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΑΡΧΙΚΗ
                                </span>
                            </a>
                        </li>
                        <li class="has-subnav">
                            <a href="./pages1/dktis_init0.php">
                                <i class="fa fa-star fa-2x "></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΔΚΤΗΣ
                                </span>
                            </a> 
                        </li>
                        <li class="has-subnav">
                            <a href="./pages1/ydktis_init0.php">
                                <i class="fa fa-star-half-full fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΥΔΚΤΗΣ
                                </span>
                            </a>
                        </li>
                        <li class="has-subnav">
                            <a href="./pages1/epit_init0.php">
                                <i class="fa fa-comments fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΕΠΙΤΕΛΕΙΟ
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages1/dee_init0.php">
                                <i class="fa fa-fighter-jet fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΔΕΕ
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages1/dyp_init0.php">
                                <i class="fa fa-folder-open fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΔΥΠ
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages1/me_init0.php">
                                <i class="fa fa-headphones fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    Μ. ΕΠΙΧΕΙΡΗΣΕΩΝ
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages1/myp_init0.php">
                                <i class="fa fa-cogs fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    Μ. ΥΠΟΣΤΗΡΙΞΗΣ
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages1/saf_init0.php">
                                <i class="fa fa-shield fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΣΑΦ
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages1/sef_init0.php">
                                <i class="fa fa-archive fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΣΕΦ
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages1/seep_init0.php">
                                <i class="fa fa-minus fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΣΕΕΠ
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages1/ake_init0.php">
                                <i class="fa fa-group fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΕΝΗΜΕΡΩΣΗ ΠΡΣ
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="./pages1/Unit_Status0.php">
                                <i class="fa fa-info fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΚΑΤΑΣΤΑΣΗ ΣΕΛΙΔΑΣ
                                </span>
                            </a>
                        </li>
                    </ul>
                    <ul class="logout">
                        <li>
                            <a href="./pages1/login.php">
                                <i class="fa fa-sign-in fa-2x"></i>
                                <span class="nav-text" style="font-weight: bold;">
                                    ΕΙΣΟΔΟΣ
                                </span>
                            </a>
                        </li>  
                    </ul>
                </div>
            </div>
            <div class="background-image-wrapper col-10">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-9 " style="background: rgba(255, 255, 255, 0.60); margin-top: 2%; border-radius:5%;">
                        <!-- carouzel -->
                        <div id="carouselExampleIndicators" class="carousel slide py-3"  data-ride="carousel">
                            <ol class="carousel-indicators" style="bottom: -50px; ">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="/images/SMYA-TTH.jpg" class="img-thumbnail" style="width: 100%; height: 500px; object-fit: cover;" alt="...">
                                </div>
                                <div class="carousel-item ">
                                    <img src="/images/2ake_over1.jpg" class="img-thumbnail" style="width: 100%; height: 500px; object-fit: cover;" alt="...">
                                </div>
                                
                                <div class="carousel-item">
                                    <img src="/images/old-radar.jpg" class="img-thumbnail" style="width: 100%; height: 500px; object-fit: cover;" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="/images/rafale.jpg" class="img-thumbnail" style="width: 100%; height: 500px; object-fit: cover;" alt="...">
                                </div>
                            </div>
                            <div id="carousel-text" style="height: 80px; overflow-y: auto; text-align: center; margin-top: 1rem;">
                                <!-- Το κείμενο θα ενημερώνεται από το JavaScript -->
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-1">
                    </div>
                    <div class="col-1 shadow mb-6 p-3  " style="background: #1c4b82; border-radius:15%; margin-top:1.25%;  border:2px solid #dd6b4d;">
                        <div class="row">
                            <div class="col-12 text-center links-sect" style="margin-top: 1rem; color: #dae1e7; ">
                                <p ><strong>MIS/Links</strong></p>
                                <a href="https://www.haf.gr/" target="_blank">
                                    <img src="/images/2ake_emb5.gif" alt="Logo" style="width: 40px; height: auto;">
                                    <p style="color: #dae1e7; ">ΙΡΙΔΑ</p>
                                </a>
                                <a href="https://www.haf.gr/" target="_blank">
                                    <img src="/images/2ake_emb5.gif" alt="Logo" style="width: 40px; height: auto;">
                                    <p style="color: #dae1e7; ">ΓΕΑ</p>
                                </a>
                                <a href="https://www.haf.gr/" target="_blank">
                                    <img src="/images/2ake_emb5.gif" alt="Logo" style="width: 40px; height: auto;">
                                    <p style="color: #dae1e7; ">ΑΤΑ</p>
                                </a>
                                <a href="https://www.haf.gr/" target="_blank">
                                    <img src="/images/2ake_emb5.gif" alt="Logo" style="width: 40px; height: auto;">
                                    <p style="color: #dae1e7; ">ΔΑΕ</p>
                                </a>
                                <a href="https://www.haf.gr/" target="_blank">
                                    <img src="/images/2ake_emb5.gif" alt="Logo" style="width: 40px; height: auto;">
                                    <p style="color: #dae1e7; ">ΔΑΥ</p>
                                </a>    
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
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.js"></script>
    <script>
        $(document).ready(function(){
            var carouselTexts = [
                { title: "Επίσκεψη ΣΜΥΑ", description: "Προγραμματισμένη εκπαιδευτική επίσκεψη των ΔΥΙΙΙ ειδικότητας Τηλεπικοινωνιών-Ηλεκτρονικών στο 2ο ΑΚΕ." },
                { title: "Γενικά", description: "Το 2ο ΑΚΕ βρίσκεται στην κορυφή του όρους Πάρνηθα, σε υψόμετρο 1413 μέτρα" },
                { title: "Ιστορικά Στοιχεία", description: "Η Μονάδα λειτουργεί και επιχειρεί από το 1958, αρχικά ως 3η ΜΚΣΕ, στη συνέχεια ως 2ο ΚΕΠ και από 2019 ως 2ο ΑΚΕ" },
                { title: "Αποστολή", description: "Αποστολή του 2ου ΑΚΕ είναι η επιτυχής εκτέλεση των λειτουργιών ενεργού Αεράμυνας εντός της περιοχής ευθύνης του, για την ακύρωση ή τη μείωση της αποτελεσματικότητας της εχθρικής από αέρος δράσης, σε Εθνικό και Συμμαχικό επίπεδο." },
            ];
            // Ορίστε το αρχικό κείμενο με την πρώτη είσοδο του πίνακα
            $("#carousel-text").html(
                "<h5>" + carouselTexts[0].title + "</h5>" +
                "<p>" + carouselTexts[0].description + "</p>"
            );
            $('#carouselExampleIndicators').on('slid.bs.carousel', function (e) {
                var activeIndex = $(e.relatedTarget).index();
                $("#carousel-text").html(
                    "<h5>" + carouselTexts[activeIndex].title + "</h5>" +
                    "<p>" + carouselTexts[activeIndex].description + "</p>"
                );
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            $('.dropdown-toggle').dropdown();
        });
    </script>
</body>
</html>
