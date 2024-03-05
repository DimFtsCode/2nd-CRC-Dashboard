<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

// Set variables to be used in the form_personnel_detail_info
$myIntercept = $_POST['thisIntercept'];
//$myIntercept = 17;
$myIndex = $_POST['myAsma'] . "INTER";
$myIndex2 = $_POST['myAsma'] . "INTERM";
$_SESSION[$myIndex] = $myIntercept;


$findIntercept = "SELECT intercept.* FROM intercept WHERE intercept.int_id = '{$myIntercept}' ";
$findResult = $db->runQuery($findIntercept); 

$findRow = mysqli_fetch_assoc($findResult);


$_SESSION[$myIndex2] = $findRow['remark'];


$return = array(
    "r1" =>$_SESSION[$myIndex],
    "r2" =>$_SESSION[$myIndex2],
);


echo json_encode($return);  
?>