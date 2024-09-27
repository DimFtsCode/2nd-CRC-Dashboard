<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo "<a href=\" " . $myFilePath . "\" target=\"_blank\" >" . "<strong style=\"color: red; font-size: 16px;\">" . $myFilePath . "</strong>". " </a>" ;

echo "<a href=\" " . $myFilePath . "\" target=\"_blank\" >" . "<style=\"color: red; font-size: 16px;\">" . $myFilePath . " </a>" ;
    

<h3 class="page-header" > <strong style="color: blue; ">  CRF : <?php echo $myFileDes; ?> ---- Path : <?php echo $myFilePath; ?> </strong></h3>   


  <?php echo <strong style=\"color: blue; \"> . $myDivName;  . </strong> ?>  
      

<?php  echo  "<strong style=\"color: blue; font-size: 20px;\">" .  $myDivName . "</strong>"; ?>


<?php echo $myDivName; ?>


<h1 class="page-header" style="color: red;"> Προβολή Προσωπικού / Επιστασία --- <?php echo date("j - m - Y"); ?></h1>


$myDivName

//final disposition


if ($row_personnel['sign']) == 1) {
    $Signature = "Yes";
} else {
    $Signature = "No";
    
}

 //<?php echo "<td class=\"code\"><a href=\"../docs/me/docs/Joint GRC Link 16 Standard Operating Procedures within ATHINAI FIR HELLAS UIR.pdf\"> Joint GRG Link-16 SOPs </a> </td>" ; ?>


<?php echo "<td class=\"code\"><a href=\"../docs/me/docs/Joint GRC Link 16 Standard Operating Procedures within ATHINAI FIR HELLAS UIR.pdf\"> Joint GRG Link-16 SOPs </a> </td>" ; ?>

<?php echo "<td class=\"code\"><a href=\" " . $fileArray[20][4] . "\" target=\"_blank\" >" .  $fileArray[20][3] . " </a> </td>" ; ?>

<?php echo "<li>  <a href=\" " . $fileArray[19][4] . "\" target=\"_blank\" >" .  $fileArray[19][3] . "</a> </li>" ; ?>

 
 <input type="myDiv" id="description" name="myDiv" class="form-control" placeholder="myDiv" required="myDiv" >
 
               <div class="form-group">
                                <label class="col-sm-2 control-label" style="display:none" >Division : </label>
                                <div class="col-sm-4">
                                    <input type="text" id="division" name="division" class="form-control" placeholder="division" required="division" style="display:none" readonly value="<?php echo $user->branch?>" >
                                    
                                </div>
                            </div> 
 
 
 <?php echo $user->division . " / " . $user->branch . " / " . $user->office ;  ?></i></b>    


          <div class="form-group">                       
                                <label class="col-sm-2 control-label">ΘΕΣΗ ΕΓΓΡΑΦΟΥ : </label>                            
                                <div class="col-sm-2">
                                    <input type="fplace" id="fplace" name="fplace" class="form-control" placeholder="fplace" required="fplace" >
                                    <span class="errorFeedback errorSpan" id="crfyearError">Place  should be only two (2) digits </span>
                                </div>                           
                            </div>  

           <div class="form-group">                       
                                <label class="col-sm-2 control-label">ΕΠΙΣΤΑΣΙΑ : </label>                            
                                <div class="col-sm-4">
                                    <input type="myDiv" id="description" name="myDiv" class="form-control" placeholder="myDiv" required="myDiv" >
                                    <span class="errorFeedback errorSpan" id="descriptionError">Description  should be only capital letters </span>
                                </div>                           
                            </div>  

if ($user->role == "SYS" || $user->role == "CMD" || $user->role2 == "ADP+") {
echo "<h6 class=\"post_id\"> <a class=\"btn btn-outline btn-primary\" data-toggle=\"modal\" data-target=\"#update" . "$post_id_parse[$loop_var]" . " \" >" . $row_show_posts['post_id'] . "  </a> </h6>";
} else {
   echo "<td class=\"post_id\"> <a class=\"btn btn-outline btn-primary\" >" . $row_show_posts['post_id'] . "  </a> </td>";
}


                                <ul class="nav nav-second-level">
                                    <li>
                                        <a style="color: red; "> MISC Admin Jobs <span class="fa arrow"></span></a>
                                        
                                        
                                        
                                        
                                    </li>    
                                        
                                </ul>




<?php echo "<td class=\"custom\"><a href=\" " . $fileArray[44][4] . "\" target=\"_blank\" >" .  $fileArray[44][3] . " </a> </td>" ; ?>