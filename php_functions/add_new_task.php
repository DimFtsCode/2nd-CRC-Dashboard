<?php

/*
 * 
 * Title : add_new_task.php
 * 
 * Prosthetei stin database ston pinaka tbl_tasks kai
 * tbl_description 
 */


include './db_config/db_connect.php';

$db = new DbMgmt();
$db->runQuery("SET NAMES 'utf8'");

$subject = $db->quote($_POST['subject']);
$user_id = $db->quote($_POST['user_id']);
$user_reg = $db->quote($_POST['user_reg']);
$user_reg_post_id = $db->quote($_POST['post_id']);
$start_date = $db->quote($_POST['init_date']);
$end_date = $db->quote($_POST['end_date']);
$description = $db->quote($_POST['description']);
$epistasia = $db->quote($_POST['epistasia']);
$section = $db->quote($_POST['section']);
$is_assigned = 0;
$is_released = 0;
$is_editable = 0;
$progress = 0;
$isCompleted = 0;

echo $subject . " ";
echo $user_id . " ";
echo $user_reg . " ";
echo $start_date . " ";
echo $end_date . " ";
echo $description . " ";

$sql_last_subj_id = "SELECT `subject_id` FROM `tbl_tasks` ORDER BY `subject_id` DESC LIMIT 1";
$qry_last_subject_id = $db->runQuery($sql_last_subj_id);
if (mysqli_num_rows($qry_last_subject_id) == 0) {
    $subject_id = 101;
} else {
    $subj_id = mysqli_fetch_row($qry_last_subject_id);
    $subject_id = $subj_id[0] + 1;
}
//echo $subj_id[0];
//echo $subject_id;
if ($user_reg == $user_id) {
    $sql_create_task = "INSERT INTO `tbl_tasks`(`subject`, `subject_id`, `description`,  `init_date`, `exp_date`, `user_reg`, `user_id`, `isAssigned`, `isRealeased`, `isEditable`, `progress`, `isCompleted`, `ep_id`, `s_id`) VALUES (\"$subject\", $subject_id, \"$description\", '$start_date', '$end_date', $user_reg, $user_id, $is_assigned, $is_released, $is_editable, $progress, $isCompleted, $epistasia, $section) ";
    $qry_create_task = $db->runQuery($sql_create_task);
    $sql_create_descr = "INSERT INTO `tbl_tasks_description` (`date_reg`, `subject_id`, `description_log`, `last_user`) VALUES (CURDATE(), $subject_id, \"$description\", $user_id)";
    $qry_create_descr = $db->runQuery($sql_create_descr);
} else {

    switch ($user_reg_post_id) {

        case 11 :
            $heritance_details = "SELECT `ep_id` FROM `personel` WHERE `AM`=$user_id";
            $qry_heritance_details = $db->runQuery($heritance_details);
            while ($row_heritance_details = mysqli_fetch_array($qry_heritance_details)) {
                $epistasia = $row_heritance_details['ep_id'];
            }
            $sql_create_task = "INSERT INTO `tbl_tasks`(`subject`, `subject_id`, `description`,  `init_date`, `exp_date`, `user_reg`, `user_id`, `isAssigned`, `isRealeased`, `isEditable`, `progress`, `isCompleted`, `ep_id`) VALUES (\"$subject\", $subject_id, \"$description\", '$start_date', '$end_date', $user_reg, $user_id, $is_assigned, $is_released, $is_editable, $progress, $isCompleted, $epistasia) ";
            $qry_create_task = $db->runQuery($sql_create_task);
            $sql_create_descr = "INSERT INTO `tbl_tasks_description` (`date_reg`, `subject_id`, `description_log`, `last_user`) VALUES (CURDATE(), $subject_id, \"$description\", $user_id)";
            $qry_create_descr = $db->runQuery($sql_create_descr);
            break;
        case 12 :
            $heritance_details = "SELECT `ep_id`, `s_id` FROM `personel` WHERE `AM`=$user_id";
            $qry_heritance_details = $db->runQuery($heritance_details);
            while ($row_heritance_details = mysqli_fetch_array($qry_heritance_details)) {
                $epistasia = $row_heritance_details['ep_id'];
                $section = $row_heritance_details['s_id'];
                
            }
            $sql_create_task = "INSERT INTO `tbl_tasks`(`subject`, `subject_id`, `description`,  `init_date`, `exp_date`, `user_reg`, `user_id`, `isAssigned`, `isRealeased`, `isEditable`, `progress`, `isCompleted`, `ep_id`, `s_id`) VALUES (\"$subject\", $subject_id, \"$description\", '$start_date', '$end_date', $user_reg, $user_id, $is_assigned, $is_released, $is_editable, $progress, $isCompleted, $epistasia, $section) ";
            $qry_create_task = $db->runQuery($sql_create_task);
            $sql_create_descr = "INSERT INTO `tbl_tasks_description` (`date_reg`, `subject_id`, `description_log`, `last_user`) VALUES (CURDATE(), $subject_id, \"$description\", $user_id)";
            $qry_create_descr = $db->runQuery($sql_create_descr);
            break;
        case 13 :
            $sql_create_task = "INSERT INTO `tbl_tasks`(`subject`, `subject_id`, `description`,  `init_date`, `exp_date`, `user_reg`, `user_id`, `isAssigned`, `isRealeased`, `isEditable`, `progress`, `isCompleted`, `ep_id`, `s_id`) VALUES (\"$subject\", $subject_id, \"$description\", '$start_date', '$end_date', $user_reg, $user_id, $is_assigned, $is_released, $is_editable, $progress, $isCompleted, $epistasia, $section) ";
            $qry_create_task = $db->runQuery($sql_create_task);
            $sql_create_descr = "INSERT INTO `tbl_tasks_description` (`date_reg`, `subject_id`, `description_log`, `last_user`) VALUES (CURDATE(), $subject_id, \"$description\", $user_id)";
            $qry_create_descr = $db->runQuery($sql_create_descr);
            break;
            
    }
}



//$sql_create_task = "INSERT INTO `tbl_tasks`(`subject`, `subject_id`, `description`,  `init_date`, `exp_date`, `user_reg`, `user_id`, `isAssigned`, `isRealeased`, `isEditable`, `progress`, `isCompleted`, `ep_id`, `s_id`) VALUES (\"$subject\", $subject_id, \"$description\", '$start_date', '$end_date', $user_reg, $user_id, $is_assigned, $is_released, $is_editable, $progress, $isCompleted, $epistasia, $section) ";
//$qry_create_task = $db->runQuery($sql_create_task);
//$sql_create_descr = "INSERT INTO `tbl_tasks_description` (`date_reg`, `subject_id`, `description_log`, `last_user`) VALUES (CURDATE(), $subject_id, \"$description\", $user_id)";
//$qry_create_descr = $db->runQuery($sql_create_descr);



sleep('3');
header('Location: ../pages/tasks.php');
?>

