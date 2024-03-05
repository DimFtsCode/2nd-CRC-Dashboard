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
    die(header("Location: ../pages/form_edit_medata_asma.php"));
} else {
    if (editmedata()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_personnel_detail_info.php"));
    } else {
        error_log("Problem editing personnel medata: ");
        $_SESSION['error'][] = "Problem editing personnel medata ??!! ";        
        die(header("Location: ../pages/form_edit_medata_asma.php"));
    }
}

function editmedata() {
    $db = new DbMgmt();
    
    $user = new User;

    $asma = $db->quote($_POST['asma']);
             
    $medfolder_yn = $db->quote($_POST['medfolder_yn']);
    $medfolder_loc = strtoupper($db->quote($_POST['medfolder_loc']));
    $trfolder_yn = $db->quote($_POST['trfolder_yn']);    
    $trfolder_loc = strtoupper($db->quote($_POST['trfolder_loc']));
    $abm_yn = $db->quote($_POST['abm_yn']);
    $abm_loc = strtoupper($db->quote($_POST['abm_loc']));
    $tpye = $db->quote($_POST['tpye']);
    $blood = $db->quote($_POST['blood']);
    $weight = $db->quote($_POST['weight']);
    $height = $db->quote($_POST['height']);
    $vaccin = strtoupper($db->quote($_POST['vaccin']));
 
     $user_reg = $user->asma;       
    
     $query = "UPDATE medata SET medfolder_yn='$medfolder_yn', medfolder_loc='$medfolder_loc', trfolder_yn='$trfolder_yn', trfolder_loc='$trfolder_loc', abm_yn='$abm_yn', abm_loc='$abm_loc', "
         . " tpye='$tpye', blood='$blood', weight='$weight', height='$height', vaccin='$vaccin', user_reg='$user_reg', date_reg=NOW() WHERE asma='$asma' ";
                                          
    if ($db->runQuery($query)) {
        error_log("Personnel  Med data with asma : {$asma} has been edited !");
        return true;            
    } else {
        error_log("Problem editing personnel Med data with asma : {$asma}");        
        return false;
    }    
}
?>