<?php
require_once("../php_functions/functions.inc");
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>        
        <title> 2o AKE / ΣΑΦ </title>        
        <?php
        // The following is used to force the browser to clear cashe every time the page is loaded  
        echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/style_saf0.css?v=" .rand() . "\">" );        
        ?>
        <!--  <link rel="stylesheet" type="text/css"  href="../styles/style_me0.css"> -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1> 2o AKE / ΣΜΗΝΟΣ ΑΜΥΝΑΣ ΦΡΟΥΡΗΣΗΣ </h1>
            </div> <!-- end header -->
            <div id="menu">
                <ul>
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="./me_init0.php">Μ. ΕΠΙΧΕΙΡΗΣΕΩΝ</a></li>
                    <li><a href="./myp_init0.php">Μ. ΥΠΟΣΤΗΡΙΞΗΣ</a></li>                    
                    <li><a href="./Unit_Status0.php" target="_blank">SITE STATUS</a></li>
                    <li><a href="./login.php" target="_blank" > Log in </a></li>
                                        
                </ul>
            </div> <!-- end menu -->      
            
            <?php                                       
                    require_once '../php_functions/Cvutils/utils.php';
                    require_once '../php_functions/db_config/db_connect.php';
                    
                    $fileArray = array();   
                    $branch = "ΣΑΦ";

                    $sql = "SELECT * FROM staticfiles WHERE staticfiles.branch='{$branch}'  ORDER BY staticfiles.fpos ASC";                  
                    
                   $db = new DbMgmt;
                   $res = $db->runQuery($sql);                                                                              
                   while ($row_file = mysqli_fetch_array($res)) {
                        $fileArray[] = $row_file;
                    } 
                    // echo $fileArray[0][5]; 
             ?>

            <div id="mainContainer">

                <div id="leftbar">
                    <h3> <span style="text-decoration: underline; color: red;"> General#1 </span> </h3>
                    <ul>
                        <?php echo "<li>  <a href=\" " . $fileArray[0][4] . "\" target=\"_blank\" >" .  $fileArray[0][3] . "</a> </li>" ; ?>
                        <br/>  
                        <?php echo "<li>  <a href=\" " . $fileArray[1][4] . "\" target=\"_blank\" >" .  $fileArray[1][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[2][4] . "\" target=\"_blank\" >" .  $fileArray[2][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[3][4] . "\" target=\"_blank\" >" .  $fileArray[3][3] . "</a> </li>" ; ?>
                        <br/> 
                       <?php echo "<li>  <a href=\" " . $fileArray[4][4] . "\" target=\"_blank\" >" .  $fileArray[4][3] . "</a> </li>" ; ?>
                        <br/> 
                       <?php echo "<li>  <a href=\" " . $fileArray[5][4] . "\" target=\"_blank\" >" .  $fileArray[5][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[6][4] . "\" target=\"_blank\" >" .  $fileArray[6][3] . "</a> </li>" ; ?>
                        <br/>
                        <?php echo "<li>  <a href=\" " . $fileArray[7][4] . "\" target=\"_blank\" >" .  $fileArray[7][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[8][4] . "\" target=\"_blank\" >" .  $fileArray[8][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[9][4] . "\" target=\"_blank\" >" .  $fileArray[9][3] . "</a> </li>" ; ?>
                        <br/> 
                    </ul>
                    
                    <h3> <span style=" text-decoration: underline; color: red;"> General#2 </span> </h3>
                    <ul>
                        <?php echo "<li>  <a href=\" " . $fileArray[10][4] . "\" target=\"_blank\" >" .  $fileArray[10][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[11][4] . "\" target=\"_blank\" >" .  $fileArray[11][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[12][4] . "\" target=\"_blank\" >" .  $fileArray[12][3] . "</a> </li>" ; ?>
                        <br/> 
                       <?php echo "<li>  <a href=\" " . $fileArray[13][4] . "\" target=\"_blank\" >" .  $fileArray[13][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[14][4] . "\" target=\"_blank\" >" .  $fileArray[14][3] . "</a> </li>" ; ?>
                        <br/>  
                        <?php echo "<li>  <a href=\" " . $fileArray[15][4] . "\" target=\"_blank\" >" .  $fileArray[15][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[16][4] . "\" target=\"_blank\" >" .  $fileArray[16][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[17][4] . "\" target=\"_blank\" >" .  $fileArray[17][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[18][4] . "\" target=\"_blank\" >" .  $fileArray[18][3] . "</a> </li>" ; ?>
                        <br/> 
                        <?php echo "<li>  <a href=\" " . $fileArray[19][4] . "\" target=\"_blank\" >" .  $fileArray[19][3] . "</a> </li>" ; ?>
                    </ul>
                </div> <!-- end leftbar -->
                <div id="content">
                    <h2> <span style="text-align: center; text-decoration: underline; color: red;"> ΣΜΗΝΟΣ ΑΜΥΝΑΣ ΦΡΟΥΡΗΣΗΣ  </span> </h2>
                    
                    <p style="color: blue; width: 90%; font-size: large"> " Το Σμήνος Άμυνας Φρούρησης στο 2ο ΑΚΕ έχει ως κύριο έργο  ..."  </p> 
                    
                    <table>
                        <tr>
                            <th class="code"> Documents / Maps / Images </th>                            
                            <th class="custom"> Χρήσιμα / Useful </th>
                            <th class="sideR">  ΟΡΓΑΝΩΣΗ - ΚΕΠΙΧ </th>
                        </tr>
                        <tr>
                            <td class="code"> <a href="#"> <span style="color: black; background-color: yellow; "> TBD ... </span></a> </td>                                                    
                            <td class="custom"> <a href="../web/saf/useful"> <span style="color: black; background-color: yellow; "> Διάφορα / Χρήσιμα </span></a> </td> 
                            <td class="sideR"> <a href="#"> <span style="color: black; background-color: yellow; "> TBD ... </span></a> </td>
                        </tr>
                        <tr>
                            <td class="code"> <a href="#"> <span style="color: black; background-color: yellow; "> TBD ... </span></a> </td>                           
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[30][4] . "\" target=\"_blank\" >" .  $fileArray[30][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[45][4] . "\" target=\"_blank\" >" .  $fileArray[45][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <td class="code"> <a href="#"> <span style="color: yellow; background-color: orangered; "> TBD ... </span></a> </td>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[31][4] . "\" target=\"_blank\" >" .  $fileArray[31][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[46][4] . "\" target=\"_blank\" >" .  $fileArray[46][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <td class="code"> <a href="#"> <span style="color: red; background-color: cyan; "> TBD ... </span></a> </td>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[32][4] . "\" target=\"_blank\" >" .  $fileArray[32][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[47][4] . "\" target=\"_blank\" >" .  $fileArray[47][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <td class="custom"> <a href="../web/saf/checklists"> <span style="color: black; background-color: yellow; "> Εγχειρίδια - CheckLists </span></a> </td>  
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[33][4] . "\" target=\"_blank\" >" .  $fileArray[33][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[48][4] . "\" target=\"_blank\" >" .  $fileArray[48][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <?php echo "<td class=\"code\"><a href=\" " . $fileArray[20][4] . "\" target=\"_blank\" >" .  $fileArray[20][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[34][4] . "\" target=\"_blank\" >" .  $fileArray[34][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[49][4] . "\" target=\"_blank\" >" .  $fileArray[49][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <?php echo "<td class=\"code\"><a href=\" " . $fileArray[21][4] . "\" target=\"_blank\" >" .  $fileArray[21][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[35][4] . "\" target=\"_blank\" >" .  $fileArray[35][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[50][4] . "\" target=\"_blank\" >" .  $fileArray[50][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <?php echo "<td class=\"code\"><a href=\" " . $fileArray[22][4] . "\" target=\"_blank\" >" .  $fileArray[22][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[36][4] . "\" target=\"_blank\" >" .  $fileArray[36][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[51][4] . "\" target=\"_blank\" >" .  $fileArray[51][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                             <?php echo "<td class=\"code\"><a href=\" " . $fileArray[23][4] . "\" target=\"_blank\" >" .  $fileArray[23][3] . " </a> </td>" ; ?>                            
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[37][4] . "\" target=\"_blank\" >" .  $fileArray[37][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[52][4] . "\" target=\"_blank\" >" .  $fileArray[52][3] . " </a> </td>" ; ?>
                        </tr>
                         <tr>
                            <?php echo "<td class=\"code\"><a href=\" " . $fileArray[24][4] . "\" target=\"_blank\" >" .  $fileArray[24][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[38][4] . "\" target=\"_blank\" >" .  $fileArray[38][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[53][4] . "\" target=\"_blank\" >" .  $fileArray[53][3] . " </a> </td>" ; ?>
                        </tr>
                         <tr>
                            <?php echo "<td class=\"code\"><a href=\" " . $fileArray[25][4] . "\" target=\"_blank\" >" .  $fileArray[25][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[39][4] . "\" target=\"_blank\" >" .  $fileArray[39][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[54][4] . "\" target=\"_blank\" >" .  $fileArray[54][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <?php echo "<td class=\"code\"><a href=\" " . $fileArray[26][4] . "\" target=\"_blank\" >" .  $fileArray[26][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[40][4] . "\" target=\"_blank\" >" .  $fileArray[40][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[55][4] . "\" target=\"_blank\" >" .  $fileArray[55][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <?php echo "<td class=\"code\"><a href=\" " . $fileArray[27][4] . "\" target=\"_blank\" >" .  $fileArray[27][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[41][4] . "\" target=\"_blank\" >" .  $fileArray[41][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[56][4] . "\" target=\"_blank\" >" .  $fileArray[56][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <?php echo "<td class=\"code\"><a href=\" " . $fileArray[28][4] . "\" target=\"_blank\" >" .  $fileArray[28][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[42][4] . "\" target=\"_blank\" >" .  $fileArray[42][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[57][4] . "\" target=\"_blank\" >" .  $fileArray[57][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <?php echo "<td class=\"code\"><a href=\" " . $fileArray[29][4] . "\" target=\"_blank\" >" .  $fileArray[29][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[43][4] . "\" target=\"_blank\" >" .  $fileArray[43][3] . " </a> </td>" ; ?>
                            <?php echo "<td class=\"sideR\"><a href=\" " . $fileArray[58][4] . "\" target=\"_blank\" >" .  $fileArray[58][3] . " </a> </td>" ; ?>
                        </tr>
                        <tr>
                            <td class="code"> <a href="../web/saf/prs"> <span style="color: red; background-color: yellow; "> ΠΡΟΣΩΠΙΚΟ </span></a> </td>
                             <?php echo "<td class=\"custom\"><a href=\" " . $fileArray[44][4] . "\" target=\"_blank\" >" .  $fileArray[44][3] . " </a> </td>" ; ?>                      
                            <td class="sideR"> <a href="./useful_links.php"> <span style="color: red; ">Χρήσιμες Διασυνδέσεις </span></a> </td>
                        </tr>
                        <tr>
                            <td class="Last"> </td>                            
                            <td class="Last"> </td>
                            <td class="Last"> </td>
                        </tr>
                    </table>
                    
                    <br>
                    
                    <table>
                        <tr>
                            <th class="photo">  </th>
                            <th class="photo">  </th>
                            <th class="photo"> </th>
                            <th class="photo">  </th>
                        </tr>
                        <tr>
                            <td class="photo"> <img src="../web/images/misc/IMG_20230614_152232.jpg" alt=""  height=150 width=130 </td>
                            <td class="photo"> <img src="../web/images/misc/IMG_20220114_155812.jpg" alt=""  height=150 width=100 </td>                       
                            <td class="photo"> <img src="../web/images/misc/IMG_20220126_092558.jpg" alt=""  height=100 width=180> </td>
                            <td class="photo"> <img src="../web/images/misc/20230210_094237.jpg" alt=""  height=100 width=180> </td>
                        </tr>
                        <tr>
                            <td class="photo"> 2o ΑΚΕ </td>
                            <td class="photo"> S-743E </td>
                            <td class="photo"> Snow #3 </td>
                            <td class="photo"> Snow #4 </td>
                        </tr>
                        
                    </table>
                   
                </div> <!-- end content -->

                
                
            </div> <!-- end mainContainer -->
        </div> <!-- end container -->

    </body>
</html>

