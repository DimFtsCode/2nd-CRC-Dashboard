<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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



function AddRows() {
        
$db = new DbMgmt();

$user = new User;

//$fpos = 2;
//$fpos = $db->quote($_POST['numof']);
$fpos = $db->quote($_POST['numof']);

$description = $fpos . " .. to be determined";



$branch = "ΣΑΦ";

$filepath = "../web/saf/docs/test_file.pdf";

$user_reg = $user->asma;


$query = "INSERT INTO staticfiles (fpos,branch,description,fpath,user_reg,date_reg) VALUES ('{$fpos}','{$branch}','{$description}','{$filepath}', '{$user_reg}',NOW())";          

//$Max = 20;
//
//for ($i=7;Si<$Max;$i++) {
//    $fpos = $i;
//    $query .= "INSERT INTO staticfiles (fpos,branch,description,fpath,user_reg,date_reg) VALUES ('{$fpos}','{$branch}','{$description}','{$filepath}', '{$user_reg}',NOW())";        
//}


    
     if ($db->runQuery($query)) {
        $_SESSION['error'][] = " Data inserted successfully to the Database !! "; 
        error_log("All Records have been inserted !!");
        return true;            
    } else {
        error_log("Problem Inserting new Rows");
        $_SESSION['error'][] = " Problem inseting Records to the Database !! "; 
        // $_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }     
    
}


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) { 
    die(header("Location: ../pages/zx_form_sys.php"));
} else {
    if (AddRows()) {
        $_SESSION['error'][] = "ROWS ADDED SUCCESSFULLY TO TABLE !! "; 
        die(header("Location: ../pages/zx_form_sys.php"));    
        //die(header("Location: ../pages/success_op.php"));
        unset($_SESSION['formAttempt']);   
    } else {
        //error_log("Problem deleting Mission: ");
        $_SESSION['error'][] = "There was problem to Alter the table !! ";     
        die(header("Location: ../pages/zx_form_sys.php"));
    } 
}




?>

