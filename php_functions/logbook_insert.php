<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php"); 

$user = new User;
if (!$user->isLoggedIn) { 
    die(header("Location: ../pages/login.php"));
} 

//prevent access if they haven’t submitted the form.
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/form_add_logbook.php"));
}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();


$_SESSION['MyError'] = array();
//$Myarray = array("MyLog");
//$_SESSION['MyError'][0] = " You are here.";
//$_SESSION['MyError'][1] = " Now you have moved  there.";


// validate the id IFF3
//if (!preg_match('/^[0-9]+$/', $_POST['iff3'])) {    
//    $_SESSION['error'][] = "IFF1 must be DIGITS only !!.";
//}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_logbook.php"));
} else {
    if (addLog()) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/dashboard.php"));
        die(header("Location: ../pages/form_view_logbook.php"));
    } else {
        error_log("Problem inseting log record: ");
        $_SESSION['error'][] = "Problem inseting new log record !! ";            
        die(header("Location: ../pages/form_add_logbook.php"));
    }
}

function addLog() {

$db = new DbMgmt();

$user = new User;

$description = strtoupper($db->quote($_POST['description']));
//$description = "TEST";
$mdate = $db->quote($_POST['mdate']);
$mtime = $db->quote($_POST['mtime']);
$load = $db->quote($_POST['load']);
$remark = strtoupper($db->quote($_POST['remark']));

$user_reg = $user->asma;

//$_SESSION['MyError'][1] = " Now you have moved  there.";

//$query = "INSERT INTO logbook (description,mdate,mtime,load,remark,user_reg,date_reg) "
//            . " VALUES ('{$description}','{$mdate}','{$mtime}','{$load}','{$remark}','{$user_reg}',NOW())";
            
            $query = "INSERT INTO logbook ( `description`, `mdate`, `mtime`, `load`, `remark`, `user_reg`, `date_reg`) "
                    . "VALUES ('{$description}', '{$mdate}', '{$mtime}', '{$load}', '{$remark}', '{$user_reg}',NOW())";
            
                        
 if ($db->runQuery($query)) {
        error_log(" Log has been added successfully !");
        return true;            
    } else {
        error_log(" Problem on adding new log record  ! ");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}
?>