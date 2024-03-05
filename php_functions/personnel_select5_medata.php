
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();


$myAsma = $_POST['myAsma'];

$findPerson = "SELECT personnel.*, medata.* FROM personnel, medata WHERE personnel.asma ='{$myAsma}' AND personnel.asma =medata.asma ";
//$findPerson = "SELECT * FROM personnel WHERE asma ='{$myAsma}' "; 
$findResult = $db->runQuery($findPerson); 

$findRow = mysqli_fetch_assoc($findResult);

$person = array(
    "asma" =>$findRow['asma'],
    "rank" =>$findRow['rank'],
    "specialty" =>$findRow['splty'],
    "last_name" =>$findRow['sname'], 
    "first_name" =>$findRow['fname'],
    "medfolder_yn" =>$findRow['medfolder_yn'],
    "medfolder_loc" =>$findRow['medfolder_loc'],
    "trfolder_yn" =>$findRow['trfolder_yn'],
    "trfolder_loc" =>$findRow['trfolder_loc'],
    "abm_yn" =>$findRow['abm_yn'],
    "abm_loc" =>$findRow['abm_loc'],
    "tpye" =>$findRow['tpye'],
    "blood" =>$findRow['blood'],
    "weight" =>$findRow['weight'],
    "height" =>$findRow['height'],
    "vaccin" =>$findRow['vaccin'],
);


echo json_encode($person);

?>