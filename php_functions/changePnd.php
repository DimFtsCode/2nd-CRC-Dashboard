<?php
/*
 * Author : Gerontopoulos 67045
 * 
 * Title : changePnd.php
 * 
 * To sugekrimeno arxeio voithaei ton administrator
 * na allaxei tous new users status kai na tous dwsei 
 * kai rolo.
 */

include './db_config/db_connect.php';

$db = new DbMgmt();

$newUser = $_POST['pnd_id'];
$role = $_POST['post_id'];

$N = count($newUser);
for ($i=0; $i < $N; $i++) {
    switch ($role[$i]) {
        case 11 :
            $rolename = "Commander";
            break;
        case 12 :
            $rolename = "Director";
            break;
        case 13 :
            $rolename = "Brach";
            break;
        case 14 :
            $rolename = "User";
            break;
        default :
            $rolename = "User";
            
    }
    echo $newUser[$i] . "==" ;
    echo $role[$i];
    echo " " . $rolename;
    $sql = "UPDATE `hrm`.`personel` SET `pending` = '0', `post_id` = $role[$i], `post` = \"$rolename\" WHERE `personel`.`id` = $newUser[$i]";
    $db->runQuery($sql);
    
}
header("Location: ../pages/pendingUsers.php");


?>
