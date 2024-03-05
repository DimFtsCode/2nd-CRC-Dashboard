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
    die(header("Location: ../pages/form_add_duty.php"));
} else {
    if (insertDuty()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_personnel_detail_info.php"));
        
    } else {
        error_log("Problem inseting new duty: ");
        $_SESSION['error'][] = "Problem inseting new duty ??!! ";        
        die(header("Location: ../pages/form_add_duty.php"));
    }
}

function insertDuty() {
    $db = new DbMgmt();
    $user = new User;
    
    $asma = $db->quote($_POST['asma']);   
    
     //check for an existing user
    $findUser = "SELECT asma from duty where asma ='{$asma}' ";
    $findResult = $db->runQuery($findUser);
    $findRow = $findResult->fetch_assoc();
    
    if (isset($findRow['asma']) && $findRow['asma'] != "") {        
        $_SESSION['error'][] = "Personnel with that asma already exists";
        return false;
    }
    
    $date1 = $db->quote($_POST['date1']);
    $duty1 = $db->quote($_POST['duty1']);
    $date2 = $db->quote($_POST['date2']);
    $duty2 = $db->quote($_POST['duty2']);
    $date3 = $db->quote($_POST['date3']);
    $duty3 = $db->quote($_POST['duty3']);
   
    $user_reg = $user->asma;
    
  

    $query = "INSERT INTO duty (asma,date1,duty1,date2,duty2,date3,duty3,user_reg,date_reg) "
            . " VALUES ('{$asma}','{$date1}','{$duty1}','{$date2}','{$duty2}','{$date3}','{$duty3}','{$user_reg}',NOW())";
            
    if ($db->runQuery($query)) {
        error_log("new Duty  has been inserted!");
        return true;            
    } else {
        error_log("Problem inserting new Duty !");       
        return false;
    }    
}
?>




