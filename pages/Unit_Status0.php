<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>        
        <title> 2o AKE / Site Status </title>        
        <?php
        // The following is used to force the browser to clear cashe every time the page is loaded  
        echo("<link rel=\"stylesheet\" type=\"text/css\"  href=\"../styles/style_US0.css?v=" .rand() . "\">" );        
        ?>
        <!--  <link rel="stylesheet" type="text/css"  href="../styles/style_me0.css"> -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1> 2o AKE / Τρέχουσα Επιχειρησιακή Κατάσταση </h1>
            </div> <!-- end header -->
            <div id="menu">
                <ul>
                    <li><a href="../index.php">Home</a></li>                                        
                    
                </ul>
            </div> <!-- end menu -->            

            <div id="mainContainer">

                <div id="leftbar">
                    <h3> <span style="text-decoration: underline; color: red;"> Current OPS Εθνικά </span> </h3>
                    <ul>
                        <li> <a href="./form_view_air_asset_public.php"> ΕΤΟΙΜΟΤΗΤΕΣ Α/Φ </a> </li>                                                
                        <br/>  
                        <li> <a href="./form_view_air_delta_public.php"> ΔΥΝΑΜΗ "Δ" </a> </li>
                        <br/> 
                        <li> <a href="./form_view_sart_public.php"> ΚΑΤΑΣΤΑΣΗ Α/Δ </a> </li>
                        <br/> 
                        <li> <a href="./form_view_resc_asset_public.php"> ΕΤΟΙΜΟΤΗΤΕΣ Α/N </a> </li> 
                        <br/> 
                        <li> <a href="./form_view_sam_asset_public.php"> ΕΤΟΙΜΟΤΗΤΕΣ SAM / SHORAND </a> </li> 
                    </ul>
                    
                    <h3> <span style=" text-decoration: underline; color: red;"> Current OPS NATO </span> </h3>
                    <ul>
                        <li> <a href="../web/ydktis/docs/RV_Slides_ROEs.pdf" target="_blank"> Rules of Engagments  </a> </li>
                        <br/>  
                        <li> <a href="../web/ydktis/docs/RV_Slides_TBMFs.pdf" target="_blank"> TBMFs  </a> </li>
                        <br/>  
                       <li> <a href="#"> tbd </a> </li>
                        <br/> 
                        <li> <a href="#"> tbd </a> </li>
                        <br/> 
                        <li> <a href="#"> tbd </a> </li>
                        <br/> 
                        <li> <a href="#"> tbd </a> </li>
                       
                    </ul>
                </div> <!-- end leftbar -->
                <div id="content">
                    <h2> <span style="text-align: center; text-decoration: underline; color: red;"> 2o AKE / Τρέχουσα Επιχειρησιακή Κατάσταση </span> </h2>
                    
                    <p style="color: blue; width: 90%; font-size: large"> Από την παρούσα σελίδα δίδεται πρόσβαση στην απεικόνιση της Τρέχουσας Επιχειρησιακής Κατάστασης του 2ου ΑΚΕ  </p> 
                    
                    <table>
                        <tr>
                            <th class="code"> OPS Daily Status </th>                            
                            <th class="custom"> OPS National EX / WAR </th>
                            <th class="sideR">  OPS NATO Status </th>
                        </tr>
                        <tr>
                            <td class="code"><a href="./form_view_sensor_public.php"> RADAR Status </a> </td>                                                     
                            <td class="custom"><a href="./form_view_missions_public.php"> ΠΙΝΑΚΑΣ ΤΑΚΤΙΚΩΝ ΑΠΟΣΤΟΛΩΝ </a> </td>  
                            <td class="sideR"> <a href="./form_view_air_asset_nato_public.php"> Fighter's Readiness Status </a> </td>
                        </tr>
                        <tr>
                            <td class="code"><a href="./form_view_radio_public.php"> ΑΣΥΡΜΑΤΟΙ#1 Status </a> </td>                                                     
                            <td class="custom"><a href="./form_view_logbook_public.php"> ΗΜΕΡΟΛΟΓΙΟ ΚΕΠΙΧ </a> </td> 
                            <td class="sideR"> <a href="./form_view_sart_public.php"> Base Status </a> </td>
                        </tr>
                        <tr>
                            <td class="code"><a href="./form_view_radio2_public.php"> ΑΣΥΡΜΑΤΟΙ#2 Status </a> </td>                                                     
                            <td class="custom"><a href="#"> tbd ... </a> </td>
                            <td class="sideR"> <a href="#"> tbd ...  </a> </td>
                        </tr>
                        <tr>                           
                            <td class="code"><a href="./form_view_tdl_public.php"> ΔΙΑΣΥΝΔΕΣΕΙΣ (TDLs) Status </a> </td>  
                            <td class="custom"><a href="#"> tbd ... </a> </td>
                            <td class="sideR"> <a href="#"> tbd ...  </a> </td>
                        </tr>
                        <tr>
                            <td class="code"><a href="./form_view_hotline_public.php"> HOT Lines Status </a> </td>                                                    
                            <td class="custom"><a href="#"> tbd ... </a> </td>
                            <td class="sideR"> <a href="#"> tbd ...  </a> </td>
                        </tr>
                        <tr>
                          <td class="code"><a href="./form_view_air_asset_public.php"> ΕΤΟΙΜΟΤΗΤΕΣ Α/Φ </a> </td>                                                     
                            <td class="custom"><a href="#"> tbd ... </a> </td>
                            <td class="sideR"> <a href="#"> tbd ...  </a> </td>
                        </tr>
                        <tr>
                            <td class="code"><a href="./form_view_air_delta_public.php"> ΔΥΝΑΜΗ "Δ" </a> </td>                                                     
                            <td class="custom"><a href="#"> tbd ... </a> </td>
                            <td class="sideR"> <a href="#"> tbd ...  </a> </td>
                        </tr>
                        <tr>
                            <td class="code"><a href="./form_view_sart_public.php"> ΚΑΤΑΣΤΑΣΗ Α/Δ </a> </td>                                                     
                            <td class="custom"><a href="#"> tbd ... </a> </td>
                            <td class="sideR"> <a href="#"> tbd ...  </a> </td>
                        </tr>
                         <tr>
                            <td class="code"><a href="./form_view_resc_asset_public.php"> ΕΤΟΙΜΟΤΗΤΕΣ Α/N </a> </td>                                                  
                            <td class="custom"><a href="#"> tbd ... </a> </td>
                            <td class="sideR"> <a href="#"> tbd ...  </a> </td>
                        </tr>
                         <tr>
                            <td class="code"><a href="./form_view_sam_asset_public.php"> ΕΤΟΙΜΟΤΗΤΕΣ SAM / SHORAND </a> </td>                                                   
                            <td class="custom"><a href="#"> tbd ... </a> </td>
                            <td class="sideR"> <a href="#"> tbd ...  </a> </td>
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
                            <td class="photo"> <img src="../web/me/images/mambo_ops_1.jpg" alt=""  height=100 width=150> </td>
                            <td class="photo"> <img src="../web/me/images/mambo_ops_2.jpg" alt=""  height=100 width=150> </td>                          
                            <td class="photo"> <img src="../web/me/images/mambo_ops_3.jpg" alt=""  height=100 width=150> </td>
                            <td class="photo"> <img src="../web/me/images/mambo_ops_4.jpg" alt=""  height=100 width=150> </td>
                        </tr>
                        <tr>
                            <td class="photo"> Ops Room #1 </td>
                            <td class="photo"> Ops Room #2 </td>
                            <td class="photo"> Ops Room #3 </td>
                            <td class="photo"> Ops Room #4 </td>
                        </tr>
                        
                    </table>
                   
                </div> <!-- end content -->

                
                <div id="footer">
                    <p> Copyright (c) 2017 znk </p>
                </div> <!-- end footer -->
            </div> <!-- end mainContainer -->
        </div> <!-- end container -->

    </body>
</html>
