<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include './db_config/db_connect.php';

$db = new DbMgmt();
$db->runQuery("SET NAMES 'utf8'");

$subject_id = $ $user_reg = $textArea = $progress = $isReleased = $isEditable = ""; 


$subject_id = $db->quote($_POST['subject_id']);
$user_reg = $db->quote($_POST['user_reg']);
$textArea = $db->quote($_POST['updateStatus']);
$progress = $db->quote($_POST['progress']);
$isReleased = $db->quote($_POST['isReleased']);
$isEditable = $db->quote($_POST['isEditable']);

if (isset($subject_id ) && isset($user_reg)) {
    if (isset($textArea)) {
        if (isset($progress)) {
            $sql_update_task_id = "INSERT INTO `tbl_tasks_description`(`date_reg`, `subject_id`, `description_log`, `last_user`) VALUES (NOW(),$subject_id,\"$textArea\",$user_reg)";
            $qry_update_task_id = $db->runQuery($sql_update_task_id);
            if (isset($isReleased) && isset($isEditable)) {
                echo $isEditable . $isReleased . " " . $subject_id;
                $sql_update_task = "UPDATE `hrm`.`tbl_tasks` SET `isRealeased` =$isReleased, `progress` = $progress, `isEditable` = $isEditable WHERE `tbl_tasks`.`subject_id` = $subject_id";
                $qry_update_task = $db->runQuery($sql_update_task);
            }
        }
    }
}

header('Location: ../pages/tasks.php');


?>