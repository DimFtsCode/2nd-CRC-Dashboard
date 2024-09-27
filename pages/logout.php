<?php

require_once("../php_functions/functions.inc");
$user = new User;
$user->logout();
die(header("Location: login.php"));

?>