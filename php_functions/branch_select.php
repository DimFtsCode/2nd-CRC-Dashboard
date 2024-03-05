<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php"); 

$db = new DbMgmt();

$test = $_POST['myBranch'] . "test"; 
//$asma = $db->quote($_POST['asma']);
$myBranch = $_POST['myBranch'];


$findBranch = "SELECT * from branches where div_id ='{$myBranch}' ";
$findResult = $db->runQuery($findBranch);

//$findRow = mysqli_fetch_array($findResult);

//$branch_list_= Array();
$branch_list = array();
$branch = array();
$id=array();
$test = "test123";


$store_data = array(
    "id" => 0,
    "branch" => "test"
);

$i = 0;
$j = 0 ;

$ID = "id" . $i;
$BR = "branch" . $j;
while ($findRow = mysqli_fetch_array($findResult)) {
    //$branch_list[] = array($id => $findRow['id']);
    //$branch_list[] = array($branch => $findRow['branch']);
    $id[]=$findRow['id'];
    $branch[] = $findRow['branch'];
    $mykey = "\"". $findRow['id'] . "\": ";
    $myvalue = "\"". $findRow['branch'] . "\"";
    //$branch_list[] = $findRow['branch'];
    //$branch_list[] = $findRow['id'];
    //$branch_list[$i][$j] =[ $id, $branch ];
    
    //$branch_list[]=[ $mykey . $myvalue ];
    
    $branch_list[]=[ $findRow['id'], $findRow['branch'] ];
    //array_push($store_data, [$ID => $findRow['id']], [$BR =>$findRow['branch']]);
    $i = $i + 1;
    $j = $j + 1;
}





//$branch = array(
//    "id" =>$findRow['id'],
//    "branch" => $findRow['branch']
//);

echo json_encode($branch_list);
//echo json_encode(array($id,$branch));
//echo json_encode($store_data);
?>