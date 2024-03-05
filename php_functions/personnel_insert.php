<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php"));
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


// validate the last name
if (!preg_match('/^[A-ZΑ-Ω Ϊ]+$/u', $_POST['last_name'])) {    
    $_SESSION['error'][] = "Last Name should be only capital letters!!.";
}

// validate the password
if (strlen($_POST['password']) < 5 ) {
    $_SESSION['error'][] = "Password  should be SET!!.";
}

// validate the OFFICE
//if (isset($_POST['office']) && $_POST['office'] != "") {
//if (!preg_match('/^[A-ZΑ-Ω Ϊ.-]+$/u', $_POST['office'])) {    
//    $_SESSION['error'][] = "OFFICE should be only capital letters!!. and - . ";
//}
//}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_personnel.php"));
} else {
    if (registerUser()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem inseting personnel: ");
        $_SESSION['error'][] = "Problem inseting personnel ??!! ";        
        die(header("Location: ../pages/form_add_personnel.php"));
    }
}

function registerUser() {
    $db = new DbMgmt();
    $user = new User;

    $asma = $db->quote($_POST['asma']);
    
    //check for an existing user
    $findUser = "SELECT asma from personnel where asma ='{$asma}' ";
    $findResult = $db->runQuery($findUser);
    $findRow = $findResult->fetch_assoc();
    //$findRow = $db->select($findUser);
    if (isset($findRow['asma']) && $findRow['asma'] != "") {        
        $_SESSION['error'][] = "Personnel with that asma already exists";
        return false;
    }
        
    $rank = $db->quote($_POST['rank']);
    $specialty = $db->quote($_POST['specialty']);
    $last_name = $db->quote($_POST['last_name']);
    $first_name = $db->quote($_POST['first_name']);
    $password = $db->quote($_POST['password']);
    $unit = $db->quote($_POST['unit']);
    $directorate = $db->quote($_POST['directorate']);
    $branch = $db->quote($_POST['branch']);
    $office = $db->quote($_POST['office']);
    $admin = $db->quote($_POST['admin']);
    
    $idnumber = $db->quote($_POST['idnumber']);
    
//    if (isset($_POST['id_number'])) {
//        $id_number = $db->quote($_POST['id_number']);
//        ;
//    } else {
//        $id_number = NULL;
//    }

    $dateofbirth = $db->quote($_POST['dateofbirth']);
    $dateofassign = $db->quote($_POST['dateofassign']);
    $dateofrelease = $db->quote($_POST['dateofrelease']);
    $role = $db->quote($_POST['role']);
    $role2 = $db->quote($_POST['role2']);
    $role3 = $db->quote($_POST['role3']);
    
    $user_reg = $user->asma;

//    $query = "INSERT INTO personnel (asma,rank,splty,sname,fname,password,unit,division,branch,office,idnumber,dateofbirth,dateofassign,admin,role,role2) "
//            . " VALUES ('{$asma}','{$rank}','{$specialty}','{$last_name}','{$first_name}','{$password}','{$unit}','{$directorate}'"
//            . ",'{$branch}','{$office}','{$id_number}','{$dateofbirth}','{$dateofassign}','{$admin}','{$role}','{$role2}')";

    
     $query = "INSERT INTO personnel (asma,rank,splty,sname,fname,password,unit,division,branch,office,dateofbirth,dateofassign,dateofrelease,admin,role,role2,role3,idnumber,user_reg,date_reg) "
            . " VALUES ('{$asma}','{$rank}','{$specialty}','{$last_name}','{$first_name}','{$password}','{$unit}','{$directorate}','{$branch}'"
            . ",'{$office}','{$dateofbirth}','{$dateofassign}','{$dateofrelease}','{$admin}','{$role}','{$role2}','{$role3}','{$idnumber}','{$user_reg}',NOW())";
        
            
            
            
    if ($db->runQuery($query)) {
        error_log("Personnel with asma : {$asma} has been inserted !");
        return true;            
    } else {
        error_log("Problem inserting personnel with asma : {$asma}");
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }    
}
?>