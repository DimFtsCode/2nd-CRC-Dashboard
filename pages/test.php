<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content=""> 
        <meta name="author" content="">

        <title>SB Admin 2 - Bootstrap Admin Theme</title>

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
                    <a class="navbar-brand" href="index.html">SB Admin v2.0</a>
                    <b class="navbar-brand">Welcome : <i><?php
                            session_start();
                            echo $_SESSION['login_user'][0] . " " . $_SESSION['login_user'][1];
                            ?></i></b>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <strong>John Smith</strong>
                                        <span class="pull-right text-muted">
                                            <em>Yesterday</em>
                                        </span>
                                    </div>
                                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>Read All Messages</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-messages -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-tasks">
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 1</strong>
                                            <span class="pull-right text-muted">40% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                                <span class="sr-only">40% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 2</strong>
                                            <span class="pull-right text-muted">20% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 3</strong>
                                            <span class="pull-right text-muted">60% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                                <span class="sr-only">60% Complete (warning)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p>
                                            <strong>Task 4</strong>
                                            <span class="pull-right text-muted">80% Complete</span>
                                        </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                                <span class="sr-only">80% Complete (danger)</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Tasks</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-tasks -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                        <span class="pull-right text-muted small">12 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-envelope fa-fw"></i> Message Sent
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-tasks fa-fw"></i> New Task
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- /.dropdown-alerts -->
                    </li>
                    <!-- /.dropdown -->
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="navbar/userProfile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                            </li>
                            <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="../php_functions/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                                <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="prosklitirio.php"><i class="fa fa-bar-chart fa-fw"></i> Προσκλητήριο</a>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-envelope fa-fw"></i> Μηνύματα<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="new_message.php">Νεο Μυνημα</a>
                                    </li>
                                    <li>
                                        <a href="messages.php">Εισερχόμενα</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i> Agenda<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">Άδειες</a>
                                    </li>
                                    <li>
                                        <a href="#">Υπ</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="tasks.php"><i class="fa fa-edit fa-fw"></i> Tasks</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> Ρυθμίσεις<span class="fa arrow"> </span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#">Administation</a>
                                    </li>
                                    <li>
                                        <a href="navbar/userProfile.php">User Profile</a>
                                    </li>
                                    <li>
                                        <a href="#">System</a>
                                    </li>
                                    <li>
                                        <a href="pendingUsers.php">Pending Users</a>
                                    </li>
                                    <li>
                                        <a href="#"> Data Base</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Extra<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="HAFchat.php" target="popup" onclick="window.open('HAFchat.php', 'popup', 'width=600,height=480');
                                                return false;">HAF Chat</a>
                                    </li>
                                    <li>
                                        <a href="#">Send a Report</a>
                                    </li>
                                    <li>
                                        <a href="mase_workstation.php">Mase Workstation</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level <span class="fa arrow"></span></a>
                                        <ul class="nav nav-third-level">
                                            <li>
                                                <a href="#">First Level Item Chat</a>
                                            </li>
                                            <li>
                                                <a href="#">Second Level Item</a>
                                            </li>
                                            <li>
                                                <a href="#">Third Level Item</a>
                                            </li>
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

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Dashboard</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <h1 class="h1"><?php
                                setlocale(LC_ALL, "EL");
                                echo date("l, j F Y");
                                ?></h1>
                        </div>
                    </div>
                    <!-- /wra kai imerominia -->

                    <?php
                    require_once '../php_functions/db_config/db_connect.php';
                    $db = new DbMgmt;
                    $db->runQuery("SET NAMES 'utf8'");
                    $am = $_SESSION['login_user'][2];
                    $sql = "SELECT `epistasia`, `section` FROM personel WHERE `AM`=$am";
                    $res = $db->runQuery($sql);
                    $row = mysqli_fetch_row($res);
                    //echo $row[0] . " - " . $row[1];
                    ?>

                    <div class="row">

                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">26</div>
                                            <div>Νέα Μυνήματα!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
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
                                            include '../php_functions/Cvutils/utils.php';
                                            echo "<div class=\"huge\">";
                                            echo numTasks($am);
                                            echo "</div>";
                                            ?>
                                            <div>New Tasks!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="tasks.php">
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
                        <a href="#"  data-toggle="modal" data-target="#add_new_post">
                            <span class="pull-left"><i class="fa fa-plus-circle"></i></span>
                            <span>Νέα Δημοσίευση</span>
                            <div class="clearfix"></div>
                        </a>

                    </div>
                    <br />
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-clock-o fa-fw"></i> Ανακοινώσεις
                        </div>
                        <div class="panel-body panel-green">
                            <ul class="timeline" id="refresh">
                                <li>
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

                                </li>
                                <p>Test</p>
                                <?php
                                $sql_show_posts = "SELECT `date`, `tittle`, `message`, `user_reg`, `high` FROM `new` ORDER BY `new`.`date` DESC LIMIT 0, 30 ";
                                $qry_show_posts = $db->runQuery($sql_show_posts);
                                while ($row_show_posts = mysqli_fetch_array($qry_show_posts)) {
                                    echo "<li>";

                                    echo "<div class=\"timeline-badge\"><i class=\"fa fa-check\"></i></div>";
                                    echo "<div class=\"timeline-panel\">";
                                    echo "<div class=\"timeline-heading\">";
                                    echo "<h4>" . $row_show_posts['tittle'] . "</h4>";
                                    echo "</div>";
                                    echo "<div class=\"timeline-body\">";
                                    echo "<p>" . $row_show_posts['message'] . "</p>";
                                    echo "<br />";
                                    echo "<div class\"row\">";
                                    echo "<small class=\"pull-right text-primary\">" . $row_show_posts['date'] . "</small>";
                                    $name = $row_show_posts['user_reg'];
                                    $sql = "SELECT `rank_name`, `surname`  FROM `personel` WHERE `AM`=$name LIMIT 0, 30 ";
                                    $qry = $db->runQuery($sql);
                                    $row = mysqli_fetch_row($qry);
                                    echo "<em class=\"text-center text-muted\">" . $row[0] . " " . $row[1] . "</em>";
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
                    <div class="modal fade" id="add_new_post" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title text-center">Add New Post</h4>
                                    <div class="modal-body">
                                        <p>Hello</p>
                                        <form role="form" id="addPost" name="addNewPost" action="../php_functions/add_New_Post.php" method="POST">
                                            <div class="form-horizontal">
                                                <div class="form-group">
                                                    <?php
                                                    $user_reg = $_SESSION['login_user'][2];
                                                    echo "<div class=\"col-sm-8\"><strong class=\"text-danger\">$user_reg</strong></div>";
                                                    echo "<input class=\"hidden\" name=\"user_reg\"  value=\"" . $user_reg . "\">";
                                                    ?>

                                                </div>
                                                <div class="form-group bg-primary">
                                                    <label class="col-sm-2 control-label">Tittle : </label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="tittle" class="form-control input-group-lg" required="Τίτλος" placeholder="Τιτλος">
                                                    </div>
                                                </div>
                                                <hr />
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" required="Write" name="news"></textarea>
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
            