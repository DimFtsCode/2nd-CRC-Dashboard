<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) { 
    die(header("Location: ../pages/login.php"));
} 

//prevent access if they haven’t submitted the form.
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/form_add_air_asset.php"));
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

// validate the id IFF1
if (!preg_match('/^[0-9]+$/', $_POST['iff1'])) {    
    $_SESSION['error'][] = "IFF1 must be DIGITS only !!.";
}

// validate the id IFF3
if (!preg_match('/^[0-9]+$/', $_POST['iff3'])) {    
    $_SESSION['error'][] = "IFF1 must be DIGITS only !!.";
}

// validate the callsign
if (!preg_match('/^[A-ZΑ-Ω0-9 -Ϊ]+$/u', $_POST['callsign'])) {    
    $_SESSION['error'][] = "Call Sign should be only capital letters!!.";
}

// validate the TRACK NUMBER
if (isset($_POST['track']) && $_POST['track'] != "") {
if (!preg_match('/^[A-ZΑ-Ω0-9 Ϊ.-]+$/u', $_POST['track'])) {    
    $_SESSION['error'][] = "TRACK NUMBER should be only capital letters!!. and - . ";
}
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_air_asset.php"));
} else {
    if (addAirAsset()) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/dashboard.php"));
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem inseting air asset: ");
        $_SESSION['error'][] = "Problem inseting air asset !! ";            
        die(header("Location: ../pages/form_add_air_asset.php"));
    }
}

function addAirAsset() {

$db = new DbMgmt();

$user = new User;

$base = $db->quote($_POST['base']);
$squadron = $db->quote($_POST['squadron']);
$numof = $db->quote($_POST['numof']);
$aftype = $db->quote($_POST['aftype']);
$callsign = $db->quote($_POST['callsign']);
$iff1 = $db->quote($_POST['iff1']);
$iff3 = $db->quote($_POST['iff3']);
$status = $db->quote($_POST['status']);
$daynight = $db->quote($_POST['daynight']);
$scope = $db->quote($_POST['scope']);
$track = $db->quote($_POST['track']);
$remark = $db->quote($_POST['remark']);

$user_reg = $user->asma;

//$_SESSION['MyError'][1] = " Now you have moved  there.";

$query = "INSERT INTO airstatus (base,squadron,numof,aftype,callsign,iff1,iff3,status,daynight,scope,track,remark,user_reg,date_reg) "
            . " VALUES ('{$base}','{$squadron}','{$numof}','{$aftype}','{$callsign}','{$iff1}','{$iff3}','{$status}','{$daynight}' "
            . ",'{$scope}','{$track}','{$remark}','{$user_reg}',NOW())";
            
                        
 if ($db->runQuery($query)) {
        error_log(" Air Asset has been added successfully !");
        return true;            
    } else {
        error_log(" Problem on adding Air Asset ! ");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}
?>