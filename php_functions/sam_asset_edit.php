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
    die(header("Location: ../pages/form_edit_sam_asset.php"));
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
    die(header("Location: ../pages/form_edit_sam_asset.php"));
} else {
    if (editAsset()) {
        unset($_SESSION['formAttempt']);        
        //die(header("Location: ../pages/success_op.php"));
        die(header("Location: ../pages/form_view_sam_asset.php"));
    } else {
        error_log("Problem editing SAM asset: ");
        $_SESSION['error'][] = "Problem editing SAM asset !! ";
        die(header("Location: ../pages/form_edit_sam_asset.php"));
    }
}

function editAsset() {

    $db = new DbMgmt();

    $user = new User;

    $sam_id = $db->quote($_POST['sam_id']);

    $location = strtoupper($db->quote($_POST['location']));
    $status = $db->quote($_POST['status']);
    $remark = strtoupper($db->quote($_POST['remark']));
    //$gr_remark = strtoupper($db->quote($_POST['gr_remark'])); 
    
    $user_reg = $user->asma;

    $sql_update = "UPDATE samstatus SET location='$location', user_reg='$user_reg', date_reg= NOW() "
            . ",status='$status', remark='$remark' WHERE sam_id='$sam_id' ";

    if ($db->runQuery($sql_update)) {
        error_log(" SAM Asset has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing SAM Asset ! ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>