<?php

require_once("functions.inc");
require_once ("./db_config/db_connect.php");  

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));    
}


$_SESSION['error'] = array();

die(header("Location: ../docs/me/ops/ΙΕΡΕΙΑ.pdf"));


?>