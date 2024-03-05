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
    die(header("Location: ../pages/form_edit_trfolder_asma.php"));
} else {
    if (editmedata()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_personnel_detail_info.php"));
    } else {
        error_log("Problem editing personnel TRF: ");
        $_SESSION['error'][] = "Problem editing personnel TRF ??!! ";        
        die(header("Location: ../pages/form_edit_trfolder_asma.php"));
    }
}

function editmedata() {
    $db = new DbMgmt();
    
    $user = new User;

    $asma = $db->quote($_POST['asma']);
             
    
    $trfolder_yn = $db->quote($_POST['trfolder_yn']);    
    $trfolder_loc = strtoupper($db->quote($_POST['trfolder_loc']));

 
     $user_reg = $user->asma;       
    
     $query = "UPDATE medata SET trfolder_yn='$trfolder_yn', trfolder_loc='$trfolder_loc', "
         . " user_reg='$user_reg', date_reg=NOW() WHERE asma='$asma' ";
                                          
    if ($db->runQuery($query)) {
        error_log("Personnel  TRF data with asma : {$asma} has been edited !");
        return true;            
    } else {
        error_log("Problem editing personnel TRF data with asma : {$asma}");        
        return false;
    }    
}
?>