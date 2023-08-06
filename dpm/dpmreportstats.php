<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$status=$_GET['status'];
$jobcategory=$_GET['jobcategory'];
$datasources=$_GET['datasources'];
$datasize=$_GET['datasize'];
$starttime=$_GET['starttime'];
$endtime=$_GET['endtime'];
$derdencode=$_GET['derdencode'];


// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO dpmreportstats (status, jobcategory, datasources, datasize , starttime ,endtime, derdencode ) VALUES ('$status', '$jobcategory', '$datasources', '$datasize', '$starttime', '$endtime', '$derdencode')";

if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>