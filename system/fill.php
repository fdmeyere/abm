<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$hostname=$_GET['hostname'];
$uptime=$_GET['uptime'];
$freeusr2=$_GET['freeusr2'];
$freedata=$_GET['freedata'];
$freeroot=$_GET['freeroot'];
$freetmp=$_GET['freetmp'];
$swapu=$_GET['swapu'];
$memu=$_GET['memu'];
$cpucores=$_GET['cpucores'];
$kernel=$_GET['kernel'];
$ipaddr=$_GET['ipaddr'];
$smbversion=$_GET['smbversion'];
$credat=$_GET['credat'];
$cpumodel=$_GET['cpumodel'];
$elversion=$_GET['elversion'];


// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO system (hostname,uptime,freeusr2,freetmp,freedata,freeroot,swapusage,memusage,cpucores,kernel,ipaddr,smbversion,credat,cpumodel,elversion) VALUES ('$hostname', '$uptime', '$freeusr2', '$freetmp', '$freedata', '$freeroot', '$swapu','$memu','$cpucores','$kernel','$ipaddr','$smbversion','$credat','$cpumodel','$elversion')";

if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>