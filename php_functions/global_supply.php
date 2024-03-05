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
$mySupply = $_POST['thisSupply'];

$myIndex = $_POST['myAsma'] . "SUPPLY";
$myIndex1 = $_POST['myAsma'] . "BRANCH";
$myIndex2 = $_POST['myAsma'] . "BRANCH2";

$_SESSION[$myIndex] = $mySupply;


$findData = "SELECT * from supply where sup_id ='{$mySupply}' ";
$findResult = $db->runQuery($findData); 
$findRow = mysqli_fetch_assoc($findResult);
$_SESSION[$myIndex1] = $findRow['branch'];



$myBranchID = $findRow['branch'];
$findData2 = "SELECT * from branches where id ='{$myBranchID}' ";
$findResult2 = $db->runQuery($findData2);
$findRow2 = mysqli_fetch_assoc($findResult2);
$_SESSION[$myIndex2] = $findRow2['branch'];


$return = array(
    "r1" =>$_SESSION[$myIndex],
    
);


echo json_encode($return);  
?>