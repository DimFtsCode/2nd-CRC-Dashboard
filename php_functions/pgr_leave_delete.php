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

$myVar = $user->asma;
$myVar = $myVar . "XID";

//$_SESSION['MyError'][0] = " You are trying ...."; 

//$subject_id = $ $user_reg = $textArea = $progress = $isReleased = $isEditable = ""; 


//$leavepgr_id_delete = $db->quote($_POST['del_id']);

$myID = $_SESSION[$myVar];
//$leavepgr_id_delete = int($leavepgr_id_delete) ;  '{$myID}'

//$sql_delete_pgrleave = "UPDATE pgrleave SET start_date='$date_update', num_days='$num_days_update', leave_type='$leave_type_update', pl_location='$pl_loction_update', date_reg= NOW() WHERE pl_id='$leavepgr_id_update'";
$sql_delete_pgrleave = "DELETE FROM pgrleave WHERE pl_id ='{$myID}' ";
$qry_delete_pgrleave = $db->runQuery($sql_delete_pgrleave);


header('Location: ../pages/form_view_pgrleave.php');

?>