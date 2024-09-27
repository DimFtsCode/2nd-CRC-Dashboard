<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$mySupply = $_POST['mySupply'];
$myIndex = $_POST['myAsma'] . "BRANCH";

$findData = "SELECT * from supply where sup_id ='{$mySupply}' ";
$findResult = $db->runQuery($findData); 
$findRow = mysqli_fetch_assoc($findResult);
$_SESSION[$myIndex] = $findRow['branch'];


$return = array(
    "supid" =>$findRow['sup_id'],
    "serial" =>$findRow['serial'],
    "sdate" =>$findRow['sdate'],
    "year" =>$findRow['year'],
    "description" =>$findRow['description'],
    "directorate" =>$findRow['division'],
    "branch" =>$findRow['branch'],
    "poc" =>$findRow['poc'],
    "cost" =>$findRow['cost'],
    "budget" =>$findRow['budget'],
    "bcode" =>$findRow['bcode'],
    "type_order" =>$findRow['type_order'],
    "order" =>$findRow['order'],
    "link" =>$findRow['link'],
    "funded" =>$findRow['funded'],
    "own_budget" =>$findRow['own_budget'],
    "rdate" =>$findRow['rdate'],
    "ordate" =>$findRow['ordate'],
    "orplace" =>$findRow['orplace'],
    "invoice" =>$findRow['invoice'],
    "fcost" =>$findRow['fcost'],
    "status" =>$findRow['status'],
    "remark" =>$findRow['remark']
);

echo json_encode($return);

?>

