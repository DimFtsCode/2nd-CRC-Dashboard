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


function insertEvent() {
    $db = new DbMgmt();
    $user = new User;
    
    //$MyLink = "file://///11.52.1.129/files/";
    $scope = $db->quote($_POST['scope']);
    $type = $db->quote($_POST['type']);
    //$descript = strtoupper($db->quote($_POST['descript']));
    $descript = $db->quote($_POST['descript']);
        
    $date_start = $db->quote($_POST['date_start']);
    $date_end = $db->quote($_POST['date_end']);
    
    //$link = $MyLink . $db->quote($_POST['link']);
    
    //if (strlen($db->quote($_POST['link'])) > 1) {
    //    $link = $MyLink . $db->quote($_POST['link']);
    //} else {
        $link = $db->quote($_POST['link']);
   //}
   
    $user_reg = $user->asma;

   $query = "INSERT INTO major (`scope`, `type`, `descript`, `date_start`, `date_end`, `link`, `user_reg`, `date_reg`) VALUES ('{$scope}', '{$type}', '{$descript}', '{$date_start}', '{$date_end}', '{$link}', '{$user_reg}',NOW())";
       
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = " Event successfully Added to the Database !! "; 
        return true;          
    } else {
        $_SESSION['error'][] = " Problem inseting Event to the Database !! ";        
        return false;
    }    
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_major.php"));
} else {
    if (insertEvent()) {
        $_SESSION['error'][] = " Event successfully ADDED !! ";        
        die(header("Location: ../pages/form_view_major_sum2.php"));        
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new Event: ");
        $_SESSION['error'][] = "Problem inseting new Event ??!! ";        
        die(header("Location: ../pages/form_add_major.php"));
    }
}

?>




