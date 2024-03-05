<?php
require_once("../php_functions/functions.inc");
//$user = new User;
//if (!$user->isLoggedIn) {
//    die(header("Location: login.php"));
//}
?>
<!doctype html>
<html lang="en">

    <html>
        <head> 
            <link rel="stylesheet" type="text/css"  href="../styles/success_op.css"> 
            
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="">
            <title> Operation Success</title> 
        </head>
        <body>
            <div>
                Your Action was successful !! 
            </div>

            <br>
            <br>
            <br>
            <br>
            <br>
<!--            <div>
                <a href="dashboard.php">Click here to  go to Main DashBoard</a>
            </div>-->
            <div id="content">
                    <h2> <span style="text-align: center; text-decoration: underline; color: red;"> Your Action was successful !!</span> </h2>
                    
                    <p style="color: blue; width: 90%; font-size: large"> .  </p> 
                    
                    
                    
                    <?php
                                
                                echo "<table>\n";
                                
                                echo "<tr>\n";
                                echo "<th class=\"code\">   </th>\n";
                                echo "<th class=\"custom\"> Action Information  </th>\n";
                                echo "<th class=\"sideR\">  </th>\n";                                
                                echo "</tr>\n";
                                //New Line
                                echo "<tr>\n";                                
                                echo "<td class=\"code\"> <a href=\"#\"> TBD ...</a> </td>\n";                             
                                //if ($user->admin == 1) {
                                //    echo "<td class=\"custom\"> <a href=\"dashboard.php\"> Click here to  go to Main DashBoard </a> </td>\n";                                    
                                //} else {
                                    echo "<td class=\"custom\"> <a href=\"./login.php\"> Click here to  go Login page </a> </td>\n";
                                //}                                                                
                                echo "<td class=\"sideR\"> <a href=\"#\"> TBD ... </a> </td>\n";
                                echo "</tr>\n";
                                
                                                                
                                //New Line
                                echo "<tr>\n";
                                echo "<td class=\"code\"> <a href=\"#\"> TBD ...</a> </td>\n";                                                            
                                echo "<td class=\"custom\"> <a href=\"#\">  </a> </td>\n";
                                echo "<td class=\"sideR\"> <a href=\"#\"> TBD ... </a> </td>\n";
                                echo "</tr>\n";
                                
                                
                                //New Line
                                echo "<tr>\n";
                                echo "<td class=\"code\"> <a href=\"#\"> TBD ...</a> </td>\n";                                
//                                if ($user->admin == 1) {
//                                    echo "<td class=\"custom\"> <a href=\"admin_dashboard.php\"> OR Click here to  go to Admin Main DashBoard </a> </td>\n";                                    
//                                }  else {
//                                    echo "<td class=\"custom\"> <a href=\"#\"> You are not an Administrator </a> </td>\n";
//                                } 
                                echo "<td class=\"sideR\"> <a href=\"#\"> TBD ... </a> </td>\n";
                                echo "</tr>\n";
                                //Last Line
                                echo "<tr>\n";
                                echo "<td class=\"Last\"> </td>\n";
                                echo "<td class=\"Last\"> </td>\n";
                                echo "<td class=\"Last\"> </td>\n";
                                echo "</tr>\n";
                                
                                echo "</table>\n";
                                
                                ?>
                    
                    
                    
                   
                </div> <!-- end content -->

        </body>
    </html>