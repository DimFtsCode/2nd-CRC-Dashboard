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
    die(header("Location: ../pages/form_edit_sam_static.php"));
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
    die(header("Location: ../pages/form_edit_sam_static.php"));
} else {
    if (editAsset()) {
        unset($_SESSION['formAttempt']);        
        //die(header("Location: ../pages/success_op.php"));
        die(header("Location: ../pages/form_view_sam_asset.php"));
    } else {
        error_log("Problem editing SAM static: ");
        $_SESSION['error'][] = "Problem editing SAM static !! ";
        die(header("Location: ../pages/form_edit_sam_static.php"));
    }
}

function editAsset() {

    $db = new DbMgmt();

    $user = new User;

    $static_id = $db->quote($_POST['static_id']);

    //$rs1 = strtoupper($db->quote($_POST['rs1']));
    $rs1 = $db->quote($_POST['rs1']);
    $rs4 = $db->quote($_POST['rs4']);
    $rs4a = $db->quote($_POST['rs4a']);
    $rs5 = $db->quote($_POST['rs5']);
    $rs5a = $db->quote($_POST['rs5a']);
    $rs5b = $db->quote($_POST['rs5b']);
    $rs6 = $db->quote($_POST['rs6']);
    $rs11 = $db->quote($_POST['rs11']);
    $rs12 = $db->quote($_POST['rs12']);
    
    $remark = strtoupper($db->quote($_POST['remark']));
    //$gr_remark = strtoupper($db->quote($_POST['gr_remark'])); 
    
    $user_reg = $user->asma;

    $sql_update = "UPDATE samstatic SET rs1='$rs1', rs4='$rs4', rs4a='$rs4a', user_reg='$user_reg', date_reg= NOW() "
            . ",rs5='$rs5', rs5a='$rs5a', rs5b='$rs5b', rs6='$rs6', rs11='$rs11', rs12='$rs12', remark='$remark' WHERE static_id='$static_id' ";

    if ($db->runQuery($sql_update)) {
        error_log(" SAM Static has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing SAM Static ! ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>