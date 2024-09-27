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
    die(header("Location: ../pages/form_edit_training.php"));
} else {
    if (editTraining()) {
        $_SESSION['error'][] = "Training has successfully edited !! ";            
        die(header("Location: ../pages/form_view_school_asma.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem editing training data: ");
        $_SESSION['error'][] = "Problem editing training data ??!! ";        
        die(header("Location: ../pages/form_edit_training.php")); 
    }
}

function editTraining() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $trnid = $db->quote($_POST['trnid']);
    //$trnid = 1;
    $date_start = $db->quote($_POST['date_start']);
    $date_end = $db->quote($_POST['date_end']);
    //$date_end = "2021-01-05";
    
    $user_reg = $user->asma;
      
     $query = "UPDATE `training` SET `date_start`='$date_start', `date_end`='$date_end', `user_reg`='$user_reg', `date_reg`=NOW() WHERE `trnid`='$trnid' ";
          
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "Training has successfully edited !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "Training has not been edited !!  ?? ";              
        return false;
    }    
}
?>



