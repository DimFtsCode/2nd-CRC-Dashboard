<?php

require_once("functions.inc");
require_once ("./db_config/db_connect.php"); 

$_SESSION['ValidUser'] = array();

//prevent access if they haven't submitted the form.
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/login.php"));    
}

$_SESSION['formAttempt'] = true;
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();
$required = array("asma", "password");

//Check required fields
foreach ($required as $requiredField) {
    if (!isset($_POST[$requiredField]) || $_POST[$requiredField] == "") {
        $_SESSION['error'][] = $requiredField . " is required.";
    }
}

$db = new DbMgmt();
$myAsma = $_POST['asma'];
$findPerson = "SELECT * FROM personnel WHERE asma ='{$myAsma}' ";
$findResult = $db->runQuery($findPerson); 


if (!$findRow = mysqli_fetch_assoc($findResult)) {
    $_SESSION['error'][] = " Acoount DOES NOT exist !!";
    die(header("Location: ../pages/login.php"));
    
} elseif ($_POST['password']=="123456" && $findRow['password']=="123456"){
    $_SESSION['ValidUser'][2] = $_POST['asma'];
    $_SESSION['ValidUser'][1]  = "yes";
    //$_SESSION['error'][] = " Please Check your password with an Administrator !!";
    die(header("Location: ../pages/reset_passwd.php"));
} elseif ($_POST['password']=="123456" ){
    $_SESSION['error'][] = " Please contact an Administrator to check if your password is RESET !!";
    die(header("Location: ../pages/login.php"));
}



if (count($_SESSION['error']) > 0) {
    //die(header("Location: ../pages/login.php"));
    die(header("Location: ../pages/login.php"));
} else {
    $user = new User;
    if ($user->authenticate($_POST['asma'], $_POST['password'])) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/authenticated.php"));
        die(header("Location: ../pages/dashboard.php"));
    } else {
        $_SESSION['error'][] = "There was a problem with your username or password.";
        die(header("Location: ../pages/login.php"));
    }
}
//end login process
?>