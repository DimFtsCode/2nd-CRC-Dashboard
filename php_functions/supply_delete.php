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
    die(header("Location: ../pages/form_detail_supply.php"));
} else {
    if (deleteSupply()) {
        $_SESSION['error'][] = "Supply has successfully DELETED !! ";            
        die(header("Location: ../pages/form_view_supply_main.php"));
        unset($_SESSION['formAttempt']);
    } else {        
        $_SESSION['error'][] = "Problem deleting Supply entry ??!! ";        
        die(header("Location: ../pages/form_detail_supply.php")); 
    }
}

function deleteSupply() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $supply = $db->quote($_POST['supid']);
           
    $query = "DELETE FROM `supply` WHERE `sup_id`='$supply'";
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "Supply has successfully Deleted !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "Supply has not been Deleted !!  ?? ";              
        return false;
    }    
}
?>



