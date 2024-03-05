<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include './db_config/db_connect.php';

$db = new DbMgmt();
$db->runQuery("SET NAMES 'utf8'");

$subject_id = $db->quote($_POST['subject_id']);
$user_reg = $db->quote($_POST['user_reg']);
$progress = $db->quote($_POST['progress']);
$isReleased = $db->quote($_POST['isReleased']);
$isCompleted = 1;

 $sql_complete_task = "UPDATE `hrm`.`tbl_tasks` SET `isRealeased` =$isReleased, `progress` = $progress, `isCompleted` = $isCompleted, `dateCompleted`=NOW() WHERE `tbl_tasks`.`subject_id` = $subject_id";
 $qry_complete_task = $db->runQuery($sql_complete_task);
 
 header('Location: ../pages/tasks.php');


?>