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
$myDate = $_POST['myDate'];
$myDate2 = $_POST['myDate2'];


$myIndex = $_POST['myAsma'] . "DATE";
$myIndex2 = $_POST['myAsma'] . "DATE2";


$_SESSION[$myIndex] = $myDate;
$_SESSION[$myIndex2] = $myDate2;


$return = array(
    "r1" =>$_SESSION[$myIndex],
    
);


echo json_encode($return);  
?>