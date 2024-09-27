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

$_SESSION['error'] = array(); 


function insertSchool() {
    $db = new DbMgmt();
    $user = new User;
    
    $asma = $db->quote($_POST['asma']);
    $hospital = $db->quote($_POST['hospital']);
    $exam_type = $db->quote($_POST['exam_type']);
    $date_start = $db->quote($_POST['date_start']);
    $date_end = $db->quote($_POST['date_end']);
    $aea = $db->quote($_POST['aea']);
    $rmknum = $db->quote($_POST['rmknum']);
    //$remark = $db->quote($_POST['remark']);
    $remark = strtoupper($db->quote($_POST['remark'])); 
    
    
     if ($date_end == null ) {
        $date_end  = "2000-01-01";
    }
    
    $user_reg = $user->asma;

   $query = "INSERT INTO `tpye` (`asma`, `hospital`, `exam_type`, `date_start`,`date_end`, `aea`, `rmknum`, `remark`, `user_reg`, `date_reg`) VALUES ('{$asma}', '{$hospital}', '{$exam_type}', '{$date_start}', '{$date_end}', '{$aea}', '{$rmknum}', '{$remark}', '{$user_reg}',NOW())";
   
       
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = " ΤΠΥΕ successfully Added to the Database !! "; 
        return true;          
    } else {
        $_SESSION['error'][] = " Problem inseting ΤΠΥΕ to the Database !! ";        
        return false;
    }    
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_tpye_asma.php"));
} else {
    if (insertSchool()) {
        $_SESSION['error'][] = " ΤΠΥΕ successfully ADDED !! ";        
        die(header("Location: ../pages/form_view_tpye_user.php"));       
        unset($_SESSION['formAttempt']);
    } else {       
        $_SESSION['error'][] = "Problem inseting ΤΠΥΕ ??!! ";        
        die(header("Location: ../pages/form_add_tpye_asma.php"));
    }
}

?>




