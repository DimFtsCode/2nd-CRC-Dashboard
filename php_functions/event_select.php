<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$myEventID = $_POST['myEvent'];


$findEvent = "SELECT * from event where evid ='{$myEventID}' ";

$findResult = $db->runQuery($findEvent); 

$findRow = mysqli_fetch_assoc($findResult);

$training = array(
    "evid" =>$findRow['evid'],
    "type" =>$findRow['type'],
    "descript" =>$findRow['descript'],
    "date_start" =>$findRow['date_start'],
    "date_end" =>$findRow['date_end'],
    "doc" =>$findRow['doc']
);

echo json_encode($training);

?>

