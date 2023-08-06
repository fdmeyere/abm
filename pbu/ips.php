<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
<?php 
include('../db_connection.php'); $mysqli = opencon(); 



$query = "select ipaddress from pbustatus  group by ipâddress;";
$result=$mysqli->query($query);




if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {



    $field1name = $row["ipaddress"];
    echo $field1name; echo "<br>";

    
  }
}
?>

</body>
</html>