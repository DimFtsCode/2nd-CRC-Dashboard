<?php

/*
 * To arxeio auto periexei voithitikes
 * sunartiseis pou xrishmopoiountai mesa
 * sto application.
 * 
 * Author : Gerontopoulos
 * 
 */


include '../db_config/db_connect.php';

// Show the pending Users in an awsome panel
function numPendingUsers() {
    $db = new DbMgmt();
    $sql = "SELECT * FROM `personel` WHERE pending=1";
    $result = $db->runQuery($sql);
    $num = mysqli_num_rows($result);
    printf("%d", $num);
}

// show the New Tasks in an awsome panel
function numNewTasks($am) {
    $db = new DbMgmt();
    $sql = "SELECT * FROM `tbl_tasks` WHERE `user_id`=$am AND `isAssigned`=0";
    $result = $db->runQuery($sql);
    $num = mysqli_num_rows($result);
    printf("%d", $num);
}

function numTasks($am) {
    $db = new DbMgmt();
    $sql = "SELECT * FROM `tbl_tasks` WHERE `user_id`=$am AND `isAssigned`=1";
    $result = $db->runQuery($sql);
    $num = mysqli_num_rows($result);
    printf("%d", $num);
}

function numCompleted($am) {
    $db = new DbMgmt();
    $sql = "SELECT * FROM `tbl_tasks` WHERE `user_id`=$am AND `isCompleted`=1";
    $result = $db->runQuery($sql);
    $num = mysqli_num_rows($result);
    printf("%d", $num);
}

// Drawing a table head
function thead($col1, $col2, $col3, $col4, $col5, $col6) {
    echo "<thead>";
    echo "<tr>";
    echo "<th>";
    echo $col1;
    echo "</th>";
    echo "<th>";
    echo $col2;
    echo "</th>";
    echo "<th>";
    echo $col3;
    echo "</th>";
    echo "<th>";
    echo $col4;
    echo "</th>";
    echo "<th>";
    echo $col5;
    echo "</th>";
    echo "<th>";
    echo $col6;
    echo "</th>";
    echo "</tr>";
}

/*
 * H sugekrimenh function pairnei san metavlites
 * mia Array gia na ektypwsei ta headers toy pinaka
 * kai ena apotelesma apo mysql_query $res
 */

function table($class, $headArray, $res, $id = "") {
    $head = count($headArray);
    if (isset($id)) {
        echo "<table class=\"" . $class . "\" id=\"" . $id . "\">";
    } else {
        echo "<table class=\"" . $class . "\">";
    }
    echo "<thead>";
    echo "<tr>";
    for ($i = 0; $i < $head; $i++) {
        echo "<th>" . $headArray[$i] . "</th>";
    }
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = mysqli_fetch_array($res)) {
        echo "<tr>";
        for ($i = 0; $i < count($row); $i++) {
            echo "<td>";
            echo $row[$i];
            echo "</td>";
            if ($i == (count($row) - 1 )) {
                echo "<td>aaa</td>";
            }
        }

        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

/*
 * Tasks Section
 * 
 * All the code concern tasks is here
 * 
 * 
 */

// Function gia na vriskei tis ta new tasks
function show_new_tasks($am) {
    $class = "table table-striped table-bordered table-hover";
    $headArray = array(0 => "Id", 1 => "Subject", 2 => "From", 3 => "End Date");
    $id = "dataTables-example";

    //Find the unassigned Tasks
    $db = new DbMgmt();
    $sql = "SELECT `subject_id`, `subject` `user_reg`, `exp_date`  FROM `tbl_tasks` WHERE `user_id`=$am AND `isAssigned`=0";
    $qry_new_tasks = $db->runQuery($sql);
    echo "<caption class\"text-center\">New Tasks</caption>";
    table($class, $headArray, $qry_new_tasks, $id);
}

// Sxediazei Progress Bar
function drawProgressBar($progress) {
    $progressBarColor;

    if ($progress < 40) {
        $progressBarColor = "danger";
    } elseif (($progress > 40) && ($progress <= 85)) {
        $progressBarColor = "info";
    } elseif ($progress > 85) {
        $progressBarColor = "success";
    }
    echo "<ul>";
    echo "<li class=\"divider\"";

    echo "<div class\"row\>";
    echo "<div class\"col-lg col-lg-6\">";

    echo "<p>";
    echo "<strong>Progress</strong>";
    echo " <span class=\"pull-right text-muted\">" . $progress . "% Complete</span>";
    echo "</p>";

    echo "<div class=\"progress progress-striped active\">";
    echo "<div class=\"progress-bar progress-bar-" . $progressBarColor . "\" role=\"progressbar\""
    . "aria-valuenow=\"" . $progress . "\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width:" . $progress . "%\">";
    echo "<span class=\"sr-only\">" . $progress . "% Comlete (info)</span>";
    echo "</div>";
    echo "</div>";

    echo "</div>";
    echo "</div>";
    echo "</li>";
    echo "</ul>";
}

function buttonDraw($name, $class, $type, $id = "", $dataToggle = "", $dataTarget = "") {

    if (isset($dataTarget) && isset($dataTarget)) {

        echo "<button type=\"" . $type . "\" class=\"" . $class . "\" data-toggle=\"" . $dataToggle . "\" data-target=\"" . $dataTarget . "\">" . $name . "</button>";
    } else {

        echo "<button type=\"" . $type . "\" class=\"" . $class . "\">" . $name . "</button>";
    }
}
?>



