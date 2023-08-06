<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$naam=$_GET['naam'];
$health=$_GET['health'];
$avgreplsize=$_GET['avgreplsize'];
$succreplcount=$_GET['succreplcount'];
$ReplicationErrors=$_GET['ReplicationErrors'];
$PrimaryServerName=$_GET['PrimaryServerName'];
$LastReplicationTime=$_GET['LastReplicationTime'];
$osversion=$_GET['osversion'];


// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO replreport  (name,health,avgreplsize,succreplcount,ReplicationErrors,PrimaryServerName,LastReplicationTime,osversion) VALUES ('$naam', '$health', '$avgreplsize', '$succreplcount', '$ReplicationErrors','$PrimaryServerName','$LastReplicationTime','$osversion')";

if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>