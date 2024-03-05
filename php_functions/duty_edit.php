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



//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_duty.php"));
} else {
    if (editDuty()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_personnel_detail_info.php"));
        
    } else {
        error_log("Problem editing new duty: ");
        $_SESSION['error'][] = "Problem editing new duty ??!! ";        
        die(header("Location: ../pages/form_edit_duty.php"));
    }
}

function editDuty() {
    $db = new DbMgmt();
    $user = new User;
    
    $asma = $db->quote($_POST['asma']);   
    $date1 = $db->quote($_POST['date1']);
    $duty1 = $db->quote($_POST['duty1']);
    $date2 = $db->quote($_POST['date2']);
    $duty2 = $db->quote($_POST['duty2']);
    $date3 = $db->quote($_POST['date3']);
    $duty3 = $db->quote($_POST['duty3']);
   
    $user_reg = $user->asma;
            
             $query = "UPDATE duty SET date1='$date1', duty1='$duty1', date2='$date2', duty2='$duty2', date3='$date3', duty3='$duty3', "
         . " user_reg='$user_reg', date_reg=NOW() WHERE asma='$asma' ";
            
    if ($db->runQuery($query)) {
        error_log("the Duty  has been editrd !");
        return true;            
    } else {
        error_log("Problem editing  Duty !");       
        return false;
    }    
}
?>






