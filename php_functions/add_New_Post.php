<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once("../php_functions/functions.inc");
include './db_config/db_connect.php';

$db = new DbMgmt();
//$db->runQuery("SET NAMES 'utf8'");

//$poster = $db->quote($_POST['user_reg']);
//$poster = $user->asma;
$poster = 18889;
//$title = $db->quote($_POST['title']);
$title = "RTO test";
//$message = $db->quote($_POST['message']);
$message = "rto 123";
$valid = 1;

echo $poster . $title . $message . $valid ;
$sql_add_post = "INSERT INTO `postnews`(`indate`, `title`, `message`, `asma`, `valid`) VALUES (NOW(), \"$title\", \"$message\", $poster, $valid)";
$sql_create_post = $db->runQuery($sql_add_post) or die("Could not connect");
header('Location: ../pages/admin_dashboard.php');


?>