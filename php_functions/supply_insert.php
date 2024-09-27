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


// validate the serial
if (!preg_match('/^[0-9]+$/', $_POST['serial'])) {    
    $_SESSION['error'][] = "A/A serial must be DIGITS only !!.";
}

// validate the COST
if (!preg_match('/^[0-9.]+$/', $_POST['cost'])) {    
    $_SESSION['error'][] = "Cost must be DIGITS only !!.";
}

// validate the FINAL COST
if (strlen($_POST['fcost']) > 1 ) {
if (!preg_match('/^[0-9.]+$/', $_POST['fcost'])) {    
    $_SESSION['error'][] = "Final Cost must be DIGITS only !!.";
}
}

function insertSupply() {
    $db = new DbMgmt();
    $user = new User;
        
    $serial = $db->quote($_POST['serial']);
    $sdate = $db->quote($_POST['sdate']);
    $year = $db->quote($_POST['year']);
    $description = $db->quote($_POST['description']);
    $directorate = $db->quote($_POST['directorate']);
    $branch = $db->quote($_POST['branch']);
    $poc = $db->quote($_POST['poc']);
    $cost = $db->quote($_POST['cost']);
    $budget = $db->quote($_POST['budget']);
        
    $posComa = strpos($budget, ',');
    $posHash = strpos($budget, '#');
    $myInt = (int)$posComa;
    $myInt2 = (int)$posHash;
    $bcode = substr($budget, 0, $myInt);
    $bcode2 = substr($budget, $myInt+1, 18);    
    //$bcode = $db->quote($_POST['bcode']);
    $type_order = $db->quote($_POST['type_order']);
    $order = $db->quote($_POST['order']);
    $link = $db->quote($_POST['link']);
    $funded = $db->quote($_POST['funded']);
    $own_budget = $db->quote($_POST['own_budget']);
    $rdate = $db->quote($_POST['rdate']);
    $ordate = $db->quote($_POST['ordate']);
    $orplace = $db->quote($_POST['orplace']);
    $invoice = $db->quote($_POST['invoice']);
    $fcost = $db->quote($_POST['fcost']);
    $status = $db->quote($_POST['status']);
    $remark = $db->quote($_POST['remark']);   
                       
    $user_reg = $user->asma;

   
         $query = "INSERT INTO `supply`(`serial`, `sdate`, `year`, `description`, `division`, `branch`, `poc`, `cost`, `budget`, `bcode`, `bcode2`, `type_order`, `order`, `link`, `funded`, `own_budget`, `rdate`, `ordate`, `orplace`, `invoice`, `fcost`, `status`, `remark`, `user_reg`, `date_reg`) "
          . " VALUES ('{$serial}','{$sdate}','{$year}','{$description}','{$directorate}','{$branch}','{$poc}','{$cost}','{$budget}','{$bcode}','{$bcode2}','{$type_order}'"
          . ",'{$order}','{$link}','{$funded}','{$own_budget}','{$rdate}','{$ordate}','{$orplace}','{$invoice}','{$fcost}','{$status}','{$remark}','{$user_reg}',NOW())";
           
       
    if ($db->runQuery($query)) {
        $_SESSION['error'][] = " Supply successfully Added to the Database !! "; 
        return true;          
    } else {
        $_SESSION['error'][] = " Problem inseting Supply to the Database !! ";        
        return false;
    }    
}
// 
//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_supply.php"));
} else {
    if (insertSupply()) {
        $_SESSION['error'][] = " Supply successfully ADDED !! ";        
        die(header("Location: ../pages/form_view_supply_main.php"));        
        unset($_SESSION['formAttempt']);
    } else {
        error_log("Problem inseting new Supply: ");
        $_SESSION['error'][] = "Problem inseting new Supply ??!! ";        
        die(header("Location: ../pages/form_add_supply.php"));
    }
}

?>




