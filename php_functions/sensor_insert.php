<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php"));
}

//prevent access if they haven’t submitted the form.
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/form_add_sensor.php"));
}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();


//$_SESSION['MyError'] = array();
//$Myarray = array("MyLog");
//$_SESSION['MyError'][0] = " You are here.";
//$_SESSION['MyError'][1] = " Now you have moved  there.";

 //validate the Sensor name
if (!preg_match('!^[A-Z0-9Α-Ω -/]+$!u', $_POST['sensor_name'])) {
    $_SESSION['error'][] = "Sensor Name must be CAPITAL letters, numbers AND -, / only.";
}


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_sensor.php"));
} else {
    if (addRadar()) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/dashboard.php"));
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem inseting RADAR: ");
        $_SESSION['error'][] = "Problem inseting RADAR !! ";        
        die(header("Location: ../pages/form_add_sensor.php"));
    }
}

function addRadar() {

$db = new DbMgmt();

$user = new User;

$sensor_name = $db->quote($_POST['sensor_name']);
$sensor_type = $db->quote($_POST['sensor_type']);
$status = $db->quote($_POST['status']);
$reason = $db->quote($_POST['reason']);
$action = $db->quote($_POST['action']);
$tbc = $db->quote($_POST['tbc']);
//$user_reg = 18889;
$user_reg = $user->asma;

//$_SESSION['MyError'][1] = " Now you have moved  there.";

$query = "INSERT INTO sensor (sensor_name,sensor_type,status,reason,action,tbc,user_reg,date_reg) "
            . " VALUES ('{$sensor_name}','{$sensor_type}','{$status}','{$reason}' "
            . ",'{$action}','{$tbc}','{$user_reg}',NOW())";
            
            
            
 if ($db->runQuery($query)) {
        error_log(" RADAR has been added successfully !");
        return true;            
    } else {
        error_log(" Problem on adding RADAR ! ");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}
?>