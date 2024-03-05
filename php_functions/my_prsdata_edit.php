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
    die(header("Location: ../pages/form_edit_my_prsdata.php"));
} else {
    if (editprsdata()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem editing personnel data: ");
        $_SESSION['error'][] = "Problem editing personnel data ??!! ";        
        die(header("Location: ../pages/form_edit_my_prsdata.php"));
    }
}

function editprsdata() {
    $db = new DbMgmt();
    
    $user = new User;

    $asma = $db->quote($_POST['asma']);
             
    $city = $db->quote($_POST['city']);
    $address = $db->quote($_POST['address']);
    $pscode = $db->quote($_POST['pscode']);
    $mphone = $db->quote($_POST['mphone']);
    $phone1 = $db->quote($_POST['phone1']);
    $phone2 = $db->quote($_POST['phone2']);
    $iphone = $db->quote($_POST['iphone']);

     $user_reg = $user->asma;       
    
     $query = "UPDATE prsdata SET city='$city', pscode='$pscode', address='$address', mphone='$mphone', phone1='$phone1', phone2='$phone2', "
         . " iphone='$iphone', user_reg='$user_reg', date_reg=NOW() WHERE asma='$asma' ";
                                          
    if ($db->runQuery($query)) {
        error_log("Personnel data with asma : {$asma} has been edited !");
        return true;            
    } else {
        error_log("Problem editing personnel data with asma : {$asma}");        
        return false;
    }    
}
?>
