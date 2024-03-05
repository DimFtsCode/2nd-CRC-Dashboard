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


function insertJob() {
    $db = new DbMgmt();
    $user = new User;
        
    $taskid = $db->quote($_POST['taskid']);
    $subject = $db->quote($_POST['subject']);
    
    $description = $db->quote($_POST['description']);
    $link = $db->quote($_POST['link']); 
    $date_init = $db->quote($_POST['date_init']);    
                       
    $user_reg = $user->asma;

   $query = "INSERT INTO taskjob (`taskid`, `description`, `link`, `date_init`, `user_reg`, `date_reg`) VALUES ('{$taskid}', '{$description}', '{$link}', '{$date_init}', '{$user_reg}',NOW())";
       
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = " Task successfully Added to the Database !! "; 
        return true;          
    } else {
        $_SESSION['error'][] = " Problem inseting Task to the Database !! ";        
        return false;
    }    
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_job.php"));
} else {
    if (insertJob()) {
        $_SESSION['error'][] = " Job successfully ADDED !! ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new Job: ");
        $_SESSION['error'][] = "Problem inseting new Job ??!! ";        
        die(header("Location: ../pages/form_add_job.php"));
    }
}

?>




