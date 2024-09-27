<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$mySchoolID = $_POST['mySchool'];

$findSchool = "SELECT schools.* FROM schools WHERE schools.shid = '{$mySchoolID}' ";
//$findPerson = "SELECT * FROM personnel WHERE asma ='{$myAsma}' "; 
$findResult = $db->runQuery($findSchool); 

$findRow = mysqli_fetch_assoc($findResult);

$school = array(
    "shid" =>$findRow['shid'],
    "shtype" =>$findRow['shtype'],
    "shname" =>$findRow['shname'],
    "location" =>$findRow['location'], 
    "description" =>$findRow['description']
);

echo json_encode($school);

?>

