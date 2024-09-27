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
    die(header("Location: ../pages/form_edit_tdl.php"));
}

$_SESSION['formAttempt'] = true;
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}


$_SESSION['error'] = array();


// validate the Sensor name
if (!preg_match('!^[A-Z0-9Α-Ω -/]+$!u', $_POST['tdl_name'])) {
    $_SESSION['error'][] = "TDL Name must be CAPITAL letters, numbers AND -, / only.";
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_tdl.php"));
} else {
    if (editTDL()) {
        unset($_SESSION['formAttempt']);       
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem editing TDL: ");
        $_SESSION['error'][] = "Problem editing TDL !! ";
        die(header("Location: ../pages/form_edit_tdl.php"));
    }
}

function editTDL() {

    $db = new DbMgmt();

    $user = new User;

    $tdl_id_update = $db->quote($_POST['tdl_id']);
//$sensor_id_update = 76;


    $tdl_name_edit = $db->quote($_POST['tdl_name']);
    $tdl_type_edit = $db->quote($_POST['tdl_type']);
    $direct = $db->quote($_POST['direct']);

//$_SESSION['MyError'][1] = $sensor_id_update;

    $user_reg = $user->asma;


    $sql_update_tdl = "UPDATE tdl SET tdl_name='$tdl_name_edit', tdl_type='$tdl_type_edit', direct='$direct', user_reg='$user_reg', date_reg= NOW()  WHERE tdl_id='$tdl_id_update'";


    if ($db->runQuery($sql_update_tdl)) {
        error_log(" TDL has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing TDL ! ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>