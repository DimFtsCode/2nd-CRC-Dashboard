<?php
require_once('./db_config/db_connect.php');
session_start(); //Starting Session
//Storing Session
$user_check = $_SESSION['login_user'];
echo $user_check;
//Starting database connection
$db = new DbMgmt();
$sql = "SELECT * FROM `personel` WHERE `AM`=$user_check  LIMIT 0, 30 ";
$res = $db->runQuery($sql);
$row = $res->fetch_array(MYSQLI_ASSOC);
$login_session = $row['AM'];
if (!isset($login_session)) {
    header('Location: ../index.html'); //Redirecting To Login Page
}
?>

