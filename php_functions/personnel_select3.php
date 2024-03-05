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
$myDate = date('2000-01-01');
$myExam1 = "ΕΤΗΣΙΑ";
$myExam2 = "ΔΙΕΤΗΣΙΑ";
$myExam3 = "ΠΕΡΙΟΔΙΚΗ ΕΞΕΤΑΣΗ";

//$myAsma = 16518;

$findPerson = "SELECT personnel.*, divisions.* FROM personnel, divisions WHERE personnel.division = divisions.id AND personnel.asma ='{$myAsma}' ";
$findPersonData = "SELECT personnel.*, prsdata.* FROM personnel, prsdata WHERE personnel.asma ='{$myAsma}' AND personnel.asma =prsdata.asma ";
$findPersonDuty = "SELECT personnel.*, duty.* FROM personnel, duty WHERE personnel.asma ='{$myAsma}' AND personnel.asma =duty.asma ";
$findPersonMedata = "SELECT personnel.*, medata.* FROM personnel, medata WHERE personnel.asma ='{$myAsma}' AND personnel.asma =medata.asma ";
//$findPersonTpye = "SELECT tpye.* FROM tpye WHERE tpye.asma='{$myAsma}' ORDER BY tpye.date_start DESC";
$findPersonTpye = "SELECT tpye.* FROM tpye WHERE tpye.asma='{$myAsma}' AND (tpye.exam_type='{$myExam1}' OR tpye.exam_type='{$myExam2}' OR tpye.exam_type='{$myExam3}') ORDER BY tpye.date_start DESC";
$findPersonTpyePending = "SELECT tpye.* FROM tpye WHERE tpye.asma='{$myAsma}' AND tpye.date_end='{$myDate}'";

// ***************************************************************
$findResult = $db->runQuery($findPerson); 
$findRow = mysqli_fetch_assoc($findResult);

// ***************************************************************
$findData = $db->runQuery($findPersonData); 
$findRowData = mysqli_fetch_assoc($findData);

// ***************************************************************
$findDuty = $db->runQuery($findPersonDuty); 
$findRowDuty = mysqli_fetch_assoc($findDuty);

// ***************************************************************
$findMedata = $db->runQuery($findPersonMedata); 
$findRowMedata = mysqli_fetch_assoc($findMedata);

// ***************************************************************
$findTpyeData = $db->runQuery($findPersonTpye); 
$findRowTpyeData = mysqli_fetch_assoc($findTpyeData);

// ***************************************************************
$findTpyePendingData = $db->runQuery($findPersonTpyePending); 
$findRowTpyePendingData = mysqli_fetch_assoc($findTpyePendingData);


// ***************************************************************
$My_branch = $findRow['branch'];
$query2= "SELECT branch FROM branches WHERE id ='{$My_branch}' ";
$result2 = $db->runQuery($query2);
$row2 = $result2->fetch_assoc();

$My_directorate = $findRow['division'];
$query3= "SELECT description FROM divisions WHERE id ='{$My_directorate}' ";
$result3 = $db->runQuery($query3);
$row3 = $result3->fetch_assoc();

$My_branch_new = $row2['branch'];
$My_directorate_new = $row3['description'];

$person = array(
    "asma" =>$findRow['asma'],
    "rank" =>$findRow['rank'],
    "specialty" =>$findRow['splty'],
    "last_name" =>$findRow['sname'], 
    "first_name" =>$findRow['fname'],
    "password" =>$findRow['password'],
    "unit" =>$findRow['unit'],
    "directorate" =>$My_directorate_new ,
    "branch" =>$My_branch_new,
    "office" =>$findRow['office'],
    "admin" =>$findRow['admin'],
    "role" =>$findRow['role'],
    "role2" =>$findRow['role2'],
    "dateofbirth" =>$findRow['dateofbirth'],
    "dateofassign" =>$findRow['dateofassign'],
    "dateofrelease" =>$findRow['dateofrelease'],
    "idnumber" =>$findRow['idnumber'],
    "city" =>$findRowData['city'],
    "address" =>$findRowData['address'],
    "pscode" =>$findRowData['pscode'],
    "mphone" =>$findRowData['mphone'],
    "phone1" =>$findRowData['phone1'],
    "phone2" =>$findRowData['phone2'],
    "iphone" =>$findRowData['iphone'],
    "duty1" =>$findRowDuty['duty1'],
    "date1" =>$findRowDuty['date1'],
    "duty2" =>$findRowDuty['duty2'],
    "date2" =>$findRowDuty['date2'],
    "duty3" =>$findRowDuty['duty3'],
    "date3" =>$findRowDuty['date3'],
    "medfolder_yn" =>$findRowMedata['medfolder_yn'], 
    "medfolder_loc" =>$findRowMedata['medfolder_loc'],
    "trfolder_yn" =>$findRowMedata['trfolder_yn'],
    "trfolder_loc" =>$findRowMedata['trfolder_loc'],
    "abm_yn" =>$findRowMedata['abm_yn'],
    "abm_loc" =>$findRowMedata['abm_loc'],
    "tpye" =>$findRowMedata['tpye'],
    "date_start" =>$findRowTpyeData['date_start'],
    "date_pending" =>$findRowTpyePendingData['date_start'],
            
);

echo json_encode($person);

?>