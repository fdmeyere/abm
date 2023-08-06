<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$credat=$_GET['credat'];
$protecteditem=$_GET['protecteditem'];
$derdencode=$_GET['derdencode'];
$marsversion=$_GET['marsversion'];
$mabsversion=$_GET['mabsversion'];


// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO dpmitems (credat,protecteditem,derdencode,marsversion,mabsversion) VALUES ('$credat', '$protecteditem', '$derdencode', '$marsversion', '$mabsversion')";

if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>