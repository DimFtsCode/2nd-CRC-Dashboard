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


$findAsset = "SELECT * FROM pgrleave WHERE pl_id ='{$myID}' ";  
$findResult = $db->runQuery($findAsset);

$findRow = mysqli_fetch_array($findResult);


$Log = array(
    "startdate" =>$findRow['start_date'],
    "numofdays" => $findRow['num_days'],
    "leave_type" => $findRow['leave_type'],
    "location" => $findRow['pl_location']
);

echo json_encode($Log);

?>
