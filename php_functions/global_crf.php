<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$MyFileID = $_POST['crfID'];
$prIndex  = $_POST['myAsma'];
$prIndex  = $prIndex  . "FID";
$_SESSION[$prIndex ] = $MyFileID;


$findCRF = "SELECT crfiles.* FROM crfiles WHERE crfiles.fid ='{$MyFileID}' ";
$findResult = $db->runQuery($findCRF); 
$findRow = mysqli_fetch_assoc($findResult);

$file_description = $findRow['description'];
$file_path = $findRow['fpath'];

$myIndex1 = $_POST['myAsma'];
$myIndex1 = $myIndex1 . "FDES";
$_SESSION[$myIndex1] = $file_description;

$myIndex2 = $_POST['myAsma'];
$myIndex2 = $myIndex2 . "PATH";
$_SESSION[$myIndex2] = $file_path;



$return = array(
    "r1" =>$_SESSION[$prIndex], 
    "r2" =>$_SESSION[$myIndex1],
    "r3" =>$_SESSION[$myIndex2]  
);


echo json_encode($return);  
?>

 