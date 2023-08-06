<html><body>
<?php
  include('../db_connection.php');

$sitenr=$_GET['sitenr'];
$derdencode=$_GET['derdencode'];

$mysqli = opencon(); 

$sql = "INSERT INTO infoklanten (sitenr,derdencode) VALUES ('$sitenr', '$derdencode')";
if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}
$mysqli = closecon(); 
?>
</body></html>