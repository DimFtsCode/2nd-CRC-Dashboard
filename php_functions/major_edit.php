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
    die(header("Location: ../pages/form_edit_major.php"));
} else {
    if (editmajor()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_view_major_sum2.php"));
    } else {
        error_log("Problem editing Main Event: ");
        $_SESSION['error'][] = "Problem editing Main Event ??!! ";        
        die(header("Location: ../pages/form_edit_major.php"));
    }
}

function editmajor() {
    $db = new DbMgmt();
    $user = new User;
    
    $mjid = $db->quote($_POST['mjid']);
    
    //$MyLink = "file://///11.52.1.129/files/";
    $scope = $db->quote($_POST['scope']);
    $type = $db->quote($_POST['type']);
    
    $descript = $db->quote($_POST['descript']);
        
    $date_start = $db->quote($_POST['date_start']);
    $date_end = $db->quote($_POST['date_end']);
        
    //$link = $db->quote($_POST['link']);
    
    //if (strlen($db->quote($_POST['link'])) > 1) {
    //    $link = $MyLink . $db->quote($_POST['link']);
    //} else {
        $link = $db->quote($_POST['link']);
    //}
   
    $user_reg = $user->asma;      
    
     $query = "UPDATE major SET scope='$scope', type='$type', descript='$descript', date_start='$date_start', date_end='$date_end', link='$link', "
         . " user_reg='$user_reg', date_reg=NOW() WHERE mjid='$mjid' ";
                                          
    if ($db->runQuery($query)) {
        error_log("Main Event with ID : {$mjid} has been edited !");
        return true;            
    } else {
        error_log("Main Event with ID : {$mjid}");        
        return false;
    }    
}
?>