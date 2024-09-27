<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$myTaskID = $_POST['myTask'];


$findTask = "SELECT * from taskmain where taskid ='{$myTaskID}' ";

$findResult = $db->runQuery($findTask); 

$findRow = mysqli_fetch_assoc($findResult);

$Task = array(
    "taskid" =>$findRow['taskid'],
    "scope" =>$findRow['scope'],
    "subject" =>$findRow['subject'],    
    "date_start" =>$findRow['date_start'],
    "date_exp" =>$findRow['date_exp'],
    "share1" =>$findRow['share1'],
    "share2" =>$findRow['share2'],
    "assign1" =>$findRow['assign1'],
    "assign2" =>$findRow['assign2'],
    "complete" =>$findRow['complete']   
);

echo json_encode($Task);

?>

