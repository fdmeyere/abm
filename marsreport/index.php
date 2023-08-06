<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$credat=$_GET['credat'];
$friendlyname=$_GET['friendlyname'];
$servername=$_GET['servername'];
$derdencode=$_GET['derdencode'];
$oldestmarsrp=$_GET['oldestmarsrp'];
$newestmarsrp=$_GET['newestmarsrp'];
$size=$_GET['size'];
$aantalrp=$_GET['aantalrp'];
$machine=$_GET['machine'];
$host=$_GET['host'];
$marsversion=$_GET['marsversion'];

// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt insert query execution
$sql = "INSERT INTO marsreport (credat,friendlyname,servername,derdencode,oldestmarsrp,newestmarsrp,size,aantalrp,machine,host,marsversion) VALUES ('$credat','$friendlyname', '$servername', '$derdencode', '$oldestmarsrp', '$newestmarsrp', '$size', '$aantalrp', '$machine', '$host', '$marsversion')";
if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
}
 
// Close connection
$mysqli = closecon(); 
?>
</body></html>