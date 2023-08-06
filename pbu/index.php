<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$credat=$_GET['credat'];
$pbuname=$_GET['pbuname'];
$pbusize=$_GET['pbusize'];
$pbudate=$_GET['pbudate'];
$sitenr=$_GET['sitenr'];
$vpstatus=$_GET['vpstatus'];
$mount=$_GET['mount'];
$aienabled=$_GET['aienabled'];
$ipaddress=$_GET['ipaddress'];


/* eerst de gegevens valideren */


/* database connectie  */

 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO pbustatus (credat,pbuname,pbusize,pbudate,sitenr,vpstatus,mount,aienabled,ipaddress) VALUES ('$credat','$pbuname', '$pbusize', '$pbudate', '$sitenr', '$vpstatus','$mount','$aienabled','$ipaddress')";
if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}
 
// Close connection
$mysqli = closecon(); 
?>
</body></html>