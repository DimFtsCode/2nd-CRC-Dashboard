
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

// validate the asma
//if (!preg_match('/^[\w .]+$/', $_POST['asma'])) {
if (!preg_match('/^[0-9]{5}$/', $_POST['asma'])) {    
    $_SESSION['error'][] = "Asma must be 5 DIGITS only !!.";
}


// function 
function AddCRFile() {
$db = new DbMgmt();   
$fileID = $db->quote($_POST['fileID']);
$asma = $db->quote($_POST['asma']);
$myUnit = "2ΑΚΕ";


    //check for an existing user
    $findUser = "SELECT asma from personnel WHERE asma ='{$asma}' AND unit='{$myUnit}' ";
    $findRes = $db->runQuery($findUser);
    $findAsma = $findRes->fetch_assoc();
    //$findRow = $db->select($findUser);
    if (!isset($findAsma['asma']) ) {        
        $_SESSION['error'][] = "Personnel with this asma DOES NOT exist";
        return false;
    }

    //check if the CRF File Already exists
    $findID = "SELECT crf.*, personnel.* from crf, personnel where crf.fid='{$fileID}' AND personnel.asma='{$asma}' AND crf.asma=personnel.asma";
    $findResult = $db->runQuery($findID);
    $findRow = $findResult->fetch_assoc();
   
    if (isset($findRow['fid']) ) {        
        $_SESSION['error'][] = "CRF File with this ID already exists For this USER !! Check the File ID ...";
        return false;
    }
    
     $counter = 0;
     $sql = "SELECT *  FROM personnel WHERE personnel.asma='{$asma}' ";
     $res = $db->runQuery($sql);
     while ($row = mysqli_fetch_array($res)) {
         
         $asma1= $row['asma'];         
         $division = $row['division'];
         
         $query = "INSERT INTO crf (asma,division,fid,date_reg) "
            . " VALUES ('{$asma1}','{$division}','{$fileID}',NOW())";
         
            
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
    die(header("Location: ../pages/form_add_crf1_asma.php"));
} else {
    if (AddCRFile()) {
        
        $_SESSION['error'][] = " CRF successfully ADDED to USER !!  ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
        
    } else {
        
        $_SESSION['error'][] = "Problem inserting CRF File to USER ??!! ";        
        die(header("Location: ../pages/form_add_crf1_asma.php"));
    }
}

?>   
    





