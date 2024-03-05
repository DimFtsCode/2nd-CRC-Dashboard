<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php")); 
}

$db = new DbMgmt();

$_SESSION['MyError'][0] = " You are trying ....";

//$subject_id = $ $user_reg = $textArea = $progress = $isReleased = $isEditable = ""; 


$sensor_id_update = $db->quote($_POST['sensor']);
//$sensor_id_update = 4 ;

$status_update = $db->quote($_POST['status']);
$reason_update = $db->quote($_POST['reason']);
$action_update = $db->quote($_POST['action']);
$date_update = $db->quote($_POST['tbc']);
$user_reg = $user->asma;
//$user_reg = 18889;
//$date_reg = NOW();

$_SESSION['MyError'][1] ="SID .." . $sensor_id_update;
$_SESSION['MyError'][2] =$reason_update;
$_SESSION['MyError'][3] =$user_reg;


if (isset($sensor_id_update)) {
    if (isset($status_update)) {
        //$sql_update_sensor = "UPDATE `1ake`.`sensor` SET `status` =$status_update, `reason` = $reason_update, `action` = $action_update, `tbc` = $date_update, `user_reg` = $user_reg, `date_reg` = NOW()  WHERE `sensor`.`sensor_id` = $sensor_id_update";
        $sql_update_sensor = "UPDATE sensor SET status='$status_update', reason='$reason_update', action='$action_update', tbc='$date_update', date_reg= NOW() WHERE sensor_id='$sensor_id_update'";
        $qry_update_sensor = $db->runQuery($sql_update_sensor);
    }
}


header('Location: ../pages/form_view_sensor.php');
?>