<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//session_start();

//$user = new User;
//if (!$user->isLoggedIn) {
//    die(header("Location: login.php")); 
//}

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();

$myID = $_POST['myID'];

// Set variables to be used in the form edit_pgr_leave
//$myIndex = $user->asma;

$myIndex = $_POST['myCC'];

$myIndex = $myIndex . "XID";

//$Index = $_POST['myCC'];

//$num = intval($Index);
        
//$_SESSION[$myIndex] = 102 ;

//$_SESSION['myIndex'] = $myID ;

$_SESSION[$myIndex] = $myID ;

//$_SESSION['MyXID'] = $myID ;

//$_SESSION['MyXID'][18889] = $myID ;


// Set variables to be used in the form view_personnell_by_div
$myDivID = $_POST['myDivID'];
$prIndex = $_POST['pr_asma'];
$prIndex = $prIndex . "XID";
//$prIndex = "CCC";
$_SESSION[$prIndex] = $myDivID ;


// Set variables to be used in the form_personnel_detail_info
$userAsma = $_POST['thisAsma'];
$myIndex2 = $_POST['myAsma'];
$myIndex2 = $myIndex2 . "XID";
$_SESSION[$myIndex2] = $userAsma;


$findPerson = "SELECT personnel.*, divisions.* FROM personnel, divisions WHERE personnel.division = divisions.id AND personnel.asma ='{$userAsma}' ";
$findResult = $db->runQuery($findPerson); 
$findRow = mysqli_fetch_assoc($findResult);

$division = $findRow['division'];

$myIndex3 = $_POST['myAsma'];
$myIndex3 = $myIndex3 . "DIV";
$_SESSION[$myIndex3] = $division;


$return = array(
    "r1" =>$_SESSION[$prIndex], 
    "r2" =>$myDivID,
    "r3" =>$_SESSION[$myIndex2]    
);



echo json_encode($return);  
?>