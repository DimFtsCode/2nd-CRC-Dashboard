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


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_delete_tpye_asma.php"));
} else {
    if (deleteTpye()) {
        $_SESSION['error'][] = "TPYE has successfully DELETED !! ";            
        die(header("Location: ../pages/form_view_tpye_user.php"));
        unset($_SESSION['formAttempt']);
    } else {        
        $_SESSION['error'][] = "Problem deleting TPYE data ??!! ";        
        die(header("Location: ../pages/form_delete_tpye_asma.php")); 
    }
}

function deleteTpye() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $tpid = $db->quote($_POST['tpid']);
                
    $query = "DELETE FROM `tpye` WHERE `tpid`='$tpid' ";
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "TPYE has successfully Deleted !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "TPYE has not been Deleted !!  ?? ";              
        return false;
    }    
}
?>



