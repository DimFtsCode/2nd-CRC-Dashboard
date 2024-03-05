<html>
<head>
<style>
table, th, td {
     border: 1px solid black;
}
</style>
</head>
<body>

<?php
include './db_config/db_connect.php';




$am = "67045";
$pswd = "1234";
$sql = "SELECT * FROM `personel` WHERE `AM`=$am AND `password`=$pswd LIMIT 0, 30 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     echo "<table><tr><th>ID</th><th>Name</th></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr><td>" . $row["AM"]. "</td><td>" . $row["password"]. "</td></tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}

$conn->close();
?> 

</body>