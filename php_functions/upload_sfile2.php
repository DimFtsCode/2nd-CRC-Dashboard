
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

$target_dir = "../web/ake/docs/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



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
//if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
//&& $imageFileType != "gif" ) {
if($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "xls" && $imageFileType != "xlsm" && $imageFileType != "xlsx") {
    $_SESSION['error'][] = "Sorry, only PDF files are allowed.";
    //echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
    $_SESSION['error'][] = "Sorry, your file was not uploaded.";
  //echo "Sorry, your file was not uploaded.";
}


function UpLoadFile() {    
    
$db = new DbMgmt();

$user = new User;

$file_dir = "../web/ake/docs/";

//$file_dir = "../web/me/docs/";

$fplace = $db->quote($_POST['fplace']);

$description = $db->quote($_POST['description']);

$description = $fplace . ". " . $description;

//$fplace = $db->quote($_POST['fplace']);

$division = "ΑΚΕ";

$filepath =$file_dir . htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])) ;

$user_reg = $user->asma;


 $query = "UPDATE staticfiles  SET  description='$description', fpath='$filepath', user_reg='$user_reg', date_reg= NOW() WHERE fpos='$fplace' AND branch ='{$division}' ";
    
     if ($db->runQuery($query)) {
        $_SESSION['error'][] = " File Data updated successfully to the Database !! "; 
        error_log("new file has been uploaded!");
        return true;            
    } else {
        error_log("Problem uploading File");
        $_SESSION['error'][] = " Problem updating File Data to the Database !! "; 
        // $_SESSION['error'][] = "Problem inseting personnel  LAST PART!! "; 
        return false;
    }     
    
}


//final disposition
if (isset($_SESSION['error']) && count($_SESSION['error']) > 0) {
    die(header("Location: ../pages/form_upload_sfile.php"));
} else {
    if (UpLoadFile()) {
       
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $_SESSION['error'][] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";        
        die(header("Location: ../pages/success_op.php"));        
        unset($_SESSION['formAttempt']);
        
    } else {
        error_log("Problem uploading new file: ");
        $_SESSION['error'][] = "Problem uploading new file ??!! ";        
        die(header("Location: ../pages/form_upload_sfile.php"));
    }
}


?>   
    
