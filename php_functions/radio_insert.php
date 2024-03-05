<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php"));
} 

//prevent access if they haven’t submitted the form.
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/form_add_radio.php"));
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



//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_radio.php"));
} else {
    if (addRadio()) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/dashboard.php"));
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem inseting Radio: ");
        $_SESSION['error'][] = "Problem inseting Radio !! ";            
        die(header("Location: ../pages/form_add_radio.php"));
    }
}

function addRadio() {

$db = new DbMgmt();

$user = new User;

$radio_name = $db->quote($_POST['radio_name']);
$radio_type = $db->quote($_POST['radio_type']);
$location = $db->quote($_POST['location']);
$band = $db->quote($_POST['band']);
$guard = $db->quote($_POST['guard']);
$mpa = $db->quote($_POST['mpa']);
$control = $db->quote($_POST['control']);
$status = $db->quote($_POST['status']);
$reason = $db->quote($_POST['reason']);
$action = $db->quote($_POST['action']);
$tbc = $db->quote($_POST['tbc']);
//$user_reg = 18889;
$user_reg = $user->asma;

//$_SESSION['MyError'][1] = " Now you have moved  there.";

$query = "INSERT INTO radio (radio_name,radio_type,location,band,guard,mpa,control,status,reason,action,tbc,user_reg,date_reg) "
            . " VALUES ('{$radio_name}','{$radio_type}','{$location}','{$band}','{$guard}','{$mpa}','{$control}','{$status}','{$reason}' "
            . ",'{$action}','{$tbc}','{$user_reg}',NOW())";
            
            
            
 if ($db->runQuery($query)) {
        error_log(" Radio has been added successfully !");
        return true;            
    } else {
        error_log(" Problem on adding Radio ! ");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}
?>