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

$_SESSION['formAttempt'] = true;  
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) { 
    die(header("Location: ../pages/zx_form_sys.php"));
} else {
    if (delLog()) {
        $_SESSION['error'][] = "TABLE HAS BEEN ALTERED !! "; 
        die(header("Location: ../pages/zx_form_sys.php"));    
        //die(header("Location: ../pages/success_op.php"));
        unset($_SESSION['formAttempt']);   
    } else {
        //error_log("Problem deleting Mission: ");
        $_SESSION['error'][] = "There was problem to Alter the table !! ";     
        die(header("Location: ../pages/zx_form_sys.php"));
    } 
}


function delLog() {

//$myID = $_POST['myID'];    

//$myID = $_POST['log_id'];

$db = new DbMgmt();

//$_SESSION['MyError'][1] = " Now you have moved  there.";

//$query = "DELETE FROM logbook WHERE log_id > 0";
$query = "ALTER TABLE crf AUTO_INCREMENT = 1";

                    
 if ($db->runQuery($query)) {
        $_SESSION['error'][] = "TABLE HAS BEEN ALTERED !! ";
        //error_log("  Log Record has been Deleted successfully !");
        return true;            
    } else {
        $_SESSION['error'][] = "There was problem to Alter the table !! ";
       // error_log(" Problem on Deleting Log Record  ! ");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}

?>

