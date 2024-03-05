<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$myIntercept = $_POST['myIntercept'];

$findIntercept = "SELECT intercept.* FROM intercept WHERE intercept.int_id = '{$myIntercept}' ";

$findResult = $db->runQuery($findIntercept); 

$findRow = mysqli_fetch_assoc($findResult);

$interception = array(
    "int_id" =>$findRow['int_id'],
    "cotype" =>$findRow['cotype'],
    "mdate" =>$findRow['mdate'],
    "stime" =>$findRow['stime'],
    "ltime" =>$findRow['ltime'],
    "fcs1" =>$findRow['fcs1'],
    "numf1" =>$findRow['numf1'],
    "typef1" =>$findRow['typef1'],
    "sq1" =>$findRow['sq1'],
    "fcs2" =>$findRow['fcs2'],
    "numf2" =>$findRow['numf2'],
    "typef2" =>$findRow['typef2'],
    "sq2" =>$findRow['sq2'],
    "fcs3" =>$findRow['fcs3'],
    "numf3" =>$findRow['numf3'],
    "typef3" =>$findRow['typef3'],
    "sq3" =>$findRow['sq3'],
    "fcs4" =>$findRow['fcs4'],
    "numf4" =>$findRow['numf4'],
    "typef4" =>$findRow['typef4'],
    "sq4" =>$findRow['sq4'],
    "extcard" =>$findRow['extcard'],
    "area" =>$findRow['area'],
    "alt" =>$findRow['alt'],
    "numint" =>$findRow['numint'],
    "intype" =>$findRow['intype'],
    "numint2" =>$findRow['numint2'],
    "intype2" =>$findRow['intype2'],
    "freq" =>$findRow['freq'],
    "radio" =>$findRow['radio'],
    "post" =>$findRow['post'],
    "aj" =>$findRow['aj'],
    "ajnet" =>$findRow['ajnet'],
    "crypto" =>$findRow['crypto'],
    "mids" =>$findRow['mids'],
    "comq" =>$findRow['comq'],
    "eng" =>$findRow['eng'],
    "iff" =>$findRow['iff'],
    "reason" =>$findRow['reason'],
    "reason2" =>$findRow['reason2'],
    "remark" =>$findRow['remark'],
);

echo json_encode($interception);

?>

