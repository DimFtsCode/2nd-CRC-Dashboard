<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$mySecMoto = $_POST['mySecMoto'];


$findData = "SELECT * from secmoto where mid ='{$mySecMoto}' ";

$findResult = $db->runQuery($findData); 

$findRow = mysqli_fetch_assoc($findResult);

$training = array(
    "mid" =>$findRow['mid'],
    "cardno" =>$findRow['cardno'],
    "expmoto" =>$findRow['expmoto'],
    "typec" =>$findRow['typec'],
    "plates" =>$findRow['plates'],
    "brand" =>$findRow['brand'],
    "colour" =>$findRow['colour']
);

echo json_encode($training);

?>

