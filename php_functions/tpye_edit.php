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
    die(header("Location: ../pages/form_edit_tpye_asma.php"));
} else {
    if (editTpye()) {
        $_SESSION['error'][] = "ΤΠΥΕ has successfully edited !! ";            
        die(header("Location: ../pages/form_view_tpye_user.php"));
        unset($_SESSION['formAttempt']);
    } else {       
        $_SESSION['error'][] = "Problem editing ΤΠΥΕ data ??!! ";        
        die(header("Location: ../pages/form_edit_tpye_asma.php")); 
    }
}

function editTpye() {
    $db = new DbMgmt();
    
    $user = new User;
    
    $tpid = $db->quote($_POST['tpid']);
    $hospital = $db->quote($_POST['hospital']);
    $exam_type = $db->quote($_POST['exam_type']);
    $date_start = $db->quote($_POST['date_start']);
    $date_end = $db->quote($_POST['date_end']);
    $aea = $db->quote($_POST['aea']);
    $rmknum = $db->quote($_POST['rmknum']);
    $remark = strtoupper($db->quote($_POST['remark'])); 
    
    
    if ($date_end == null ) {
        $date_end  = "2000-01-01";
    }
    //$date_end = "2021-01-05";
    
    $user_reg = $user->asma;
      
     $query = "UPDATE `tpye` SET `hospital`='$hospital', `exam_type`='$exam_type', `date_start`='$date_start', `date_end`='$date_end', `aea`='$aea', `rmknum`='$rmknum', `remark`='$remark', `user_reg`='$user_reg', `date_reg`=NOW() WHERE `tpid`='$tpid' ";
          
                                          
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = "ΤΠΥΕ has successfully edited !! ";        
        return true;            
    } else {
        $_SESSION['error'][] = "ΤΠΥΕ has not been edited !!  ?? ";              
        return false;
    }    
}
?>



