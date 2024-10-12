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

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_intercept_asma.php"));
} else {
    if (editIntercept()) {
        $_SESSION['error'][] = "Intercept has successfully updated !! ";            
        die(header("Location: ../pages/form_view_intercept_asma.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem updating interception data: ");
        $_SESSION['error'][] = "Problem editing interception data ??!! ";        
        die(header("Location: ../pages/form_edit_intercept_asma.php")); 
    }
}

function editIntercept() {
    $db = new DbMgmt();
    $user = new User;
    
    $int_id = $db->quote($_POST['int_id']);
    $asma = $db->quote($_POST['asma']);
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
    $freq = strtoupper($db->quote($_POST['freq']));
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
    $debrief = $db->quote($_POST['debrief']);
    $briefing = $db->quote($_POST['briefing']);
    $kio = $db->quote($_POST['kio']);
    $timing = $db->quote($_POST['timing']); // Νέα μεταβλητή timing
    $user_reg = $user->asma;
    
    $query = "UPDATE `intercept` SET 
                `cotype`='$cotype', 
                `mdate`='$mdate', 
                `stime`='$stime', 
                `ltime`='$ltime', 
                `fcs1`='$fcs1', 
                `numf1`='$numf1', 
                `typef1`='$typef1', 
                `sq1`='$sq1', 
                `fcs2`='$fcs2', 
                `numf2`='$numf2', 
                `typef2`='$typef2', 
                `sq2`='$sq2', 
                `fcs3`='$fcs3', 
                `numf3`='$numf3', 
                `typef3`='$typef3', 
                `sq3`='$sq3', 
                `fcs4`='$fcs4', 
                `numf4`='$numf4', 
                `typef4`='$typef4', 
                `sq4`='$sq4',
                `extcard`='$extcard', 
                `area`='$area', 
                `alt`='$alt', 
                `numint`='$numint', 
                `intype`='$intype', 
                `numint2`='$numint2', 
                `intype2`='$intype2', 
                `freq`='$freq', 
                `radio`='$radio', 
                `post`='$post', 
                `aj`='$aj', 
                `ajnet`='$ajnet', 
                `crypto`='$crypto', 
                `mids`='$mids', 
                `comq`='$comq', 
                `eng`='$eng', 
                `iff`='$iff', 
                `reason`='$reason', 
                `reason2`='$reason2', 
                `remark`='$remark', 
                `debrief`='$debrief', 
                `briefing`='$briefing', 
                `kio`='$kio', 
                `timing`='$timing', 
                `user_reg`='$user_reg', 
                `date_reg`=NOW() 
              WHERE `int_id`='$int_id' ";
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "Interception has successfully updated !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "Interception has not been updated !!  ?? ";              
        return false;
    }    
}
?>
