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
                    <a class="navbar-brand" href="#"> <strong style="color: red;">  View Personnel  by Division </strong> </a>
                    <a class="navbar-brand" href="dashboard.php"> <strong style="color: blue; ">  Dashboard   </strong> </a>    
                    <a class="navbar-brand" href="./logout.php"> <strong style="color: blue; ">  Logout   </strong> </a> 

                </div>
                
                <div class="panel-heading text-center">
                <div class="col-lg-12">
                    <h1 class="page-header" style="color: red;"> Προβολή Αναλυτικών Στοιχείων Προσωπικού </h1>
                    <strong style="color: black; font-size: 20px;">  <?php echo date("j - m - Y"); ?>  </strong>
                </div>
                <!-- /.col-lg-12 -->
            </div>     

            </nav>

            

            <style>
            body {
              font-family: Arial;
              color: white;
            }

            .split {
              height: 100%;
              width: 33%;
              position: fixed;
              z-index: 1;
              top: 0;
              overflow-x: hidden;
              padding-top: 20px;
            }

            .left {
              left: 0;
              background-color: #111;
            }

            .right {
              right: 0;
              background-color: red;
            
             .centered {
              right: 0;
              background-color: blue;
            }

            .internal {
              position: absolute;
              top: 30%;
              left: 25%;
              transform: translate(-50%, -50%);
              text-align: center;
            }

            .centered img {
              width: 150px;
              border-radius: 50%;
            }
            
             .container {
                    width: 100%;
                    height: 100%;
                }

                .leftpane {
                    width: 25%;
                    height: 100%;
                    float: left;
                    background-color: rosybrown;
                    border-collapse: collapse;
                    
                                 /*height: 100%;*/
              /*width: 33%;*/
              position: fixed;
              z-index: 1;
              /*top: 0;*/
              overflow-x: hidden;
              padding-top: 20px;
                }

                .middlepane {
                    width: 50%;
                    height: 100%;
                    float: none;
                    background-color: royalblue;
                    border-collapse: collapse;
                }
                
                 .Center { 
            width:200px; 
            height:200px; 
            position: fixed; 
            background-color: blue; 
            top: 50%; 
            left: 50%; 
            margin-top: -100px; 
            margin-left: -100px; 
        } 

                .rightpane {
                    width: 25%;
                    height: 100%;
                    position: relative;
                    float: right;
                    background-color: yellow;
                    border-collapse: collapse;
                }

                .toppane {
                    width: 100%;
                    height: 100px;
                    border-collapse: collapse;
                    background-color: #4da6ff;
                }
            
            
            </style>

            <div class="split left">
                <div class="internal">
                    
                    
                   
                    <div class="form-group">
                        <label class=" col-sm-4 control-label">ΑΣΜΑ : </label>
                        <div class="col-sm-8">
                            <div class="input-group mb-3">
                                <input  type="text" id="asma" name="asma" class="form-control" placeholder="asma"  value="<?php echo $user->asma; ?>"  readonly>                                  
                            </div>
                           
                        </div>
                    </div> 
                    
                    <div class="form-group">
                                <label class="col-sm-4 control-label">specialty : </label>
                                <div class="col-sm-8">
                                    <input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" readonly>  
                                    
                                </div>
                            </div>
                    <div class="form-group">
                                <label class="col-sm-4 control-label">specialty : </label>
                                <div class="col-sm-8">
                                    <input type="text" id="specialty" name="specialty" class="form-control" placeholder="specialty" readonly>  
                                    
                                </div>
                            </div>
                </div>
            </div>
 

            <div class="split right">
                <div class="internal">
                    <img src="img_avatar.png" alt="Avatar man">
                    <h2>John Doe</h2>
                    <p>Some text here too.</p>
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

        <!--<script type="text/javascript" src="../js/form_view_personnel_bydiv.js"></script>-->  
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




