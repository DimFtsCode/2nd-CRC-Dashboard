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


//$message = "hallo world";

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_delete_tdl.php"));
} else {
    if (delTDL()) {
        unset($_SESSION['formAttempt']);       
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem deleting TDL: ");
        $_SESSION['error'][] = "Problem deleting TDL !! ";        
        die(header("Location: ../pages/form_delete_tdl.php"));
    }
}


function delTDL() {

//$myID = $_POST['myID'];    

$myID = $_POST['tdl_id'];

$db = new DbMgmt();

//$_SESSION['MyError'][1] = " Now you have moved  there.";

$query = "DELETE FROM tdl where tdl_id ='{$myID}' ";

                    
 if ($db->runQuery($query)) {
        error_log(" TDL has been Deleted successfully !");
        return true;            
    } else {
        error_log(" Problem on Deleting TDL ! ");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}

?>