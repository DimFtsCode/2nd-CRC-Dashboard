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
    die(header("Location: ../pages/form_delete_major.php"));
} else {
    if (deleteEvent()) {
        $_SESSION['error'][] = "Event has successfully DELETED !! ";            
        die(header("Location: ../pages/success_op.php"));
        unset($_SESSION['formAttempt']);
    } else {        
        $_SESSION['error'][] = "Problem deleting Main Event  ??!! ";        
        die(header("Location: ../pages/form_delete_major.php")); 
    }
}

function deleteEvent() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $mjid = $db->quote($_POST['mjid']);
           
    $query = "DELETE FROM `major` WHERE `mjid`='$mjid'";
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "Event has successfully Deleted !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "Event has not been Deleted !!  ?? ";              
        return false;
    }    
}
?>



