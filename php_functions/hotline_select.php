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


$findLINE = "SELECT * from hotline where line_id ='{$myID}' "; 
$findResult = $db->runQuery($findLINE);

$findRow = mysqli_fetch_array($findResult);


$hotline = array(
    "line_name" =>$findRow['line_name'],
    "line_type" => $findRow['line_type']    
);

echo json_encode($hotline);

?>