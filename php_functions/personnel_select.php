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


$myAsma = $_POST['myAsma'];

$findPerson = "SELECT personnel.*, divisions.* FROM personnel, divisions WHERE personnel.division = divisions.id AND personnel.asma ='{$myAsma}' ";
//$findPerson = "SELECT * FROM personnel WHERE asma ='{$myAsma}' "; 
$findResult = $db->runQuery($findPerson); 

$findRow = mysqli_fetch_assoc($findResult);

$My_branch = $findRow['branch'];
$query2= "SELECT branch FROM branches WHERE id ='{$My_branch}' ";
$result2 = $db->runQuery($query2);
$row2 = $result2->fetch_assoc();


$My_branch_new = $findRow['branch'] .",". $row2['branch'];

$person = array(
    "asma" =>$findRow['asma'],
    "rank" =>$findRow['rank'],
    "specialty" =>$findRow['splty'],
    "last_name" =>$findRow['sname'], 
    "first_name" =>$findRow['fname'],
    "password" =>$findRow['password'],
    "unit" =>$findRow['unit'],
    "directorate" =>$findRow['division'],
    "branch" =>$My_branch_new,
    "office" =>$findRow['office'],
    "admin" =>$findRow['admin'],
    "role" =>$findRow['role'],
    "role2" =>$findRow['role2'],
    "role3" =>$findRow['role3'],
    "dateofbirth" =>$findRow['dateofbirth'],
    "dateofassign" =>$findRow['dateofassign'],
    "dateofrelease" =>$findRow['dateofrelease'],
    "idnumber" =>$findRow['idnumber']
);

echo json_encode($person);

?>