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


function insertEvent() {
    $db = new DbMgmt();
    $user = new User;
    
    $asma = $db->quote($_POST['asma']);
    $type = $db->quote($_POST['type']);
    $descript = strtoupper($db->quote($_POST['descript'])); 
    //$fcs3 = strtoupper($db->quote($_POST['fcs3']));
    
    $date_start = $db->quote($_POST['date_start']);
    $date_end = $db->quote($_POST['date_end']);
    
    $doc = strtoupper($db->quote($_POST['doc']));
    //$doc = $db->quote($_POST['doc']);
    $user_reg = $user->asma;

   $query = "INSERT INTO event (`asma`, `type`, `descript`, `date_start`, `date_end`, `doc`, `user_reg`, `date_reg`) VALUES ('{$asma}', '{$type}', '{$descript}', '{$date_start}', '{$date_end}', '{$doc}', '{$user_reg}',NOW())";
       
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = " Event successfully Added to the Database !! "; 
        return true;          
    } else {
        $_SESSION['error'][] = " Problem inseting Event to the Database !! ";        
        return false;
    }    
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_event_asma.php"));
} else {
    if (insertEvent()) {
        $_SESSION['error'][] = " Event successfully ADDED !! ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new Event: ");
        $_SESSION['error'][] = "Problem inseting new Event ??!! ";        
        die(header("Location: ../pages/form_add_event_asma.php"));
    }
}

?>




