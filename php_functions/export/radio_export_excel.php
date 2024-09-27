<?php
require_once("../functions.inc"); 

require_once ("../db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../../pages/login.php")); 
}

$myControl = "2ΑΚΕ";
$myControl2 = "1ΑΚΕ-SP";
$sql = "SELECT * FROM radio";
//$sql = "SELECT * FROM radio WHERE radio.control ='{$myControl}' OR radio.control ='{$myControl2}' ORDER BY radio.radio_id ASC";
//$sql = "SELECT personnel.*, divisions.description AS My_DIV, branches.branch as MyBranch, ranks.* FROM personnel, divisions, branches, ranks WHERE personnel.division = divisions.id  AND personnel.branch=branches.id AND ranks.rank=personnel.rank AND personnel.unit ='{$myUnit}' AND personnel.rank ='{$myRank}' ORDER BY ranks.priority ASC, personnel.asma ASC";
$db = new DbMgmt;
$res = $db->runQuery($sql);
$serial = 1;


$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}



//******************************************
$class = "table";
$headArray = array("SN", "NAME", "TYPE", "POSITION", "BAND", "GUARD", "MPA", "STATUS", "REASON", "ACTIONS", "DATE");
$head = count($headArray);


$output = '';
$output .= '
   <table class="table">  
  <tr>
    <th>Α/Α</th>
    <th>NANE</th>  
    <th>TYPE</th>  
    <th>ΘΕΣΗ</th>
    <th>BAND</th> 
    <th>GUARD</th>
    <th>MPA</th>
    <th>STATUS</th>
    <th>REASON</th>
    <th>ACTIONS</th>
    <th>DATE</th>
 </tr>
  ';
while ($row = mysqli_fetch_array($res)) {
    $output .= '
   <tr>  
     <td>' . $serial . '</td>                         
     <td>' . $row["radio_name"] . '</td>  
     <td>' . $row["radio_type"] . '</td>  
     <td>' . $row["location"] . '</td>
     <td>' . $row["band"] . '</td>  
     <td>' . $row["guard"] . '</td>  
     <td>' . $row["mpa"] . '</td>
     <td>' . $row["status"] . '</td>
     <td>' . $row["reason"] . '</td>
     <td>' . $row["action"] . '</td>
     <td>' . $row["tbc"] . '</td>
  </tr>
   ';
    $serial = $serial + 1;
}

$output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=radio.xls');
  echo $output;
?>