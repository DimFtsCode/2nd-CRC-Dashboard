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
    die(header("Location: ../pages/form_edit_saminfo.php"));
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
    die(header("Location: ../pages/form_edit_saminfo.php"));
} else {
    if (editAsset()) {
        unset($_SESSION['formAttempt']);        
        //die(header("Location: ../pages/success_op.php"));
        die(header("Location: ../pages/form_view_sam_asset.php"));
    } else {
        error_log("Problem editing SAM Info: ");
        $_SESSION['error'][] = "Problem editing SAM Info !! ";
        die(header("Location: ../pages/form_edit_saminfo.php"));
    }
}

function editAsset() {

    $db = new DbMgmt();

    $user = new User;

    $saminfo_id = 1;

    //$rs1 = strtoupper($db->quote($_POST['rs1']));
    $gen_order = $db->quote($_POST['gen_order']);
    
    $gen_remark = strtoupper($db->quote($_POST['gen_remark']));
    //$gr_remark = strtoupper($db->quote($_POST['gr_remark'])); 
    
    $user_reg = $user->asma;

    $sql_update = "UPDATE saminfo SET gen_order='$gen_order', user_reg='$user_reg', date_reg= NOW() "
            . ",gen_remark='$gen_remark' WHERE saminfo_id='$saminfo_id' ";

    if ($db->runQuery($sql_update)) {
        error_log(" SAM Info has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing SAM Info ! ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>