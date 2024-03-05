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

// validate the callsign
if (!preg_match('/^[A-ZΑ-Ω0-9 -Ϊ]+$/u', $_POST['callsign'])) {    
    $_SESSION['error'][] = "Call Sign should be only capital letters!!.";
}


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_resc_asset.php"));
} else {
    if (editAsset()) {
        unset($_SESSION['formAttempt']);        
        //die(header("Location: ../pages/success_op.php"));
        die(header("Location: ../pages/form_view_resc_asset.php"));
    } else {
        error_log("Problem editing RESC asset: ");
        $_SESSION['error'][] = "Problem editing RESC asset !! ";
        die(header("Location: ../pages/form_edit_resc_asset.php"));
    }
}

function editAsset() {

    $db = new DbMgmt();

    $user = new User;

    $resc_id = $db->quote($_POST['resc_id']);
    $airport = $db->quote($_POST['airport']);    
    $numof = $db->quote($_POST['numof']);
    $aftype = $db->quote($_POST['aftype']);
    $callsign = $db->quote($_POST['callsign']);   
    $status = $db->quote($_POST['status']);
    $daynight = $db->quote($_POST['daynight']);    
    //$remark = $db->quote($_POST['remark']);
    $remark = strtoupper($db->quote($_POST['remark']));
    
    $user_reg = $user->asma;

    $sql_update = "UPDATE rescue SET airport='$airport', numof='$numof', aftype='$aftype', callsign='$callsign', user_reg='$user_reg', date_reg= NOW() "
            . ", status='$status', daynight='$daynight', remark='$remark' WHERE resc_id='$resc_id' ";

    if ($db->runQuery($sql_update)) {
        error_log(" RESC Asset has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing RESC Asset ! ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>