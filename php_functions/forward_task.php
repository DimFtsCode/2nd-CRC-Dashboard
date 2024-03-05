<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include './db_config/db_connect.php';

$db = new DbMgmt();
$db->runQuery("SET NAMES 'utf8'");

$task = $db->quote($_POST['task']);
$forwardTo = $db->quote($_POST['user_to_forward']);
$from = $db->quote($_POST['am']);

if (isset($task) && isset($forwardTo)) {
    echo "mpainei";
    $sql_forward_to = "UPDATE `hrm`.`tbl_tasks` SET `Forwarder` ='$forwardTo', `isForwarded` = 1 WHERE `tbl_tasks`.`subject_id` = $task";
    $qry_forward_to = $db->runQuery($sql_forward_to);
    $sql = "INSERT INTO `messages`(`from`, `to`, `subject`, `text`) VALUES (\'admin\',\'$forwardTo\',\'Task Forwarded\',\'Σας προώθησε μία εργασία από τον χρήστη $from\')";
    $qry = $db->runQuery($sql);
}

echo $task;
echo $forwardTo;

header('Location: ../pages/tasks.php');
