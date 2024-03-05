<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

//$user = new User;
//if (!$user->isLoggedIn) {
//    die(header("Location: ../pages/login.php"));
//}

$db = new DbMgmt();


$myID = $_POST['myID'];


$findTDL = "SELECT * from tdl where tdl_id ='{$myID}' "; 
$findResult = $db->runQuery($findTDL);

$findRow = mysqli_fetch_array($findResult);


$tdl = array(
    "tdl_name" =>$findRow['tdl_name'],
    "tdl_type" => $findRow['tdl_type'],
    "direct" => $findRow['direct']    
);

echo json_encode($tdl);

?>