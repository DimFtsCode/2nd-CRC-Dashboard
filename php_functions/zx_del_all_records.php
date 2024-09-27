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
         $_SESSION['error'][] = "All RECORDS HAVE BEEN DELEDED !! "; 
        die(header("Location: ../pages/zx_form_sys.php"));
        unset($_SESSION['formAttempt']);       
      //  die(header("Location: ../pages/success_op.php"));
    } else {
        
        $_SESSION['error'][] = "Problem deleting ALL Records !! ";        
        die(header("Location: ../pages/zx_form_sys.php"));
    } 
}


function delLog() {

//$myID = $_POST['myID'];    

//$myID = $_POST['log_id'];

$db = new DbMgmt();

//$_SESSION['MyError'][1] = " Now you have moved  there.";

$query = "DELETE FROM crf WHERE crfid > 0";

                    
 if ($db->runQuery($query)) {
        //error_log("  Log Record has been Deleted successfully !");
        $_SESSION['error'][] = "All Records have been deleted !! "; 
        return true;            
    } else {
        //error_log(" Problem on Deleting Log Record  ! ");
         $_SESSION['error'][] = "Problem deleting ALL Records !!!! "; 
        return false;
    }               
    
}

?>

