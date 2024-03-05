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


$leave_id_delete = $db->quote($_POST['del_id']);

//$myVar = $user->asma;
//$myVar = $myVar . "XID";
//$myID = $_SESSION[$myVar];

$myID =$leave_id_delete;

$sql_delete_leave = "DELETE FROM leaves WHERE tbl_id ='{$myID}' ";
$qry_delete_leave = $db->runQuery($sql_delete_leave);


header('Location: ../pages/form_view_leave.php');

?>
