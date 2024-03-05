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

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_edit_task.php"));
} else {
    if (editSupply()) {
        unset($_SESSION['formAttempt']);
        die(header("Location: ../pages/form_view_supply_main.php"));
    } else {
        error_log("Problem editing Supply: ");
        $_SESSION['error'][] = "Problem editing Supply ??!! ";        
        die(header("Location: ../pages/form_edit_supply.php"));
    }
}

function editSupply() {
    $db = new DbMgmt();
    $user = new User;
    
    $supid = $db->quote($_POST['supid']);
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
    
     $query = "UPDATE `supply` SET `serial`='$serial', `sdate`='$sdate', `year`='$year', `description`='$description', `division`='$directorate', `branch`='$branch', `poc`='$poc', `cost`='$cost', `budget`='$budget', `bcode`='$bcode', `bcode2`='$bcode2',"
         . " `type_order`='$type_order', `order`='$order', `link`='$link', `funded`='$funded', `own_budget`='$own_budget', `rdate`='$rdate', `ordate`='$ordate', `orplace`='$orplace', `invoice`='$invoice', `fcost`='$fcost', `status`='$status', `remark`='$remark', user_reg='$user_reg', date_reg=NOW() WHERE `sup_id`='$supid' ";
                                          
    if ($db->runQuery($query)) {
        error_log("Supply with ID : {$supid} has been edited !");
        return true;            
    } else {
        error_log("Supply with ID : {$supid}");        
        return false;
    }    
}
?>