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
    die(header("Location: ../pages/form_edit_exer_static.php"));
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
    die(header("Location: ../pages/form_edit_exer_static.php"));
} else {
    if (editStatic()) {
        unset($_SESSION['formAttempt']);        
        //die(header("Location: ../pages/success_op.php"));
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem editing Exer Static Data: ");
        $_SESSION['error'][] = "Problem editing Exer Static DATA !! ";
        die(header("Location: ../pages/form_edit_exer_static.php"));
    }
}

function editStatic() {

    $db = new DbMgmt();

    $user = new User;

    //$static_id = $db->quote($_POST['static_id']);
    $static_id = 1;
          
    $exer_info = strtoupper($db->quote($_POST['exer_info']));
    
    
    $user_reg = $user->asma;
       
    $sql_update = "UPDATE exerstatic SET ex_remark='$exer_info', user_reg='$user_reg', date_reg= NOW() WHERE `exerstatic`.`exer_id` = 1 ";           
                     
    if ($db->runQuery($sql_update)) {
        error_log(" Exer Static Data has been edited successfully !");
        return true;
    } else {
        error_log(" Problem on editing Exer Static Data !???? ");
        //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }
}

?>