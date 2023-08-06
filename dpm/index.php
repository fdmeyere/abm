<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$credat=$_GET['credat'];
$dat=$_GET['dat'];
$protecteditem=$_GET['protecteditem'];
$datasource=$_GET['datasource'];

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO dpmreport (credat,dat,protecteditem,datasource) VALUES ('$credat', '$dat','$protecteditem','$datasource')";
if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>