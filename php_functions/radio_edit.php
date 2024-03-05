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
    die(header("Location: ../pages/form_edit_sensor.php"));
}

$_SESSION['formAttempt'] = true;
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}


$_SESSION['error'] = array();


// validate the Sensor name
if (!preg_match('!^[A-Z0-9Α-Ω -/]+$!u', $_POST['radio_name'])) {
    $_SESSION['error'][] = "Radio Name must be CAPITAL letters, numbers AND -, / only.";
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_radio.php"));
} else {
    if (editRadio()) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/dashboard.php"));
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem editing RADIO: ");
        $_SESSION['error'][] = "Problem editing RADIO !! ";
        die(header("Location: ../pages/form_edit_radio.php"));
    }
}

function editRadio() {

    $db = new DbMgmt();

    $user = new User;

    $radio_id_update = $db->quote($_POST['radio_id']);
//$sensor_id_update = 76;


    $radio_name_edit = $db->quote($_POST['radio_name']);
    $radio_type_edit = $db->quote($_POST['radio_type']);
    $location = $db->quote($_POST['location']);
    $band = $db->quote($_POST['band']);
    $guard = $db->quote($_POST['guard']);
    $mpa = $db->quote($_POST['mpa']);
    $control = $db->quote($_POST['control']);

//$_SESSION['MyError'][1] = $sensor_id_update;

    $user_reg = $user->asma;


    $sql_update_radio = "UPDATE radio SET radio_name='$radio_name_edit', radio_type='$radio_type_edit', user_reg='$user_reg', date_reg= NOW() "
                        . ", location='$location', band='$band', guard='$guard', mpa='$mpa', control='$control' WHERE radio_id='$radio_id_update' ";  
                  
    


    if ($db->runQuery($sql_update_radio)) {
        error_log(" RADIO has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing RADIO ! ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>