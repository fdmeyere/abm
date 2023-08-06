<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$derdencode=$_GET['derdencode'];

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "delete from dpmitems where derdencode='$derdencode'";
if(mysqli_query($mysqli, $sql)){
    echo "Records deleted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>