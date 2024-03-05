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
    die(header("Location: ../pages/form_edit_air_static.php"));
}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();


$_SESSION['MyError'] = array();
//$_SESSION['MyError'][0] = " You are here.";
//$_SESSION['MyError'][1] = " Now you have moved  there.";



//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_air_static.php"));
} else {
    if (editStatic()) {
        unset($_SESSION['formAttempt']);        
        //die(header("Location: ../pages/success_op.php"));
        die(header("Location: ../pages/form_view_air_asset.php"));
    } else {
        error_log("Problem editing Air Static Data: ");
        $_SESSION['error'][] = "Problem editing Air Static DATA !! ";
        die(header("Location: ../pages/form_edit_air_static.php"));
    }
}

function editStatic() {

    $db = new DbMgmt();

    $user = new User;

    //$static_id = $db->quote($_POST['static_id']);
    $static_id = 1;
    $gr_ramrod = strtoupper($db->quote($_POST['gr_ramrod']));
    $nato_ramrod = strtoupper($db->quote($_POST['nato_ramrod']));
    $air_policing = $db->quote($_POST['air_policing']);
    $sunrise = $db->quote($_POST['sunrise']);
    $sunset = $db->quote($_POST['sunset']);
    $gr_remark = strtoupper($db->quote($_POST['gr_remark']));      
    $nato_remark = strtoupper($db->quote($_POST['nato_remark']));
    $delta_remark = strtoupper($db->quote($_POST['delta_remark']));
    
    $user_reg = $user->asma;
       
    $sql_update = "UPDATE airstatic SET gr_ramrod='$gr_ramrod', nato_ramrod='$nato_ramrod', air_policing='$air_policing', gr_remark='$gr_remark' "
           . ", sunrise='$sunrise', sunset='$sunset', nato_remark='$nato_remark', delta_remark='$delta_remark', user_reg='$user_reg', date_reg= NOW() WHERE `airstatic`.`static_id` = 1 ";
          
           
    if ($db->runQuery($sql_update)) {
        error_log(" Air Static Data has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing Air Static Data !???? ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>