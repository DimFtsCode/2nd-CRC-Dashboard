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

//prevent access if they haven’t submitted the form.
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/form_edit_air_asset.php"));
}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();


$_SESSION['MyError'] = array();
//$_SESSION['MyError'][0] = " You are here.";
//$_SESSION['MyError'][1] = " Now you have moved  there.";

// validate the id IFF1
if (!preg_match('/^[0-9]+$/', $_POST['iff1'])) {    
    $_SESSION['error'][] = "IFF1 must be DIGITS only !!.";
}

// validate the id IFF3
if (!preg_match('/^[0-9]+$/', $_POST['iff3'])) {    
    $_SESSION['error'][] = "IFF1 must be DIGITS only !!.";
}

// validate the callsign
if (!preg_match('/^[A-ZΑ-Ω0-9 -Ϊ]+$/u', $_POST['callsign'])) {    
    $_SESSION['error'][] = "Call Sign should be only capital letters!!.";
}

// validate the TRACK NUMBER
if (isset($_POST['track']) && $_POST['track'] != "") {
if (!preg_match('/^[A-ZΑ-Ω0-9 Ϊ.-]+$/u', $_POST['track'])) {    
    $_SESSION['error'][] = "TRACK NUMBER should be only capital letters!!. and - . ";
}
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_air_asset.php"));
} else {
    if (editAsset()) {
        unset($_SESSION['formAttempt']);        
        //die(header("Location: ../pages/success_op.php"));
        die(header("Location: ../pages/form_view_air_asset.php"));
    } else {
        error_log("Problem editing Air asset: ");
        $_SESSION['error'][] = "Problem editing Air asset !! ";
        die(header("Location: ../pages/form_edit_air_asset.php"));
    }
}

function editAsset() {

    $db = new DbMgmt();

    $user = new User;

    $air_id = $db->quote($_POST['air_id']);

    $base = $db->quote($_POST['base']);
    $squadron = $db->quote($_POST['squadron']);
    $numof = $db->quote($_POST['numof']);
    $aftype = $db->quote($_POST['aftype']);
    //$callsign = $db->quote($_POST['callsign']);
    $callsign = strtoupper($db->quote($_POST['callsign']));
    $iff1 = $db->quote($_POST['iff1']);
    $iff3 = $db->quote($_POST['iff3']);
    $status = $db->quote($_POST['status']);
    $daynight = $db->quote($_POST['daynight']);
    $scope = $db->quote($_POST['scope']);
    $track = $db->quote($_POST['track']);
    $remark = $db->quote($_POST['remark']);
    
    $user_reg = $user->asma;

    $sql_update = "UPDATE airstatus SET base='$base', squadron='$squadron', numof='$numof', aftype='$aftype', callsign='$callsign', user_reg='$user_reg', date_reg= NOW() "
            . ", iff1='$iff1', iff3='$iff3', status='$status', daynight='$daynight', scope='$scope', track='$track', remark='$remark' WHERE air_id='$air_id' ";

    if ($db->runQuery($sql_update)) {
        error_log(" Air Asset has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing Air Asset ! ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>