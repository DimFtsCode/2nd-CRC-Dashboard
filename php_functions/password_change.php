<?php
require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: login.php"));    
}

//prevent access if they haven’t submitted the form.
//if (!isset($_POST['submit'])) {
//    die(header("Location: ../pages/form_add_personnel.php"));
//}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array(); 


$_SESSION['MyError'] = array();
////$Myarray = array("MyLog");
//$_SESSION['MyError'][0] = " You are here.";
////$_SESSION['MyError'][1] = " Now you have moved  there.";


// validate the asma
//if (!preg_match('/^[\w .]+$/', $_POST['asma'])) {
if (!preg_match('/^[0-9]{5}$/', $_POST['asma'])) {    
    $_SESSION['error'][] = "Asma must be 5 DIGITS only !!.";
}

// validate the id number
if (!preg_match('/^[0-9]+$/', $_POST['idnumber'])) {    
    $_SESSION['error'][] = "ID number must be DIGITS only !!.";
}

////////////////////////////////////////////////////////////////////////////////

$myIDnumber = $_POST['idnumber'];

$db1 = new DbMgmt();
$myAsma = $_POST['asma'];

$findPerson = "SELECT * FROM personnel WHERE asma ='{$myAsma}' ";
$findResult = $db1->runQuery($findPerson); 

$findRow = mysqli_fetch_array($findResult);

$userID = $findRow['idnumber'];

if (!($myIDnumber == $userID )  ) {
    $_SESSION['error'][] = "The ID number that you typed was WRONG !!."; 
}


////////////////////////////////////////////////////////////////////////////////

// validate the password
if (strlen($_POST['password']) < 7 ) {
    $_SESSION['error'][] = "Password length should be at least 7 characters!!.";
}

if (!($_POST['password'] == $_POST['password2'] )  ) {
   $_SESSION['error'][] = "Passwords DO NOT match!!."; 
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/change_passwd.php"));
} else {
    if (editUser()) {
        unset($_SESSION['formAttempt']);
        $user->logout();
        die(header("Location: ../pages/success_reset_passwd.php"));
        //die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem changing password: ");
        $_SESSION['error'][] = "Problem changing password ??!! ";        
        die(header("Location: ../pages/change_passwd.php"));
    }
}

function editUser() {
    $db = new DbMgmt();

    $asma = $db->quote($_POST['asma']);
             
    
    $password = $db->quote($_POST['password']);
    //$password2 = $db->quote($_POST['password2']);
     
    //$idnumber = $db->quote($_POST['idnumber']);
    
        
     $query = "UPDATE personnel SET password='$password' WHERE asma='$asma' ";                              
            
    if ($db->runQuery($query)) {
        error_log("Your Password has been changed !");
        return true;            
    } else {
        error_log("Problem changing your password !!");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }    
}
?>