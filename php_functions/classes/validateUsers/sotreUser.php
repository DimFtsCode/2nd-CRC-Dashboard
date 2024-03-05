<?php

/* * ***********************************************************************
 * storeUser.php
 * 
 * Apothikeuei ta stoixeia enos xrhsth ston pinaka personel ths database.
 * Xrhsimopoiei ths metavlites ths formas apo tin selida login.php
 * O xrhsths pernei epishs kai mia metavlith "pending" h opoia prepei
 * argotera o administrator na elexei
 * 
 * ************************************************************************* */
include './userHandlers.class.php';
include '../../db_config/db_connect.php';



$user = new UserHandlers();
$db = new DbMgmt();
$am = $_POST['AM'];
$name = $_POST['name'];
$surname = $db->quote($_POST['surname']);
$rank_id = $_POST['rank_id'];
$ep_id = $_POST['epistasia'];
$s_id = $_POST['section'];
$telephone = $_POST['telephone'];
$address = $_POST['address'];
$city = $_POST['city'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$rePassword = $_POST['reTypePassword'];
$pending = 1;
$role_id = 0;

echo "This is :" . $am . "Name: " . $name . "Surname :" . $surname . $rank_id;

if (isset($_POST['AM']) && ctype_digit($_POST['AM'])) {
    if (isset($_POST['name']) && isset($_POST['surname'])) {
        if (isset($_POST['rank_id'])) {
            // Edw ruthmizw tin metavlith pou tha apothikeutei gia to onoma vathmou stin database ston pinaka personel
            switch ($_POST['rank_id']) {
                case "4" :
                    $rank_name = "Τξχος";
                    break;
                case "5" :
                    $rank_name = "Σμχος";
                    break;
                case "6" :
                    $rank_name = "Ασμχος";
                    break;
                case "7" :
                    $rank_name = "Επσγος";
                    break;
                case "8" :
                    $rank_name = "Σγος";
                    break;
                case "9" :
                    $rank_name = "Υπσγος";
                    break;
                case "10" :
                    $rank_name = "Ανθσγός";
                    break;
                case "11" :
                    $rank_name = "Ανθστης";
                    break;
                case "12" :
                    $rank_name = "Ασμιας";
                    break;
                case "13" :
                    $rank_name = "Εσμιας";
                    break;
                case "14" :
                    $rank_name = "Σμιας";
                    break;
                case "15" :
                    $rank_name = "Υσμιας";
                    break;
                case "16" :
                    $rank_name = "Σμτης";
                    break;
                default :
                    $rank_name = "Please Select Rank";
            } echo $rank_name . $ep_id . $s_id;
            // Ruthmizoume ths times twn keliwn epistasia kai section!!!
            $qry_epistasia = "SELECT name FROM `epistasia` WHERE ep_id=$ep_id ";
            $db->runQuery("SET NAMES 'utf8'");
            $res_epistasias = $db->runQuery($qry_epistasia);
            $epistasia = mysqli_fetch_row($res_epistasias);

            $qry_section = "SELECT section FROM `section` WHERE ep_id=$ep_id AND s_id=$s_id";
            $res_section = $db->runQuery($qry_section);
            $section = mysqli_fetch_row($res_section);
            if (isset($_POST['password']) && isset($_POST['reTypePassword'])) {
                if ($password == $rePassword) {
                    // Register the user in the database
                    $db->runQuery("SET NAMES 'utf8'");
                    $qry_register = "INSERT INTO `personel`(`AM`, `name`, `surname`, `ep_id`, `epistasia`, `s_id`, `section`, `telephone`, `mobile`, `address`, `city`, `password`, `role_id`, `rank_id`, `rank_name`, `pending`) VALUES ('$am', '$name', '$surname', '$ep_id', '$epistasia[0]' , '$s_id', '$section[0]', '$telephone', '$mobile', '$address', '$city', '$password', $role_id, '$rank_id', '$rank_name', '$pending')";
                    $db->runQuery($qry_register);
                    header("location: ../../../pages/registerOK.html");
                    echo "Exei ginei register tou user";
                } else {
                    echo "Your password does not match... Den einai idios o kwdikos sou";
                }
            } else {
                echo "Type a password";
            }
        }
    } else {
        echo 'Symplirwse ta stoixeia sou';
    }
} else {
    echo "Insert a valid Arithmo Mhtrwou. like 67045";
}
?>
