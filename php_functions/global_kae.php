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
$myKAE = $_POST['myKAE'];
$myIndex = $_POST['myAsma'] . "KAE";
$myIndex2 = $_POST['myAsma'] . "KAEDS";


$findData = "SELECT * from supply where bcode ='{$myKAE}' ";
$findResult = $db->runQuery($findData); 
$findRow = mysqli_fetch_assoc($findResult);
$_SESSION[$myIndex] = $findRow['budget'];



$_SESSION[$myIndex] = $myKAE;
$_SESSION[$myIndex2] = $findRow['budget'];

//$_SESSION[$myIndex2] = "TRERTTTTTTTT";

$_SESSION[$myIndex1] = 1;


$return = array(
    "r1" =>$_SESSION[$myIndex], 
    
);


echo json_encode($return);  
?>

