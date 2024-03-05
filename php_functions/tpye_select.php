<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$myTpye = $_POST['myTpye'];

$findTpye = "SELECT tpye.* FROM tpye WHERE tpye.tpid = '{$myTpye}' ";

$findResult = $db->runQuery($findTpye); 

$findRow = mysqli_fetch_assoc($findResult);

$training = array(
    "tpid" =>$findRow['tpid'],
    "hospital" =>$findRow['hospital'],
    "exam_type" =>$findRow['exam_type'],
    "date_start" =>$findRow['date_start'],
    "date_end" =>$findRow['date_end'],
    "aea" =>$findRow['aea'],
    "rmknum" =>$findRow['rmknum'],
    "remark" =>$findRow['remark'],
);

echo json_encode($training);

?>

