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


$findAsset = "SELECT * FROM samstatic WHERE static_id ='{$myID}' "; 
$findResult = $db->runQuery($findAsset);

$findRow = mysqli_fetch_array($findResult);


$Asset = array(
    "rs1" =>$findRow['rs1'],   
    "rs4" => $findRow['rs4'],
    "rs4a" => $findRow['rs4a'],
    "rs5" => $findRow['rs5'],
    "rs5a" => $findRow['rs5a'],
    "rs5b" => $findRow['rs5b'],
    "rs6" => $findRow['rs6'],
    "rs11" => $findRow['rs11'],
    "rs12" => $findRow['rs12'],
    "remark" => $findRow['remark']
);

echo json_encode($Asset);

?>