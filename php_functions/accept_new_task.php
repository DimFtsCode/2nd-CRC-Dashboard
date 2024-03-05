<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include './db_config/db_connect.php';

$db = new DbMgmt();

$accept = $_POST['sbj_id'];

$N = count($accept);
for ($i=0; $i < $N; $i++) {
    $sql = "UPDATE `hrm`.`tbl_tasks` SET `isAssigned` = '1' WHERE `tbl_tasks`.`subject_id` = $accept[$i]";
    $db->runQuery($sql);
}

header("Location: ../pages/tasks.php");