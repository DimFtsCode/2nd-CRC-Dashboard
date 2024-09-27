<?php

include './db_config/db_connect.php';
include './classes/validateUsers/userHandlers.class.php';
session_start(); //starting a session
global $_error; //Variable to store Error Message

if (isset($_POST['submit'])) {
    if (empty($_POST['am']) || empty($_POST['password'])) {
        $_error = "AM or Password is empty";
    } else {
        //Define $AM and $password
        //$user = new UserHandlers();
        $db = new DbMgmt();
        $usr = $db->quote($_POST['am']);
        $pswd = $db->quote($_POST['password']);
        //$usr = "67045";
        //$pswd = "1234";
        $sql = "SELECT * FROM `personel` WHERE `AM`=$usr AND `password`=$pswd LIMIT 0, 30 ";

        $result = $db->runQuery($sql);
        echo "<br> Eftase edw k eskase";
        //echo $result;

        if (mysqli_fetch_array($result) > 0) {
            //echo "mpaie";
            //echo "MPIKE to gamimeno";
            $db->runQuery("SET NAMES 'utf8'");
            $pendingQry = "SELECT `pending` FROM `personel` WHERE `AM`=$usr  LIMIT 0, 30 ";
            $pendingResult = $db->runQuery($pendingQry);
            $pendingRow = mysqli_fetch_row($pendingResult);
            if ($pendingRow[0] != 0) {
                header("location: ../pages/registerPnd.html");
            } else {
                $sessionQry = "SELECT `rank_name`, `surname` , `AM` , `post_id` FROM `personel` WHERE `AM`=$usr";
                $res = $db->runQuery($sessionQry);
                $row = mysqli_fetch_row($res);
                $_SESSION['login_user'] = $row; //Initializing Session
                $login_session = $_SESSION['login_user'];
                header("Location: ../pages/dashboard.php"); //Redirecting to onether page
            }
        } else {
            $_error = "AM or Password is invalid ";
        }
        $db->close();
    }
} else {
    echo "Huston we have problem";
}


//$am = $dba ->quote($_POST['am']);
//$password =  $dba ->quote($_POST['password']);
?>

