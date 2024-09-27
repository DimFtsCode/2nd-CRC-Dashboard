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
    die(header("Location: ../pages/form_edit_hotline.php"));
}

$_SESSION['formAttempt'] = true;
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}


$_SESSION['error'] = array();


// validate the Sensor name
if (!preg_match('!^[A-Z0-9Α-Ω -/]+$!u', $_POST['line_name'])) {
    $_SESSION['error'][] = "HOTLINE Name must be CAPITAL letters, numbers AND -, / only.";
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_hotline.php"));
} else {
    if (editLINE()) {
        unset($_SESSION['formAttempt']);       
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem editing HOTLINE: ");
        $_SESSION['error'][] = "Problem editing HOTLINE !! ";
        die(header("Location: ../pages/form_edit_hotline.php"));
    }
}

function editLINE() {

    $db = new DbMgmt();

    $user = new User;

    $line_id_update = $db->quote($_POST['line_id']);


    $line_name_edit = $db->quote($_POST['line_name']);
    $line_type_edit = $db->quote($_POST['line_type']);
    

//$_SESSION['MyError'][1] = $sensor_id_update;

    $user_reg = $user->asma;


    $sql_update_line = "UPDATE hotline SET line_name='$line_name_edit', line_type='$line_type_edit', user_reg='$user_reg', date_reg= NOW()  WHERE line_id='$line_id_update'";


    if ($db->runQuery($sql_update_line)) {
        error_log(" HOTLINE has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing HOTLINE ! ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>