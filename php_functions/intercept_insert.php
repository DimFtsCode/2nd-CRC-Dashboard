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


function insertIntercept() {
    $db = new DbMgmt();
    $user = new User;
    
$user = new User;

$asma = $db->quote($_POST['asma']);
//$callsign = strtoupper($db->quote($_POST['callsign']));
$cotype = $db->quote($_POST['cotype']);
$mdate = $db->quote($_POST['mdate']);
$stime = $db->quote($_POST['stime']);
$ltime = $db->quote($_POST['ltime']);

$fcs1 = strtoupper($db->quote($_POST['fcs1']));
$numf1 = $db->quote($_POST['numf1']);
$typef1 = $db->quote($_POST['typef1']);
$sq1 = $db->quote($_POST['sq1']);

$fcs2 = strtoupper($db->quote($_POST['fcs2']));
$numf2 = $db->quote($_POST['numf2']);
$typef2 = $db->quote($_POST['typef2']);
$sq2 = $db->quote($_POST['sq2']);

$fcs3 = strtoupper($db->quote($_POST['fcs3']));
$numf3 = $db->quote($_POST['numf3']);
$typef3 = $db->quote($_POST['typef3']);
$sq3 = $db->quote($_POST['sq3']);

$fcs4 = strtoupper($db->quote($_POST['fcs4']));
$numf4 = $db->quote($_POST['numf4']);
$typef4 = $db->quote($_POST['typef4']);
$sq4 = $db->quote($_POST['sq4']);

$extcard = $db->quote($_POST['extcard']);

$area = strtoupper($db->quote($_POST['area']));
$alt = strtoupper($db->quote($_POST['alt']));
$numint = $db->quote($_POST['numint']);
$intype = $db->quote($_POST['intype']);

$numint2 = $db->quote($_POST['numint2']);
$intype2 = $db->quote($_POST['intype2']);

//$freq = $db->quote($_POST['freq']);
$freq = strtoupper($db->quote($_POST['freq']));
//$radio = $db->quote($_POST['radio']);
$radio = strtoupper($db->quote($_POST['radio']));
$post = $db->quote($_POST['post']);
$aj = $db->quote($_POST['aj']);
$ajnet = $db->quote($_POST['ajnet']);
$crypto = $db->quote($_POST['crypto']);
$mids = $db->quote($_POST['mids']);
$comq = $db->quote($_POST['comq']);

$eng = $db->quote($_POST['eng']);
$iff = $db->quote($_POST['iff']);
$reason = strtoupper($db->quote($_POST['reason']));
$reason2 = strtoupper($db->quote($_POST['reason2']));

$remark = $db->quote($_POST['remark']);
 
    
    
$user_reg = $user->asma;
    
    $query = "INSERT INTO `intercept`(`asma`, `cotype`, `mdate`, `stime`, `ltime`, `fcs1`, `numf1`, `typef1`, `sq1`, `fcs2`, `numf2`, `typef2`, `sq2`, `fcs3`, `numf3`, `typef3`, `sq3`, `fcs4`, `numf4`, `typef4`, `sq4`, `extcard`, `area`, `alt`, `numint`, `intype`, `numint2`, `intype2`, `freq`, `radio`, `post`, `aj`, `ajnet`, `crypto`, `mids`, `comq`, `eng`, `iff`, `reason`, `reason2`, `remark`, `user_reg`, `date_reg`)"
           . " VALUES ('{$asma}','{$cotype}','{$mdate}','{$stime}','{$ltime}','{$fcs1}','{$numf1}','{$typef1}','{$sq1}','{$fcs2}','{$numf2}','{$typef2}','{$sq2}','{$fcs3}','{$numf3}','{$typef3}','{$sq3}','{$fcs4}','{$numf4}','{$typef4}','{$sq4}' "
           . ",'{$extcard}','{$area}','{$alt}','{$numint}','{$intype}','{$numint2}','{$intype2}','{$freq}','{$radio}','{$post}','{$aj}','{$ajnet}','{$crypto}','{$mids}','{$comq}','{$eng}','{$iff}','{$reason}','{$reason2}','{$remark}','{$user_reg}',NOW())";
       
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
    die(header("Location: ../pages/form_add_intercept.php"));
} else {
    if (insertIntercept()) {
        $_SESSION['error'][] = " Interception successfully ADDED !! ";        
        //die(header("Location: ../pages/success_op.php"));  
        die(header("Location: ../pages/form_view_intercept_asma.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new interception: ");
        $_SESSION['error'][] = "Problem inseting new Interception  ??!! ";        
        die(header("Location: ../pages/form_add_intercept.php"));
    }
}

?>




