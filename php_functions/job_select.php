<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$myJobID = $_POST['myJob'];


$findJob = "SELECT * from taskjob where jobid ='{$myJobID}' ";

$findResult = $db->runQuery($findJob); 

$findRow = mysqli_fetch_assoc($findResult);

$Job = array(
    "jobid" =>$findRow['jobid'],
    "description" =>$findRow['description'],
    "link" =>$findRow['link'],
    "date_init" =>$findRow['date_init'],
    "user_reg" =>$findRow['user_reg']
);


$myUserREG = $findRow['user_reg'];
$myIndex = $_POST['myAsma'] . "REG";
$_SESSION[$myIndex] = $myUserREG;

echo json_encode($Job);

?>

