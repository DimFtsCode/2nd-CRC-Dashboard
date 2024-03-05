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


function insertSchool() {
    $db = new DbMgmt();
    $user = new User;
    
    $shname = $db->quote($_POST['shname']);
    $shtype = $db->quote($_POST['shtype']);
    
    //check for an existing school name
    $findSchool = "SELECT shname, shtype from schools WHERE shname ='{$shname}' AND shtype ='{$shtype }'";
    $findResult = $db->runQuery($findSchool);
    $findRow = $findResult->fetch_assoc();
   
    if (isset($findRow['shname']) && $findRow['shname'] != "") {   
        $_SESSION['error'][] = "School with that name already exists";
        return false;
    }
    
    $location = $db->quote($_POST['location']);
    $description = $db->quote($_POST['description']);
    $user_reg = $user->asma;

   $query = "INSERT INTO schools (`shname`, `shtype`,`location`, `description`, `user_reg`, `date_reg`) VALUES ('{$shname}', '{$shtype}', '{$location}', '{$description}', '{$user_reg}',NOW())";
       
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = " School successfully Added to the Database !! "; 
        return true;          
    } else {
        $_SESSION['error'][] = " Problem inseting School to the Database !! ";        
        return false;
    }    
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_school.php"));
} else {
    if (insertSchool()) {
        $_SESSION['error'][] = " School successfully ADDED !! ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new school: ");
        $_SESSION['error'][] = "Problem inseting new School ??!! ";        
        die(header("Location: ../pages/form_add_school.php"));
    }
}

?>




