<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$jobname=$_GET['jobname'];
$jobstatus=$_GET['jobstatus'];
$starttime=$_GET['starttime'];
$elapsedtime=$_GET['elapsedtime'];
$totaldatasizebytes=$_GET['totaldatasizebytes'];
$agentserver=$_GET['agentserver'];
$jobtype=$_GET['jobtype'];
$storage=$_GET['storage'];



// Check connection
if($mysqli === false){ 
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO be (jobname,jobstatus,jobtype,agentserver,totaldatasizebytes,starttime,elapsedtime,storage) VALUES ('$jobname', '$jobstatus', '$jobtype', '$agentserver', '$totaldatasizebytes', '$starttime', '$elapsedtime', '$storage')";

if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>