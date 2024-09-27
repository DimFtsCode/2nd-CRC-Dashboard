<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$myMajorID = $_POST['myMajor'];


$findMajor = "SELECT * from major where mjid ='{$myMajorID}' ";

$findResult = $db->runQuery($findMajor); 

$findRow = mysqli_fetch_assoc($findResult);

$MajorEvent = array(
    "mjid" =>$findRow['mjid'],
    "scope" =>$findRow['scope'],
    "type" =>$findRow['type'],
    "descript" =>$findRow['descript'],
    "date_start" =>$findRow['date_start'],
    "date_end" =>$findRow['date_end'],
    "link" =>$findRow['link']
);

echo json_encode($MajorEvent);

?>

