<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");   


$db = new DbMgmt();


$myID = $_POST['myID'];


$findAsset = "SELECT * FROM rescue WHERE resc_id ='{$myID}' "; 
$findResult = $db->runQuery($findAsset);

$findRow = mysqli_fetch_array($findResult);


$Asset = array(
    "airport" =>$findRow['airport'],   
    "numof" => $findRow['numof'],
    "aftype" => $findRow['aftype'],
    "callsign" => $findRow['callsign'],    
    "status" => $findRow['status'],
    "daynight" => $findRow['daynight'],   
    "remark" => $findRow['remark']
);

echo json_encode($Asset);

?>