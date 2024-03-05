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


function insertData() {
    $db = new DbMgmt();
    $user = new User;
    
    $asma = $db->quote($_POST['asma']);
    $cardno = strtoupper($db->quote($_POST['cardno']));    
    $expmoto = $db->quote($_POST['expmoto']);     
    $typec = $db->quote($_POST['typec']);
    $plates = strtoupper($db->quote($_POST['plates']));
    $brand = strtoupper($db->quote($_POST['brand']));
    $colour = strtoupper($db->quote($_POST['colour']));
               
    $user_reg = $user->asma;

   $query = "INSERT INTO secmoto (`asma`, `cardno`, `expmoto`, `typec`, `plates`, `brand`, `colour`, `user_reg`, `date_reg`) VALUES ('{$asma}', '{$cardno}', '{$expmoto}', '{$typec}', '{$plates}', '{$brand}', '{$colour}', '{$user_reg}',NOW())";
       
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = " DATA successfully Added to the Database !! "; 
        return true;          
    } else {
        $_SESSION['error'][] = " Problem inseting data to the Database !! ";        
        return false;
    }    
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_secmoto_asma.php"));
} else {
    if (insertData()) {
        $_SESSION['error'][] = "Data have been successfully ADDED !! ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new Data: ");
        $_SESSION['error'][] = "Problem inseting new Data ??!! ";        
        die(header("Location: ../pages/form_add_secmoto_asma.php"));
    }
}

?>




