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
    die(header("Location: ../pages/form_edit_job.php"));
} else {
    if (editJob()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_view_job_detail.php"));
    } else {
        error_log("Problem editing Job: ");
        $_SESSION['error'][] = "Problem editing Job ??!! ";        
        die(header("Location: ../pages/form_edit_job.php"));
    }
}

function editJob() {
    $db = new DbMgmt();
    $user = new User;
    
    $taskid = $db->quote($_POST['myTask']);
    $jobid = $db->quote($_POST['jobid']);
        
    $description = $db->quote($_POST['description']);
    $link = $db->quote($_POST['link']);
    $date_init = $db->quote($_POST['date_init']);
            
    $user_reg = $user->asma;      
    
     $query = "UPDATE taskjob SET description='$description', date_init='$date_init', link='$link', "
         . " user_reg='$user_reg', date_reg=NOW() WHERE jobid='$jobid' ";
                                          
    if ($db->runQuery($query)) {
        error_log("Job with ID : {$jobid} has been edited !");
        return true;            
    } else {
        error_log("Job with ID : {$jobid}");        
        return false;
    }    
}
?>