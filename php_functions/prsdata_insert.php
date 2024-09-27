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

// validate the asma
if (!preg_match('/^[0-9]{5}$/', $_POST['asma'])) {    
    $_SESSION['error'][] = "Asma must be 5 DIGITS only !!.";
}

// validate the city
if (!preg_match('/^[A-ZΑ-Ω Ϊ]+$/u', $_POST['city'])) {    
    $_SESSION['error'][] = "City should be only capital letters!!.";
}

// validate the address
if (!preg_match('/^[A-ZΑ-Ω Ϊ.0-9]+$/u', $_POST['address'])) {   
    $_SESSION['error'][] = "Address should be only capital letters and numbers !!.";
}

// validate the PSCODE
if (!preg_match('/^[A-ZΑ-Ω Ϊ.0-9]+$/u', $_POST['pscode'])) {   
    $_SESSION['error'][] = "Postal Code should be only capital letters and numbers !!.";
}

// validate the  phone
if (!preg_match('/^[0-9 +-]+$/', $_POST['mphone'])) {    
    $_SESSION['error'][] = "Mobile phone should be only digits !!. and -, + . ";
}

// validate the  phone
if (!preg_match('/^[0-9 +-]+$/', $_POST['phone1'])) {    
    $_SESSION['error'][] = "Phone#1 should be only digits !!. and -, + . ";
}

// validate the phone2
if (isset($_POST['phone2']) && $_POST['phone2'] != "") {
if (!preg_match('/^[0-9 +-]+$/', $_POST['phone2'])) {  
    $_SESSION['error'][] = "Phone#2 should be only capital letters!!. and - . ";
}
}

// validate the  phone
if (!preg_match('/^[0-9 +-]+$/', $_POST['iphone'])) {    
    $_SESSION['error'][] = "Internal phone should be only digits !!. and -, + . ";
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_prsdata.php"));
} else {
    if (add_prsdata()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_personnel_detail_info.php"));
    } else {
        error_log("Problem inseting personnel: ");
        $_SESSION['error'][] = "Problem inseting personnel ??!! ";        
        die(header("Location: ../pages/form_add_prsdata.php"));
    }
}

function add_prsdata() {
    $db = new DbMgmt();
    
    $user = new User;

    $asma = $db->quote($_POST['asma']);
    
    //check for an existing user
    $findUser = "SELECT asma from prsdata where asma ='{$asma}' ";
    $findResult = $db->runQuery($findUser);
    $findRow = $findResult->fetch_assoc();
    //$findRow = $db->select($findUser);
    if (isset($findRow['asma']) && $findRow['asma'] != "") {        
        $_SESSION['error'][] = "Personnel with that asma already exists";
        return false;
    }
        
    $city = $db->quote($_POST['city']);
    $address = $db->quote($_POST['address']);
    $pscode = $db->quote($_POST['pscode']);
    $mphone = $db->quote($_POST['mphone']);
    $phone1 = $db->quote($_POST['phone1']);
    $phone2 = $db->quote($_POST['phone2']);
    $iphone = $db->quote($_POST['iphone']);
    
    $user_reg = $user->asma;
    
     $query = "INSERT INTO prsdata (asma,city,address,pscode,mphone,phone1,phone2,iphone,user_reg,date_reg) "
            . " VALUES ('{$asma}','{$city}','{$address}','{$pscode}','{$mphone}','{$phone1}','{$phone2}','{$iphone}','{$user_reg}',NOW())";
            //. ",'{$office}','{$dateofbirth}','{$dateofassign}','{$admin}','{$role}','{$role2}','{$idnumber}')";                          
            
    if ($db->runQuery($query)) {
        error_log("Personnel with asma : {$asma} has been inserted !");
        return true;            
    } else {
        error_log("Problem inserting personnel with asma : {$asma}");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }    
}
?>

