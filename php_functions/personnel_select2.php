
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

$findPerson = "SELECT personnel.*, prsdata.* FROM personnel, prsdata WHERE personnel.asma ='{$myAsma}' AND personnel.asma =prsdata.asma ";
//$findPerson = "SELECT * FROM personnel WHERE asma ='{$myAsma}' "; 
$findResult = $db->runQuery($findPerson); 

$findRow = mysqli_fetch_assoc($findResult);

$person = array(
    "asma" =>$findRow['asma'],
    "rank" =>$findRow['rank'],
    "specialty" =>$findRow['splty'],
    "last_name" =>$findRow['sname'], 
    "first_name" =>$findRow['fname'],
    "city" =>$findRow['city'],
    "address" =>$findRow['address'],
    "pscode" =>$findRow['pscode'],
    "mphone" =>$findRow['mphone'],
    "phone1" =>$findRow['phone1'],
    "phone2" =>$findRow['phone2'],
    "iphone" =>$findRow['iphone']
);


echo json_encode($person);

?>