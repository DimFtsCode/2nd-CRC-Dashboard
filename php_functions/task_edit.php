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
    die(header("Location: ../pages/form_edit_task.php"));
} else {
    if (editTask()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem editing Main Task: ");
        $_SESSION['error'][] = "Problem editing Main Task ??!! ";        
        die(header("Location: ../pages/form_edit_task.php"));
    }
}

function editTask() {
    $db = new DbMgmt();
    $user = new User;
    
    $taskid = $db->quote($_POST['taskid']);
        
    $scope = $db->quote($_POST['scope']);
    $subject = $db->quote($_POST['subject']);
            
    $date_start = $db->quote($_POST['date_start']);
    $date_exp = $db->quote($_POST['date_exp']);
        
    $share1 = $db->quote($_POST['share1']);
    $share2 = $db->quote($_POST['share2']);
    $assign1 = $db->quote($_POST['assign1']);
    $assign2 = $db->quote($_POST['assign2']);
    
    $complete = $db->quote($_POST['complete']);
   
    $user_reg = $user->asma;      
    
     $query = "UPDATE taskmain SET scope='$scope', subject='$subject', date_start='$date_start', date_exp='$date_exp', share1='$share1', share2='$share2', assign1='$assign1', assign2='$assign2', complete='$complete', "
         . " user_reg='$user_reg', date_reg=NOW() WHERE taskid='$taskid' ";
                                          
    if ($db->runQuery($query)) {
        error_log("Main Task with ID : {$taskid} has been edited !");
        return true;            
    } else {
        error_log("Main Task with ID : {$taskid}");        
        return false;
    }    
}
?>