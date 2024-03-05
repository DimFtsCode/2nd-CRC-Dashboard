<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$mySecData = $_POST['mySecData'];


$findData = "SELECT * from security where secid ='{$mySecData}' ";

$findResult = $db->runQuery($findData); 

$findRow = mysqli_fetch_assoc($findResult);

$training = array(
    "secid" =>$findRow['secid'],
    "cardno" =>$findRow['cardno'],
    "expdate" =>$findRow['expdate'],
    "seclevel" =>$findRow['seclevel'],
    "access" =>$findRow['access'],
    "clearance" =>$findRow['clearance'],
    "expclear" =>$findRow['expclear']
);

echo json_encode($training);

?>

