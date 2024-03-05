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
    die(header("Location: ../pages/form_delete_training.php"));
} else {
    if (editTraining()) {
        $_SESSION['error'][] = "Training has successfully DELETED !! ";            
        die(header("Location: ../pages/form_view_school_asma.php"));
        unset($_SESSION['formAttempt']);
    } else {        
        $_SESSION['error'][] = "Problem deleting training data ??!! ";        
        die(header("Location: ../pages/form_delete_training.php")); 
    }
}

function editTraining() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $trnid = $db->quote($_POST['trnid']);
      
     //$query = "UPDATE `training` SET `date_start`='$date_start', `date_end`='$date_end', `user_reg`='$user_reg', `date_reg`=NOW() WHERE `trnid`='$trnid' ";
          
    $query = "DELETE FROM `training` WHERE `trnid`='$trnid'";
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "Training has successfully Deleted !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "Training has not been Deleted !!  ?? ";              
        return false;
    }    
}
?>



