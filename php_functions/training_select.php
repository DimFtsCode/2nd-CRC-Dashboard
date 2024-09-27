<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$myTrainID = $_POST['myTrain'];

$findTrain = "SELECT training.*, schools.* FROM training,schools WHERE training.trnid = '{$myTrainID}' AND  schools.shid=training.shid";
//$findPerson = "SELECT * FROM personnel WHERE asma ='{$myAsma}' "; 
$findResult = $db->runQuery($findTrain); 

$findRow = mysqli_fetch_assoc($findResult);

$training = array(
    "trnid" =>$findRow['trnid'],
    "shname" =>$findRow['shname'],
    "date_start" =>$findRow['date_start'],
    "date_end" =>$findRow['date_end']
);

echo json_encode($training);

?>

