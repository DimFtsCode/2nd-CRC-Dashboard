<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include './db_config/db_connect.php';

$db = new DbMgmt();
$db->runQuery("SET NAMES 'utf8'");

//if (!isset($_POST['serial'])) {
//    $hostname = "KENO ";
//    echo "mpike edw";
//}
//if (!isset($_POST['MAC'])) {
//    $mac = "KENO";
//}
//if (!isset($_POST['ipAddrr'])) {
//    $ipAddrr = "KENO";
//}
//if (!isset($_POST['switchport'])) {
//    $switchport = 0;
//}
//
//if ($stick == 'Yes') {
//    $label = 1;
//}else {
//    $label = 0;
//}

$serial = $db->quote($_POST['serial']);
$hostname = $db->quote($_POST['hostname']);
$post = $db->quote($_POST['post']);
$mac = $db->quote($_POST['MAC']);
$ipAddrr = $db->quote($_POST['ipAddrr']);
$switchport = $db->quote($_POST['switchport']);
$patchPanel = $db->quote($_POST['patchpanel']);
$hd = $db->quote($_POST['hd_serial']);
$stick = $db->quote($_POST['label']);
$label= 0;

echo $serial;
echo " ";
echo $hostname;
echo " ";
echo $post;
echo " MAC :";
echo $mac;
echo " IP ADDRESS :";
echo $ipAddrr;
echo " SwitchPORT :";
echo $switchport;
echo " PatchPanel :";
echo $patchPanel;
echo " ";
echo $hd;
echo " ";
echo $stick;
echo " ";
echo $label;

//$sql_add_workstation = "INSERT INTO `hrm`.`mase_ws` (`Serial_Number`, `Host_Name`, `MAC`, `ipAddrr`, `switchport`, `patch_panel_port`, `post`, `hard_disk`, `hasLabel`) VALUES ($serial, $hostname, $mac, $ipAddrr, $switchport, $patchPanel, $post, $hd, $label);";
$sql_add_workstation = "INSERT INTO `mase_ws` (`Serial_Number`, `Host_Name`, `MAC`, `ipAddrr`, `switchport`, `patch_panel_port`, `post`, `hard_disk`, `hasLabel`) VALUES (\"$serial\", \"$hostname\", \"$mac\" , \"$ipAddrr\", $switchport, \"$patchPanel\", \"$post\", \"$hd\", $label);";
$sql_test = "INSERT INTO `mase_ws` (`Serial_number`) VALUES (\"$serial\");";
$db->runQuery($sql_add_workstation);
header('Location: ../pages/mase_workstation.php');

?>