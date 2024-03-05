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

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array(); 

$db = new DbMgmt();


$fileID = $_POST['myID'];
$asma = $_POST['myAsma'];
$signed = null;
$sign = 1;

$query = "UPDATE crf SET sign='$sign', date_sign=NOW() WHERE crf.asma='{$asma}' AND crf.fid='{$fileID}' ";
//$query_update= $db->runQuery($query);

if ($db->runQuery($query)) {
    $_SESSION['error'][] =" CRF File with ID : " . $fileID . " successfully Signed !! ";
    $signed = 1;
} else {
    $_SESSION['error'][] = " Problem Signinig CRF  File  !! ";
    $signed = 0;
}

$data1 = array(
    "sign" =>$signed
  
);

echo json_encode($data1);
?>