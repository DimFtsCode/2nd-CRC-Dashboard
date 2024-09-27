<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) { 
    die(header("Location: ../pages/login.php")); 
} 

//prevent access if they haven’t submitted the form. 
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/form_add_sart.php"));
}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();


// validate the id runway
//if (!preg_match('/^[0-9]+$/', $_POST['runway'])) {    
//    $_SESSION['error'][] = "Runway must be DIGITS only !!.";
//}

// validate the runway
if (!preg_match('/^[A-ZΑ-Ω0-9 -Ϊ]+$/u', $_POST['runway'])) {    
    $_SESSION['error'][] = "Runway should be only capital letters!!.";
}


$_SESSION['MyError'] = array();
//$Myarray = array("MyLog");
//$_SESSION['MyError'][0] = " You are here.";
//$_SESSION['MyError'][1] = " Now you have moved  there.";

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_sart.php"));
} else {
    if (addSART()) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/dashboard.php"));
        die(header("Location: ../pages/form_view_sart.php"));
    } else {
        error_log("Problem inseting SART: ");
        $_SESSION['error'][] = "Problem inseting SART !! ";            
        die(header("Location: ../pages/form_add_sart.php"));
    }
}

function addSART() {

$db = new DbMgmt();

$user = new User;

$base = $db->quote($_POST['base']);
$weather = $db->quote($_POST['weather']);
$status = $db->quote($_POST['status']);
$runway = $db->quote($_POST['runway']);
$remark = strtoupper($db->quote($_POST['remark']));

$user_reg = $user->asma;

//$_SESSION['MyError'][1] = " Now you have moved  there.";

$query = "INSERT INTO sart (base,weather,status,runway, remark,user_reg,date_reg) "
            . " VALUES ('{$base}','{$weather}','{$status}','{$runway}' "
            . ",'{$remark}','{$user_reg}',NOW())";
            
                        
 if ($db->runQuery($query)) {
        error_log(" SART has been added successfully !");
        return true;            
    } else {
        error_log(" Problem on adding SART ! ");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}
?>