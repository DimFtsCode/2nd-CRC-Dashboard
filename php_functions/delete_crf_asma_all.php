
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

$asma = $db->quote($_POST['asma']);


    //check for an existing user
    $findUser = "SELECT asma from crf WHERE asma ='{$asma}' ";
    $findRes = $db->runQuery($findUser);
    $findAsma = $findRes->fetch_assoc();
    //$findRow = $db->select($findUser);
    if (!isset($findAsma['asma']) ) {        
        $_SESSION['error'][] = "Personnel with this asma DOES NOT have any CRF Files";
        return false;
    }

         $query = "DELETE FROM crf WHERE crf.asma='{$asma}' ";
                     
     if ($db->runQuery($query)) {        
        $_SESSION['error'][] = " CRF File successfully Deleted from the Database !! "; 
        return true;            
    } else {        
        $_SESSION['error'][] = " Problem deleting CRF  File  from the Database !! ";         
        return false;
    }      
           
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_delete_crf_asma_all.php"));
} else {
    if (DelCRFile()) {
        
        $_SESSION['error'][] = " CRF Files successfully DELETED  from Personnel !!  ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
        
    } else {
        error_log("Problem deleting the file: ");
        $_SESSION['error'][] = "Problem Deleting CRF Files from Personnel ??!! ";        
        die(header("Location: ../pages/form_delete_crf_asma_all.php"));
    }
}

?>   
    






