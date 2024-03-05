<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change a template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php"));
}

$db = new DbMgmt();

$leavepgr_id_update = $db->quote($_POST['pl_id']);
//$sensor_id_update = 4 ;

$date_update = $db->quote($_POST['start_date']);

$num_days_update = $db->quote($_POST['num_days']);
$leave_type_update = $db->quote($_POST['leave_type']);
$pl_loction_update = $db->quote($_POST['pl_loction']);
$pl_loction_update = strtoupper($pl_loction_update);

$user_reg = $user->asma;

        $sql_update_pgrleave = "UPDATE pgrleave SET start_date='$date_update', num_days='$num_days_update', leave_type='$leave_type_update', pl_location='$pl_loction_update', date_reg= NOW() WHERE pl_id='$leavepgr_id_update'";
        $qry_update_pgrleave = $db->runQuery($sql_update_pgrleave);


header('Location: ../pages/form_view_pgrleave.php');
?>