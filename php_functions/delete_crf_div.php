
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
function DelCRFile() {
$db = new DbMgmt();   
$fileID = $db->quote($_POST['fileID']);
$directorate = $db->quote($_POST['directorate']);

    //check if the CRF File Already exists
    $findID = "SELECT crf.*, personnel.* from crf, personnel where crf.fid='{$fileID}' AND personnel.division='{$directorate}' AND crf.asma=personnel.asma";
    $findResult = $db->runQuery($findID);
    $findRow = $findResult->fetch_assoc();
   
    if (!isset($findRow['fid']) ) {        
        $_SESSION['error'][] = "CRF File with this ID DOES NOT exist !! Check the File ID ...";
        return false;
    }
    
     $counter = 0;
     $sql = "SELECT * FROM personnel WHERE personnel.division='{$directorate}' ";
     $res = $db->runQuery($sql);
     while ($row = mysqli_fetch_array($res)) {
         
         $asma = $row['asma'];
         
         $query = "DELETE FROM crf WHERE crf.asma='{$asma}' AND crf.fid='{$fileID}' AND crf.division='{$directorate}' ";
            
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
    die(header("Location: ../pages/form_delete_crf_div.php"));
} else {
    if (DelCRFile()) {
        
        $_SESSION['error'][] = " CRF successfully DELETED !!  ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
        
    } else {
        error_log("Problem deleting the file: ");
        $_SESSION['error'][] = "Problem Deleting CRF File from Personnel ??!! ";        
        die(header("Location: ../pages/form_delete_crf_div.php"));
    }
}

?>   
    




