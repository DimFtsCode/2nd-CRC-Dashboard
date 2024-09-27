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

$leave_id_update = $db->quote($_POST['tbl_id']);
//$leave_id_update = 8;

$date_update = $db->quote($_POST['start_date']);
//$date_update  = "2020-12-23";

$num_days_update = $db->quote($_POST['num_days']);
//$num_days_update  = 15;

$leave_type_update = $db->quote($_POST['leave_type']);
//$leave_type_update = 10;

$efyear_update = $db->quote($_POST['efyear']);

$loction_update = $db->quote($_POST['loction']);
//$loction_update = "LARISDDDDDDDDSA";
$loction_update = strtoupper($loction_update);

$user_reg = $user->asma;

//        $sql_update_leaves = "UPDATE leaves SET start_date='$date_update', num_days='$num_days_update', leave_type='$leave_type_update', location='$loction_update', date_reg= NOW() WHERE id='$leave_id_update'";
//        $qry_update_leaves = $db->runQuery($sql_update_leaves);

 $sql_update_leave = "UPDATE leaves SET start_date='$date_update', num_days='$num_days_update', leave_type='$leave_type_update', location='$loction_update', efyear='$efyear_update', date_reg= NOW() WHERE tbl_id='$leave_id_update'";
        $qry_update_leave = $db->runQuery($sql_update_leave);


header('Location: ../pages/form_view_leave.php');
?>

