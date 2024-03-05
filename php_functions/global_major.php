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
$myMajor = $_POST['thisMajor'];

$myIndex = $_POST['myAsma'] . "MAJOR";
$myIndex2 = $_POST['myAsma'] . "DESCR";

$_SESSION[$myIndex] = $myMajor;


$findMajor = "SELECT major.* FROM major WHERE major.mjid = '{$myMajor}' ";
$findResult = $db->runQuery($findMajor); 

$findRow = mysqli_fetch_assoc($findResult);


$_SESSION[$myIndex2] = $findRow['descript'];

$return = array(
    "r1" =>$_SESSION[$myIndex],
    "r2" =>$_SESSION[$myIndex2],
);


echo json_encode($return);  
?>