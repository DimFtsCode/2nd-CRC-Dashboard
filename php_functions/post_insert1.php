<?php
require_once("functions.inc"); 

require_once ("./db_config/db_connect.php"); 

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../pages/login.php"));
}

//prevent access if they haven’t submitted the form.
if (!isset($_POST['submit'])) {
    die(header("Location: ../pages/form_add_post.php"));
}

$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}

$_SESSION['error'] = array();

$_SESSION['MyError'] = array();





$userDiv = $user->division;

switch($userDiv) {
    case "ΜΕ":
        $target_dir = "../web/me/docs/";
        break;
    case "ΜΥΠ":
        $target_dir = "../web/myp/docs/";
        break;
}


$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  $_SESSION['error'][] = "Sorry, your file is too large."; 
  //echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// ************************************************
// CHECKINGS FOR THE SQL INSERTION 

 //validate the Post name
if (!preg_match('!^[A-Z0-9Α-Ω -/]+$!u', $_POST['title'])) {
    $_SESSION['error'][] = "Title Name must be CAPITAL letters, numbers AND -, / only.";
}


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_post.php"));
} else {
    if (addPost()) {
        unset($_SESSION['formAttempt']);
        //die(header("Location: ../pages/dashboard.php"));
        die(header("Location: ../pages/success_op.php"));
    } else {
        error_log("Problem inseting new Post: ");
        $_SESSION['error'][] = "Problem inseting new Post !! ";        
        die(header("Location: ../pages/form_add_post.php"));
    }
}

function addPost() {

$db = new DbMgmt();

$user = new User;

$title = $db->quote($_POST['title']);
$message = $db->quote($_POST['message']);
$link = $db->quote($_POST['link']);
$user_reg = $user->asma;
$scope =  $user->division;
$valid =1;

//$_SESSION['MyError'][1] = " Now you have moved  there.";

  $query = "INSERT INTO `2ake`.`postnews` (`indate`, `scope`,`title`, `message`, `asma`, `link`,`valid`) VALUES (NOW(), '{$scope}', '{$title}', '{$message}', '{$user_reg}', '{$link}','{$valid}')";
                        
 if ($db->runQuery($query)) {
        error_log(" POST has been added successfully !");
        
        return true;            
    } else {
        error_log(" Problem on adding POST ! ");
        
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}
?>