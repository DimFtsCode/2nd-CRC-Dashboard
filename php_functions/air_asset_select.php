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


$findAsset = "SELECT * FROM airstatus WHERE air_id ='{$myID}' "; 
$findResult = $db->runQuery($findAsset);

$findRow = mysqli_fetch_array($findResult);


$Asset = array(
    "base" =>$findRow['base'],
    "squadron" => $findRow['squadron'],
    "numof" => $findRow['numof'],
    "aftype" => $findRow['aftype'],
    "callsign" => $findRow['callsign'],
    "iff1" => $findRow['iff1'],
    "iff3" => $findRow['iff3'],
    "status" => $findRow['status'],
    "daynight" => $findRow['daynight'],
    "scope" => $findRow['scope'],    
    "track" => $findRow['track'],
    "remark" => $findRow['remark']
);

echo json_encode($Asset);

?>