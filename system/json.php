<html><body>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 

$jason = file_get_contents("php://input");


// Attempt insert query execution

$sql = "INSERT INTO hpeservers(data) VALUES ('$jason');";


echo $sql;
if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}

// Close connection
$mysqli = closecon(); 
?>
</body></html>