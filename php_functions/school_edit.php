<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php")); 
}

//prevent access if they haven’t submitted the form.
//if (!isset($_POST['submit'])) {
//    die(header("Location: ../pages/form_add_personnel.php"));
//}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

//// validate the asma
//if (!preg_match('/^[0-9]{5}$/', $_POST['asma'])) {    
//    $_SESSION['error'][] = "Asma must be 5 DIGITS only !!.";
//}
//
//// validate the city
//if (!preg_match('/^[A-ZΑ-Ω Ϊ]+$/u', $_POST['city'])) {    
//    $_SESSION['error'][] = "City should be only capital letters!!.";
//}
//
//// validate the address
//if (!preg_match('/^[A-ZΑ-Ω Ϊ.0-9]+$/u', $_POST['address'])) {   
//    $_SESSION['error'][] = "Address should be only capital letters and numbers !!.";
//}


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_school.php"));
} else {
    if (editSchool()) {
        $_SESSION['error'][] = "School has successfully edited !! ";            
        die(header("Location: ../pages/form_view_schools.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem editing personnel data: ");
        $_SESSION['error'][] = "Problem editing school data ??!! ";        
        die(header("Location: ../pages/form_edit_school.php"));
    }
}

function editSchool() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $shid = $db->quote($_POST['shid']);
    $shname = $db->quote($_POST['shname']);
    $shtype = $db->quote($_POST['shtype']);
    $shname_old = $db->quote($_POST['shname_old']);
    
    //check for an existing school name
    if ($shname_old != $shname) {  
        $_SESSION['error'][] = "If has entered !! ";  
    $findSchool = "SELECT shname, shtype from schools WHERE shname ='{$shname}' AND shtype ='{$shtype }'";
    $findResult = $db->runQuery($findSchool);
    $findRow = $findResult->fetch_assoc();
   
    if (isset($findRow['shname']) && $findRow['shname'] != "") {   
        $_SESSION['error'][] = "School with that name already exists";
        return false;
        }
        
    }
    
    $location = $db->quote($_POST['location']);
    $description = $db->quote($_POST['description']);
    $user_reg = $user->asma;
      
     $query = "UPDATE `schools` SET `shname`='$shname', `shtype`='$shtype', `location`='$location', `description`='$description', `user_reg`='$user_reg', `date_reg`=NOW() WHERE `shid`='$shid' ";
          
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "School has successfully edited !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "School has not been edited !!  ?? ";              
        return false;
    }    
}
?>

