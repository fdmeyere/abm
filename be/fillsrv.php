<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 

$servername=$_GET['servername'];
$version=$_GET['version'];
$osversion=$_GET['osversion'];

// Check connection
if($mysqli === false){ 
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO besystem (servername,versie,osversion) VALUES ('$servername','$version','$osversion')";

if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>