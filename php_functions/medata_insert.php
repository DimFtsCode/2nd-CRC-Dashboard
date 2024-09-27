<?php
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


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_medata_asma.php"));
} else {
    if (add_medata()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_personnel_detail_info.php"));
    } else {
        error_log("Problem inseting personnel data: ");
        $_SESSION['error'][] = "Problem inseting personnel data ??!! ";        
        die(header("Location: ../pages/form_add_medata_asma.php"));
    }
}

function add_medata() {
    $db = new DbMgmt();
    
    $user = new User;

    $asma = $db->quote($_POST['asma']);
    
    //check for an existing user
    $findUser = "SELECT asma from medata where asma ='{$asma}' ";
    $findResult = $db->runQuery($findUser);
    $findRow = $findResult->fetch_assoc();
    //$findRow = $db->select($findUser);
    if (isset($findRow['asma']) && $findRow['asma'] != "") {        
        $_SESSION['error'][] = "Personnel with that asma already exists";
        return false;
    }
    
    
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
    
     $query = "INSERT INTO medata (asma,medfolder_yn,medfolder_loc,trfolder_yn,trfolder_loc,abm_yn,abm_loc,tpye,blood,weight,height,vaccin,user_reg,date_reg) "
            . " VALUES ('{$asma}','{$medfolder_yn}','{$medfolder_loc}','{$trfolder_yn}','{$trfolder_loc}','{$abm_yn}','{$abm_loc}','{$tpye}','{$blood}','{$weight}','{$height}','{$vaccin}','{$user_reg}',NOW())";
                                    
            
    if ($db->runQuery($query)) {
        error_log("Personnel with asma : {$asma} has been inserted !");
        return true;            
    } else {
        error_log("Problem inserting personnel with asma : {$asma}");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }    
}
?>

