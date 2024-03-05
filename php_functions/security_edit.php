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
    die(header("Location: ../pages/form_edit_security_asma.php"));
} else {
    if (editData()) {
        $_SESSION['error'][] = "Data has successfully edited !! ";            
        die(header("Location: ../pages/success_op.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem editing data: ");
        $_SESSION['error'][] = "Problem editing data ??!! ";        
        die(header("Location: ../form_edit_security_asma.php")); 
    }
}

function editData() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $secid = $db->quote($_POST['secid']);
    $cardno = strtoupper($db->quote($_POST['cardno']));    
    $expdate = $db->quote($_POST['expdate']);  
    $eid = $db->quote($_POST['eid']);
    $seclevel = $db->quote($_POST['seclevel']);
    $access = strtoupper($db->quote($_POST['access']));
    $clearance = strtoupper($db->quote($_POST['clearance']));
    $expclear = $db->quote($_POST['expclear']);
       
    $user_reg = $user->asma;
      
     $query = "UPDATE `security` SET `cardno`='$cardno', `expdate`='$expdate', `eid`='$eid', `seclevel`='$seclevel', `access`='$access', `clearance`='$clearance', `expclear`='$expclear', `user_reg`='$user_reg', `date_reg`=NOW() WHERE `secid`='$secid' ";
          
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "Sec Data has successfully edited !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "Sec Data has not been edited !!  ?? ";              
        return false;
    }    
}
?>



