<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

// Set variables to be used in the form view_personnell_by_div
$myDivID = $_POST['myDivID'];
$prIndex = $_POST['myAsma'];
$prIndex = $prIndex . "XID";
$_SESSION[$prIndex] = $myDivID ;


$findDIV = "SELECT divisions.* FROM divisions WHERE divisions.id ='{$myDivID}' ";
$findResult = $db->runQuery($findDIV); 
$findRow = mysqli_fetch_assoc($findResult);

$division = $findRow['description'];

$myIndex3 = $_POST['myAsma'];
$myIndex3 = $myIndex3 . "DIV";
$_SESSION[$myIndex3] = $division;


$return = array(
    "r1" =>$_SESSION[$prIndex], 
    "r2" =>$_SESSION[$myIndex3]   
);


echo json_encode($return);  
?>

