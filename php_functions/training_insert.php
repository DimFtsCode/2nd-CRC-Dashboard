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


function insertTraining() {
    $db = new DbMgmt();
    $user = new User;
    
    $shid = $db->quote($_POST['shid']);
    $asma = $db->quote($_POST['asma']);
    
    //check for an existing school 
    $findSchool = "SELECT * from training WHERE shid ='{$shid}' AND asma ='{$asma}'";
    $findResult = $db->runQuery($findSchool);
    $findRow = $findResult->fetch_assoc();
   
    if (isset($findRow['shid']) && $findRow['shid'] != "") {   
        $_SESSION['error'][] = "This School already exists for the selected Personnel";
        return false;
    }
    
    $date_start = $db->quote($_POST['date_start']);
    $date_end = $db->quote($_POST['date_end']);
    $user_reg = $user->asma;

   $query = "INSERT INTO training (`asma`, `shid`,`date_start`, `date_end`, `user_reg`, `date_reg`) VALUES ('{$asma}', '{$shid}', '{$date_start}', '{$date_end}', '{$user_reg}',NOW())";
       
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = " Training successfully Added Personnel !! "; 
        return true;          
    } else {
        $_SESSION['error'][] = " Problem inseting training to Personnel !! ";        
        return false;
    }    
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_school_asma.php"));
} else {
    if (insertTraining()) {
        $_SESSION['error'][] = " School successfully ADDED to Personnel!! ";        
        //die(header("Location: ../pages/success_op.php"));  
        die(header("Location: ../pages/form_view_school_asma.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new school: ");
        $_SESSION['error'][] = "Problem inseting new School to Personnel  ??!! ";        
        die(header("Location: ../pages/form_add_school_asma.php"));
    }
}

?>




