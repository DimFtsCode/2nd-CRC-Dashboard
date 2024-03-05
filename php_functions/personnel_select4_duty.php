
<?php

require_once("functions.inc");

require_once ("./db_config/db_connect.php");  

$db = new DbMgmt();


$myAsma = $_POST['myAsma'];

$findPerson = "SELECT personnel.*, duty.* FROM personnel, duty WHERE personnel.asma ='{$myAsma}' AND personnel.asma =duty.asma ";
//$findPerson = "SELECT * FROM personnel WHERE asma ='{$myAsma}' "; 
$findResult = $db->runQuery($findPerson); 

$findRow = mysqli_fetch_assoc($findResult);

$person = array(
    "asma" =>$findRow['asma'],
    "rank" =>$findRow['rank'],
    "specialty" =>$findRow['splty'],
    "last_name" =>$findRow['sname'], 
    "first_name" =>$findRow['fname'],
    "duty1" =>$findRow['duty1'],
    "date1" =>$findRow['date1'],
    "duty2" =>$findRow['duty2'],
    "date2" =>$findRow['date2'],
    "duty3" =>$findRow['duty3'],
    "date3" =>$findRow['date3']
);


echo json_encode($person);

?>

