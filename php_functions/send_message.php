<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './db_config/db_connect.php';

$db = new DbMgmt();
$db->runQuery("SET NAMES 'utf8'");

$to = $db->quote($_POST['to_sender']);
$from = $db->quote($_POST['sender']);
$subject = $db->quote($_POST['subject']);
$text = $db->quote($_POST['text']);

if ($to == "all") {
    $sql_to_all = $sql = "SELECT `AM` FROM `personel`";
    $qry_to_all = $db->runQuery($sql_to_all);
    while ($row_to_all = mysqli_fetch_array($qry_to_all)) {
        $to = $row_to_all['AM'];
        $sql = "INSERT INTO `hrm`.`messages` (`id`, `from`, `to`, `subject`, `text`) VALUES (NULL, $from, $to, \"$subject\", \"$text\");";
        $qry = $db->runQuery($sql);
    }
}else {
    $sql = "INSERT INTO `hrm`.`messages` (`id`, `from`, `to`, `subject`, `text`) VALUES (NULL, $from, $to, \"$subject\", \"$text\");";
    $qry = $db->runQuery($sql);
    
}

//echo $to . " " . $from . " " . $subject . " " . $text ;
header('Location: ../pages/messages.php');

?>