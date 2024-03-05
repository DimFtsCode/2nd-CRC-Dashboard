
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

$userDiv = $user->division;

switch($userDiv) {
    case "ΜΕ":
        $target_dir = "../web/me/posts/";
        break;
    case "ΜΥΠ":
        $target_dir = "../web/myp/posts/";
        break;
    case "ΔΕΕ":
        $target_dir = "../web/dee/posts/";
        break;
    case "ΥΔΚΤΗΣ":
        $target_dir = "../web/ydktis/posts/";
        break;
    case "ΕΠΙΤΕΛΕΙΟ":
        $target_dir = "../web/epit/posts/";
        break;
    case "ΔΥΠ":
        $target_dir = "../web/dyp/posts/";
        break;
}

//$target_dir = "../web/myp/posts/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


 //Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
  $_SESSION['error'][] = "Sorry, your file is too large."; 
  //echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// validate the file name
$MyFilename = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
if (!preg_match('/^[A-Za-z0-9._-]+$/u', $MyFilename)) {    
    $_SESSION['error'][] = "File Name should be only in english and digits without space !!." . $MyFilename;
}

// Allow certain file formats
//if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//&& $imageFileType != "gif" ) {
if($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "xls" && $imageFileType != "xlsx") {
    $_SESSION['error'][] = "Sorry, only PDF files are allowed.";
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}


if ($uploadOk == 0) {
    $_SESSION['error'][] = "Sorry, your file was not uploaded.";
  //echo "Sorry, your file was not uploaded.";
}


// ************************************************
// CHECKINGS FOR THE SQL INSERTION 

 //validate the Post name
if (!preg_match('!^[A-Z0-9Α-Ω -/]+$!u', $_POST['title'])) {
    $_SESSION['error'][] = "Title Name must be CAPITAL letters, numbers AND -, / only.";
}


function addPost() {
      
$db = new DbMgmt();

$user = new User;

$userDiv2 = $user->division;

switch($userDiv2) {
    case "ΜΕ":
        $file_dir = "../web/me/posts/";
        break;
    case "ΜΥΠ":
        $file_dir = "../web/myp/posts/";
        break;
    case "ΔΕΕ":
        $file_dir = "../web/dee/posts/";
        break;
    case "ΥΔΚΤΗΣ":
        $file_dir = "../web/ydktis/posts/";
        break;
     case "ΕΠΙΤΕΛΕΙΟ":
        $file_dir = "../web/epit/posts/";
        break;
    case "ΔΥΠ":
        $file_dir = "../web/dyp/posts/";
        break;
}


$title = $db->quote($_POST['title']);
$message = $db->quote($_POST['message']);
$link = $db->quote($_POST['link']);
$user_reg = $user->asma;
$scope =  $user->division;
$valid =1;

$filepath =$file_dir . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) ;

//$_SESSION['MyError'][1] = " Now you have moved  there.";

  $query = "INSERT INTO `2ake`.`postnews` (`indate`, `scope`,`title`, `message`, `asma`, `link`, `fpath`, `valid`) VALUES (NOW(), '{$scope}', '{$title}', '{$message}', '{$user_reg}', '{$link}', '{$filepath}', '{$valid}')";
                        
 if ($db->runQuery($query)) {
        error_log(" POST has been added successfully !");
        
        return true;            
    } else {
        error_log(" Problem on adding POST ! ");
        
         //$_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }               
    
}


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_add_post.php"));
} else {
    if (addPost()) {
       
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $_SESSION['error'][] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
        
    } else {
        error_log("Problem uploading new file: ");
        $_SESSION['error'][] = "Problem uploading new file ??!! ";        
        die(header("Location: ../pages/form_add_post.php"));
    }
}


?>   
    
