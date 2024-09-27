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
    die(header("Location: ../pages/form_delete_secmoto_id.php"));
} else {
    if (editData()) {
        $_SESSION['error'][] = "Data has successfully deleted !! ";            
        die(header("Location: ../pages/success_op.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem deleting data: ");
        $_SESSION['error'][] = "Problem deleting data ??!! ";        
        die(header("Location: ../form_delete_secmoto_id.php")); 
    }
}

function editData() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $mid = $db->quote($_POST['mid']);
    
       
    $user_reg = $user->asma;
    
    $query = "DELETE FROM `secmoto` where `mid` ='{$mid}' ";
      
     //$query = "UPDATE `secmoto` SET `cardno`='$cardno', `expmoto`='$expmoto', `typec`='$typec', `plates`='$plates', `brand`='$brand', `colour`='$colour', `user_reg`='$user_reg', `date_reg`=NOW() WHERE `mid`='$mid' ";
          
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "Sec Data has successfully deleted !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "Sec Data has not been deleted !!  ?? ";              
        return false;
    }    
}
?>