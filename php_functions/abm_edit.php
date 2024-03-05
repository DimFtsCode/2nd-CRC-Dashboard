<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php")); 
}

//prevent access if they haven’t submitted the form.
//if (!isset($_POST['submit'])) {
//    die(header("Location: ../pages/form_add_personnel.php"));
//}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

// validate the asma
if (!preg_match('/^[0-9]{5}$/', $_POST['asma'])) {    
    $_SESSION['error'][] = "Asma must be 5 DIGITS only !!.";
}



//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_abm_asma.php"));
} else {
    if (editmedata()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_personnel_detail_info.php"));
    } else {
        error_log("Problem editing personnel ABM: ");
        $_SESSION['error'][] = "Problem editing personnel ABM ??!! ";        
        die(header("Location: ../pages/form_edit_abm_asma.php"));
    }
}

function editmedata() {
    $db = new DbMgmt();
    
    $user = new User;

    $asma = $db->quote($_POST['asma']);
             
    $abm_yn = $db->quote($_POST['abm_yn']);
    $abm_loc = strtoupper($db->quote($_POST['abm_loc']));    
 
     $user_reg = $user->asma;       
    
     $query = "UPDATE medata SET abm_yn='$abm_yn', abm_loc='$abm_loc', "
         . "  user_reg='$user_reg', date_reg=NOW() WHERE asma='$asma' ";
                                          
    if ($db->runQuery($query)) {
        error_log("Personnel  ABM data with asma : {$asma} has been edited !");
        return true;            
    } else {
        error_log("Problem editing personnel ABM data with asma : {$asma}");        
        return false;
    }    
}
?>