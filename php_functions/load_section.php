<?php

require './db_config/db_connect.php';
ini_set('display_errors', 1);

if (isset($_GET['epistasia'])) {
    //connect to database
    $db = new DbMgmt;

    $c = $_GET['epistasia'];
    $section = '';

    //$r = mysql_query("SELECT `s_id`, `state` FROM state WHERE c_id='$c'");
    $db->runQuery("SET NAMES 'utf8'");
    $r = $db->runQuery("SELECT `s_id`, `section` FROM `section` WHERE `ep_id`='$c'");

    while ($row = mysqli_fetch_assoc($r)) {
        $section .= '<option value="' . $row['s_id'] . '">' . $row['section'] . '</option>';
    }

    if ($section == '') {
        echo '';
    } else {
        echo '<select class="form-control" name="section"><option disabled required="">Τμήμα</option>' . $section . '</select>';
    }
}
?>

