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
    die(header("Location: ../pages/form_edit_event.php"));
} else {
    if (editEvent()) {
        $_SESSION['error'][] = "Event has successfully edited !! ";            
        die(header("Location: ../pages/success_op.php"));
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem editing event data: ");
        $_SESSION['error'][] = "Problem editing event data ??!! ";        
        die(header("Location: ../pages/form_edit_event.php")); 
    }
}

function editEvent() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $evid = $db->quote($_POST['evid']);
    $asma = $db->quote($_POST['asma']);
    $type = $db->quote($_POST['type']);
    $descript = strtoupper($db->quote($_POST['descript'])); 
      
    $date_start = $db->quote($_POST['date_start']);
    $date_end = $db->quote($_POST['date_end']);
    
    $doc = strtoupper($db->quote($_POST['doc']));
       
    $user_reg = $user->asma;
      
     $query = "UPDATE `event` SET `type`='$type', `descript`='$descript', `date_start`='$date_start', `date_end`='$date_end', `doc`='$doc', `user_reg`='$user_reg', `date_reg`=NOW() WHERE `evid`='$evid' ";
          
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "Event has successfully edited !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "Event has not been edited !!  ?? ";              
        return false;
    }    
}
?>



