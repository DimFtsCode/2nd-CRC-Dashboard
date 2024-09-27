
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


//$target_dir = "../uploads/";
$target_dir = "../web/crf/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
//if(isset($_POST["submit"])) {
//  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//  if($check !== false) {
//    echo "File is an image - " . $check["mime"] . ".";
//    $uploadOk = 1;
//  } else {
//     $_SESSION['error'][] = "File is not an image. ";
//    //echo "File is not an image.";
//    $uploadOk = 0;
//  }
//}

// Check if file already exists
if (file_exists($target_file)) {
    //unlink($target_file);
    //$_SESSION['error'][] = "Sorry, file already exists.";
    //echo "Sorry, file already exists.";
  
} else {
    $_SESSION['error'][] = "Sorry, this file does not exist.";
    $uploadOk = 0;
}

// Check file size
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
if($imageFileType != "pdf" ) {
   $_SESSION['error'][] = "Sorry, only PDF files are allowed.";
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
    $_SESSION['error'][] = "Sorry, your file was not uploaded !! .";
  //echo "Sorry, your file was not uploaded.";
}



function ReplaceFile() {
    
//$file_dir = "../uploads/";  
$file_dir = "../web/crf/"; 
$db = new DbMgmt();
$user = new User;
$fileID = $db->quote($_POST['fileID']);

$filepath =$file_dir . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) ;
//$MyFilepath = ;
$user_reg = $user->asma;

$findID = "SELECT * from crfiles where fid ='{$fileID}' ";
    $findResult = $db->runQuery($findID);
    $findRow = $findResult->fetch_assoc();
    if ($findRow['fpath'] != $filepath){
       $_SESSION['error'][] = " The two file paths do not match !! "; 
       return false;
        
    } else {
        $query = "UPDATE crfiles  SET  fpath='$filepath', user_reg='$user_reg', date_reg= NOW() WHERE fid='$fileID' ";           
    
     if ($db->runQuery($query)) {
        error_log("new file has been uploaded!");
        $_SESSION['error'][] = " File Data inserted successfully to the Database !! "; 
        return true;            
    } else {
        error_log("Problem uploading File");
        $_SESSION['error'][] = " Problem inseting File Data to the Database !! "; 
        // $_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }  
    
    }   
}

//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_replace_file.php"));
} else {
    if (ReplaceFile()) {
        unlink($target_file);
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $_SESSION['error'][] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been replaced.";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
        
    } else {
        error_log("Problem replacing new file: ");
        $_SESSION['error'][] = "Problem replacing the file ??!! ";        
        die(header("Location: ../pages/form_replace_file.php"));
    }
}

?>   
    