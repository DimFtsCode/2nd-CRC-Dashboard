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
    die(header("Location: ../pages/form_edit_sart.php"));
}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();


$_SESSION['MyError'] = array();
//$_SESSION['MyError'][0] = " You are here.";
//$_SESSION['MyError'][1] = " Now you have moved  there.";

// validate the id runway
//if (!preg_match('/^[0-9]+$/', $_POST['runway'])) {    
//    $_SESSION['error'][] = "Runway must be DIGITS only !!.";
//}

// validate the runway
if (!preg_match('/^[A-ZΑ-Ω0-9 -Ϊ]+$/u', $_POST['runway'])) {    
    $_SESSION['error'][] = "Runway should be only capital letters!!.";
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_sart.php"));
} else {
    if (editAsset()) {
        unset($_SESSION['formAttempt']);        
        //die(header("Location: ../pages/success_op.php"));
        die(header("Location: ../pages/form_view_sart.php"));
    } else {
        error_log("Problem editing SART : ");
        $_SESSION['error'][] = "Problem editing SART !! ";
        die(header("Location: ../pages/form_edit_sart.php"));
    }
}

function editAsset() {

    $db = new DbMgmt();

    $user = new User;

    $sart_id = $db->quote($_POST['sart_id']);
    $base = $db->quote($_POST['base']);        
    $weather = $db->quote($_POST['weather']);   
    $status = $db->quote($_POST['status']);
    $runway = $db->quote($_POST['runway']);    
    //$remark = $db->quote($_POST['remark']);
    $remark = strtoupper($db->quote($_POST['remark']));
    
    $user_reg = $user->asma;
    
    //UPDATE `1ake`.`sart` SET `runway` = '08' WHERE `sart`.`sart_id` = 1;
    
    
    //$sql_update = "UPDATE sart SET runway = '26' WHERE sart_id = ;";

    $sql_update = "UPDATE sart SET base='$base', weather='$weather', user_reg='$user_reg', date_reg= NOW() "
            . ", status='$status', runway='$runway', remark='$remark' WHERE sart_id='$sart_id' ";

    if ($db->runQuery($sql_update)) {
        error_log(" SART has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing SART ! ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>