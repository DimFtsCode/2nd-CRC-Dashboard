<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php"));
}

//prevent access if they haven’t submitted the form.
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/register.php"));
}

$_SESSION['formAttempt'] = true;  
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();


$_SESSION['MyError'] = array();
//$Myarray = array("MyLog");
$_SESSION['MyError'][0] = " You are here.";
//$_SESSION['MyError'][1] = " Now you have moved  there.";


$db = new DbMgmt();


$sensor_name = $db->quote($_POST['sensor_name']);
$sensor_type = $db->quote($_POST['sensor_type']);
$status = $db->quote($_POST['status']);
$reason = $db->quote($_POST['reason']);
$action = $db->quote($_POST['action']);
$tbc = $db->quote($_POST['tbc']);
//$user_reg = 18889;
$user_reg = $user->asma;

$_SESSION['MyError'][1] = " Now you have moved  there.";

$query = "INSERT INTO sensor (sensor_name,sensor_type,status,reason,action,tbc,user_reg,date_reg) "
            . " VALUES ('{$sensor_name}','{$sensor_type}','{$status}','{$reason}' "
            . ",'{$action}','{$tbc}','{$user_reg}',NOW())";

$sql_insert_sensor = $db->runQuery($query) or die("Could not connect");
header('Location: ../pages/dashboard.php');
?>