
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
function DelCRFile() {
$db = new DbMgmt();   
$fileID = $db->quote($_POST['fileID']);
$asma = $db->quote($_POST['asma']);
//$directorate = $db->quote($_POST['directorate']);

    //check for an existing user
    $findUser = "SELECT asma from personnel where asma ='{$asma}' ";
    $findRes = $db->runQuery($findUser);
    $findAsma = $findRes->fetch_assoc();
    //$findRow = $db->select($findUser);
    if (!isset($findAsma['asma']) ) {        
        $_SESSION['error'][] = "Personnel with this asma DOES NOT exist";
        return false;
    }

    //check if the CRF File Already exists
    $findID = "SELECT crf.*, personnel.* from crf, personnel WHERE crf.fid='{$fileID}' AND personnel.asma='{$asma}' AND crf.asma=personnel.asma";
    $findResult = $db->runQuery($findID);
    $findRow = $findResult->fetch_assoc();
   
    if (!isset($findRow['fid']) ) {        
        $_SESSION['error'][] = "CRF File with this ID DOES NOT exist !! Check the File ID ...";
        return false;
    }
    
     $counter = 0;
     $sql = "SELECT * FROM personnel WHERE personnel.asma='{$asma}' ";
     $res = $db->runQuery($sql);
     while ($row = mysqli_fetch_array($res)) {
         
         //$asma = $row['asma'];
         
         $query = "DELETE FROM crf WHERE crf.asma='{$asma}' AND crf.fid='{$fileID}' ";
            
            if ($db->runQuery($query)){
                $counter =  $counter  + 1 ;
            }
                                      
     }
                 
     if ($counter > 0) {        
        $_SESSION['error'][] = " CRF File successfully Deleted from the Database !! "; 
        return true;            
    } else {       
        $_SESSION['error'][] = " Problem deleting CRF  File  from the Database !! ";         
        return false;
    }  
    
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_delete_crf_asma.php"));
} else {
    if (DelCRFile()) {
        
        $_SESSION['error'][] = " CRF successfully DELETED !!  ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
        
    } else {
        error_log("Problem deleting the file: ");
        $_SESSION['error'][] = "Problem Deleting CRF File from Personnel ??!! ";        
        die(header("Location: ../pages/form_delete_crf_asma.php"));
    }
}

?>   
    






