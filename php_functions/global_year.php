<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

// Set variables to be used in the form 
$myYear = $_POST['myYear'];
$myIndex = $_POST['myAsma'] . "YEAR";
$myIndex1 = $_POST['myAsma'] . "XCHECK";


$_SESSION[$myIndex] = $myYear;

$_SESSION[$myIndex1] = 1;


$return = array(
    "r1" =>$_SESSION[$myIndex], 
    
);


echo json_encode($return);  
?>

