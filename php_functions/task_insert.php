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


function insertTask() {
    $db = new DbMgmt();
    $user = new User;
        
    $scope = $db->quote($_POST['scope']);
    $subject = $db->quote($_POST['subject']);
        
    $date_start = $db->quote($_POST['date_start']);
    $date_exp = $db->quote($_POST['date_exp']);
           
    $share1 = $db->quote($_POST['share1']);
    $share2 = $db->quote($_POST['share2']);
   
    $assign1 = $db->quote($_POST['assign1']);
    $assign2 = $db->quote($_POST['assign2']);
    
    $complete = $db->quote($_POST['complete']);
    $owner = $user->asma;
    $user_reg = $user->asma;

   $query = "INSERT INTO taskmain (`scope`, `subject`, `date_start`, `date_exp`, `owner`, `share1`, `share2`, `assign1`, `assign2`, `complete`, `user_reg`, `date_reg`) VALUES ('{$scope}', '{$subject}', '{$date_start}', '{$date_exp}', '{$owner}', '{$share1}', '{$share2}', '{$assign1}', '{$assign2}', '{$complete}', '{$user_reg}',NOW())";
       
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
    die(header("Location: ../pages/form_add_task.php"));
} else {
    if (insertTask()) {
        $_SESSION['error'][] = " Task successfully ADDED !! ";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new Task: ");
        $_SESSION['error'][] = "Problem inseting new Event ??!! ";        
        die(header("Location: ../pages/form_add_task.php"));
    }
}

?>




