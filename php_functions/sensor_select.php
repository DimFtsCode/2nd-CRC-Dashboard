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


$findSensor = "SELECT * from sensor where sensor_id ='{$myID}' ";
$findResult = $db->runQuery($findSensor);

$findRow = mysqli_fetch_array($findResult);


$sensor = array(
    "sensor_name" =>$findRow['sensor_name'],
    "sensor_type" => $findRow['sensor_type'],    
);

echo json_encode($sensor);

?>