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
    die(header("Location: ../pages/form_edit_secmoto_asma.php"));
} else {
    if (editData()) {
        $_SESSION['error'][] = "Data has successfully edited !! ";            
        die(header("Location: ../pages/success_op.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem editing data: ");
        $_SESSION['error'][] = "Problem editing data ??!! ";        
        die(header("Location: ../form_edit_secmoto_asma.php")); 
    }
}

function editData() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $mid = $db->quote($_POST['mid']);
    $cardno = strtoupper($db->quote($_POST['cardno']));    
    $expmoto = $db->quote($_POST['expmoto']);     
    $typec = $db->quote($_POST['typec']);
    $plates = strtoupper($db->quote($_POST['plates']));
    $brand = strtoupper($db->quote($_POST['brand']));
    $colour = strtoupper($db->quote($_POST['colour']));
       
    $user_reg = $user->asma;
      
     $query = "UPDATE `secmoto` SET `cardno`='$cardno', `expmoto`='$expmoto', `typec`='$typec', `plates`='$plates', `brand`='$brand', `colour`='$colour', `user_reg`='$user_reg', `date_reg`=NOW() WHERE `mid`='$mid' ";
          
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "Sec Data has successfully edited !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "Sec Data has not been edited !!  ?? ";              
        return false;
    }    
}
?>



