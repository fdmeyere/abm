<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 

$swapu=$_GET['swapu'];
$memu=$_GET['memu'];
$sharedu=$_GET['sharedu'];



// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO systemrap (swapusage,memusage,sharedusage) VALUES ('$swapu','$memu','$sharedu')";

if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>