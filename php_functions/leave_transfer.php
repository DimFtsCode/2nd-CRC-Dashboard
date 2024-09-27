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
    die(header("Location: ../pages/form_view_pgrleave2.php"));
} else {
    if (insertLeave()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_view_leave.php"));
        //die(header("Location: ../pages/form_view_pgrleave.php"));
    } else {
        error_log("Problem inseting new leave: ");
        $_SESSION['error'][] = "Problem inseting new leave ??!! ";        
        die(header("Location: ../pages/form_view_pgrleave2.php"));
    }
}

function insertLeave() {
    $db = new DbMgmt();
    $user = new User;
    
    $asma = $db->quote($_POST['asma']);   
    $startdate = $db->quote($_POST['start_date']);
    $numofdays = $db->quote($_POST['num_days']);
    $leave_type = $db->quote($_POST['leave_type_id']);
    $location = $db->quote($_POST['location']);
    
    //$location = "TESTATEST";
    $user_reg = $user->asma;
    
    $efyear = date('Y', strtotime($startdate));

    $query = "INSERT INTO leaves (asma,start_date,num_days,leave_type,location,efyear,user_reg,date_reg) "
            . " VALUES ('{$asma}','{$startdate}','{$numofdays}','{$leave_type}','{$location}','{$efyear}','{$user_reg}',NOW())";
            
    if ($db->runQuery($query)) {
        error_log("Leave  has been transfered!");
        return true;            
    } else {
        error_log("Problem transfering Leave !");       
        return false;
    }    
}
?>



