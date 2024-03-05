<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) { 
    die(header("Location: ../pages/login.php"));
} 

//prevent access if they haven’t submitted the form. 
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/form_add_resc_asset.php"));
}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();


$_SESSION['MyError'] = array();
//$Myarray = array("MyLog");
//$_SESSION['MyError'][0] = " You are here.";
//$_SESSION['MyError'][1] = " Now you have moved  there.";

// validate the callsign
if (!preg_match('/^[A-ZΑ-Ω0-9 -Ϊ]+$/u', $_POST['callsign'])) {    
    $_SESSION['error'][] = "Call Sign should be only capital letters!!.";
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_resc_asset.php"));
} else {
    if (addRESCAsset()) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/dashboard.php"));
        die(header("Location: ../pages/form_view_resc_asset.php"));
    } else {
        error_log("Problem inseting RESC asset: ");
        $_SESSION['error'][] = "Problem inseting RESC asset !! ";            
        die(header("Location: ../pages/form_add_resc_asset.php"));
    }
}

function addRESCAsset() {

$db = new DbMgmt();

$user = new User;

$airport = $db->quote($_POST['airport']);
$numof = $db->quote($_POST['numof']);
$aftype = $db->quote($_POST['aftype']);
$callsign = $db->quote($_POST['callsign']);
$status = $db->quote($_POST['status']);
$daynight = $db->quote($_POST['daynight']);
$remark = strtoupper($db->quote($_POST['remark']));

$user_reg = $user->asma;

//$_SESSION['MyError'][1] = " Now you have moved  there.";

$query = "INSERT INTO rescue (airport,numof,aftype,callsign,status,daynight,remark,user_reg,date_reg) "
            . " VALUES ('{$airport}','{$numof}','{$aftype}','{$callsign}','{$status}','{$daynight}' "
            . ",'{$remark}','{$user_reg}',NOW())";
            
                        
 if ($db->runQuery($query)) {
        error_log(" RESC Asset has been added successfully !");
        return true;            
    } else {
        error_log(" Problem on adding RESC Asset ! ");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}
?>