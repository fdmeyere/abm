<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$credat=$_GET['credat'];
$dpmservername=$_GET['dpmservername'];
$uptime=$_GET['uptime'];
$freespacecdrive=$_GET['freespacecdrive'];
$mabsversion=$_GET['mabsversion'];
$marsversion=$_GET['marsversion'];
$osversion=$_GET['osversion'];
$tmemory=$_GET['tmemory'];
$fmemory=$_GET['fmemory'];



// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO dpmserverstats (credat,dpmservername,uptime,freespacecdrive,mabsversion,marsversion,osversion,tmemory,fmemory) VALUES ('$credat', '$dpmservername', '$uptime', '$freespacecdrive', '$mabsversion', '$marsversion', '$osversion', '$tmemory', '$fmemory')";

if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>