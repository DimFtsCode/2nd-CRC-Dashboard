<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php"); 

$user = new User;
if (!$user->isLoggedIn) { 
    die(header("Location: ../pages/login.php"));
} 

//prevent access if they haven’t submitted the form.
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/form_add_missions.php"));
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


// validate the id IFF3
//if (!preg_match('/^[0-9]+$/', $_POST['iff3'])) {    
//    $_SESSION['error'][] = "IFF1 must be DIGITS only !!.";
//}

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

// validate the FOE TRACK NUMBER
if (isset($_POST['track2']) && $_POST['track2'] != "") {
if (!preg_match('/^[A-ZΑ-Ω0-9 Ϊ.-]+$/u', $_POST['track2'])) {    
    $_SESSION['error'][] = "FOE TRACK NUMBER should be only capital letters!!. and - . ";
}
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_missions.php"));
} else {
    if (addMission()) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/dashboard.php"));
        die(header("Location: ../pages/form_view_missions.php"));
    } else {
        error_log("Problem inseting air asset: ");
        $_SESSION['error'][] = "Problem inseting new mission !! ";            
        die(header("Location: ../pages/form_add_missions.php"));
    }
}

function addMission() {

$db = new DbMgmt();

$user = new User;

$asset = $db->quote($_POST['asset']);
$callsign = strtoupper($db->quote($_POST['callsign']));
$track = $db->quote($_POST['track']);
$mission = $db->quote($_POST['mission']);
$track2 = $db->quote($_POST['track2']);
$result = strtoupper($db->quote($_POST['result']));
$area = strtoupper($db->quote($_POST['area']));
//$area = "TEST123";
$mdate = $db->quote($_POST['mdate']);
$mtime = $db->quote($_POST['mtime']);
$scope = $db->quote($_POST['scope']);
$remark = strtoupper($db->quote($_POST['remark']));

$user_reg = $user->asma;

//$_SESSION['MyError'][1] = " Now you have moved  there.";

$query = "INSERT INTO missions (asset,callsign,track,mission,track2,result,area,mdate,mtime,scope,remark,user_reg,date_reg) "
            . " VALUES ('{$asset}','{$callsign}','{$track}','{$mission}','{$track2}','{$result}','{$area}','{$mdate}','{$mtime}' "
            . ",'{$scope}','{$remark}','{$user_reg}',NOW())";
            
                        
 if ($db->runQuery($query)) {
        error_log(" Mission has been added successfully !");
        return true;            
    } else {
        error_log(" Problem on adding Mission ! ");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}
?>