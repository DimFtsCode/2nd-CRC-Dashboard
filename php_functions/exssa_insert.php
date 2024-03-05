<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php"));
}


$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array(); 


function insertEXssa() {
    $db = new DbMgmt();
    $user = new User;
    
$user = new User;

$asma = $db->quote($_POST['asma']);
//$callsign = strtoupper($db->quote($_POST['callsign']));
$cotype = $db->quote($_POST['cotype']);
$mdate = $db->quote($_POST['mdate']);
$stime = $db->quote($_POST['stime']);
$ltime = $db->quote($_POST['ltime']);

$osunit = strtoupper($db->quote($_POST['osunit']));
$c2unit = $db->quote($_POST['c2unit']);
$mkeap = $db->quote($_POST['mkeap']);
$tdl = $db->quote($_POST['tdl']);

$voicegr = strtoupper($db->quote($_POST['voicegr']));
$voicair = $db->quote($_POST['voicair']);

$freq = strtoupper($db->quote($_POST['freq']));
//$radio = $db->quote($_POST['radio']);
$radio = strtoupper($db->quote($_POST['radio']));
$aj = $db->quote($_POST['aj']);
$ajnet = $db->quote($_POST['ajnet']);

$reason = strtoupper($db->quote($_POST['reason']));
$remark = $db->quote($_POST['remark']);
       
$user_reg = $user->asma;
    
    $query = "INSERT INTO `exssa`(`asma`, `cotype`, `mdate`, `stime`, `ltime`, `osunit`, `c2unit`, `mkeap`, `tdl`, `voicegr`, `voicair`, `freq`, `radio`, `aj`, `ajnet`, `reason`, `remark`, `user_reg`, `date_reg`)"
           . " VALUES ('{$asma}','{$cotype}','{$mdate}','{$stime}','{$ltime}','{$osunit}','{$c2unit}','{$mkeap}','{$tdl}','{$voicegr}','{$voicair}' "
           . ",'{$freq}','{$radio}}','{$aj}','{$ajnet}','{$reason}','{$remark}','{$user_reg}',NOW())";
       
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = " Intercept successfully Added to DB !! "; 
        return true;          
    } else {
        $_SESSION['error'][] = " Problem inseting intercept to DB !! ";        
        return false;
    }    
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_exssa.php"));
} else {
    if (insertEXssa()) {
        $_SESSION['error'][] = " Exer record successfully ADDED !! ";        
        die(header("Location: ../pages/success_op.php"));  
        //die(header("Location: ../pages/form_view_intercept_asma.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new Exer record: ");
        $_SESSION['error'][] = "Problem inseting new Exer record  ??!! ";        
        die(header("Location: ../pages/form_add_exssa.php"));
    }
}

?>




