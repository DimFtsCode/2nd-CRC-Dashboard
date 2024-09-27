<?php
require_once("../functions.inc"); 

require_once ("../db_config/db_connect.php");

$user = new User;
if (!$user->isLoggedIn) {
    die(header("Location: ../../pages/login.php")); 
}

$myUnit = "2ΑΚΕ";
$myRank = "ΟΒΑ";
$sql = "SELECT personnel.*, divisions.description AS My_DIV, branches.branch as MyBranch, ranks.* FROM personnel, divisions, branches, ranks WHERE personnel.division = divisions.id  AND personnel.branch=branches.id AND ranks.rank=personnel.rank AND personnel.unit ='{$myUnit}' AND personnel.rank ='{$myRank}' ORDER BY ranks.priority ASC, personnel.asma ASC";
$db = new DbMgmt;
$res = $db->runQuery($sql);
$serial = 1;


$_SESSION['formAttempt'] = true; 
if (isset($_SESSION['error'])) {
    unset($_SESSION['error']);
}



//******************************************
$class = "table";
$headArray = array("SN", "ΑΣΜΑ", "Βαθμός", "Ειδ.", "Επιθετο", "Ονομα", "Διεύθυνση", "Τμήμα/Σμήνος", "Παρουσίαση", "Διαγραφή");
$head = count($headArray);


$output = '';
$output .= '
   <table class="table">  
  <tr>
    <th>Α/Α</th>
    <th>ΑΣΜΑ</th>  
    <th>ΒΑΘΜΟΣ</th>  
    <th>ΕΙΔ.</th>
    <th>ΕΠΙΘΕΤΟ</th> 
    <th>ΟΝΟΜΑ</th>
    <th>ΕΠΙΣΤΑΣΙΑ</th>
 </tr>
  ';
while ($row = mysqli_fetch_array($res)) {
    $output .= '
   <tr>  
     <td>' . $serial . '</td>                         
     <td>' . $row["asma"] . '</td>  
     <td>' . $row["rank"] . '</td>  
     <td>' . $row["splty"] . '</td>
     <td>' . $row["sname"] . '</td>  
     <td>' . $row["fname"] . '</td>  
     <td>' . $row["My_DIV"] . '</td>
  </tr>
   ';
    $serial = $serial + 1;
}

$output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=ova.xls');
  echo $output;
?>