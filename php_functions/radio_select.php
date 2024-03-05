<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php"); 

//$user = new User;
//if (!$user->isLoggedIn) {
//    die(header("Location: ../pages/login.php"));
//}

$db = new DbMgmt();


$myID = $_POST['myID'];


$findRadio = "SELECT * from radio where radio_id ='{$myID}' "; 
$findResult = $db->runQuery($findRadio);

$findRow = mysqli_fetch_array($findResult);


$radio = array(
    "radio_name" =>$findRow['radio_name'],
    "radio_type" => $findRow['radio_type'],
    "location" => $findRow['location'],
    "band" => $findRow['band'],
    "guard" => $findRow['guard'],
    "mpa" => $findRow['mpa'],
    "control" => $findRow['control'],
);

echo json_encode($radio);

?>