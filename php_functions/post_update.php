<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once("functions.inc");

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php"));
}


// validate the title
//if (!preg_match('/^[A-ZΑ-Ω Ϊ]+$/u', $_POST['title'])) {    
//    $_SESSION['error'][] = " TITLE should be only capital letters!!.";
//}

$db = new DbMgmt();

//$_SESSION['MyError'][0] = " You are trying ...."; 

//$subject_id = $ $user_reg = $textArea = $progress = $isReleased = $isEditable = ""; 

$post_id_update = $db->quote($_POST['post_id']);
//$sensor_id_update = 4 ;

$title_update = $db->quote($_POST['title']);
$message_update = $db->quote($_POST['message']);
$link_update = $db->quote($_POST['link']);
$valid_update = $db->quote($_POST['valid']);
$fpath_update = $db->quote($_POST['fpath']);
$user_reg = $user->asma;

//$_SESSION['MyError'][1] ="SID .." . $sensor_id_update;
//$_SESSION['MyError'][2] =$reason_update;
//$_SESSION['MyError'][3] =$user_reg;

if (isset($post_id_update)) {          
        $sql_update_post = "UPDATE postnews SET title='$title_update', message='$message_update', link='$link_update', fpath='$fpath_update', valid='$valid_update', asma='$user_reg', indate= NOW() WHERE post_id='$post_id_update'";
        $qry_update_sensor = $db->runQuery($sql_update_post);    
}

header('Location: ../pages/dashboard.php');
?>