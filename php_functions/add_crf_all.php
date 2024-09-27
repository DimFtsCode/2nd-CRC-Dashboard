
<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php"));
}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array(); 


// function 
function AddCRFile() {
$db = new DbMgmt();   
$fileID = $db->quote($_POST['fileID']);
$myUnit = "2ΑΚΕ";

    //check if the CRF File Already exists
    $findID = "SELECT fid from crf where fid ='{$fileID}' ";
    $findResult = $db->runQuery($findID);
    $findRow = $findResult->fetch_assoc();
   
    if (isset($findRow['fid']) ) {        
        $_SESSION['error'][] = "CRF File with this ID already exists !! Check the File ID ...";
        return false;
    }
    
     $counter = 0;
     $sql = "SELECT *  FROM personnel WHERE unit='{$myUnit}'";
     //$sql = "SELECT *  FROM personnel WHERE personel.unit='{$myUnit}' ";
     $res = $db->runQuery($sql);
     while ($row = mysqli_fetch_array($res)) {
         
         $asma = $row['asma'];
         $division = $row['division'];
         
         $query = "INSERT INTO crf (asma,division,fid,date_reg) "
            . " VALUES ('{$asma}','{$division}','{$fileID}',NOW())";
            
            if ($db->runQuery($query)){
                $counter =  $counter  + 1 ;
            }
                                      
     }
                 
     if ($counter > 0) {
        //error_log("new file has been uploaded!");
        $_SESSION['error'][] = " CRF File successfully Added to the Database !! "; 
        return true;            
    } else {
        //error_log("Problem uploading File");
        $_SESSION['error'][] = " Problem inseting CRF  File  to the Database !! "; 
        // $_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }  
    

}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_crf_all.php"));
} else {
    if (AddCRFile()) {
        
        $_SESSION['error'][] = " CRF successfully ADDED !! ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
        
    } else {
        error_log("Problem replacing new file: ");
        $_SESSION['error'][] = "Problem inserting CRF File to Personnel ??!! ";        
        die(header("Location: ../pages/form_add_crf_all.php"));
    }
}

?>   
    

