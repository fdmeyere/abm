<html><body>
<?php
  include('db_connection.php');

$which=$_GET['which'];
$who=$_GET['who'];
$signinoutat=$_GET['signinoutat'];
$signinstatus= filter_var($_GET['signinstatus'], FILTER_VALIDATE_BOOLEAN);



$mysqli = opencon(); 

$sql = "INSERT INTO raslogon (which,who,signinoutat,signinstatus) VALUES ('$which', '$who', '$signinoutat', '$signinstatus')";
if(mysqli_query($mysqli, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($mysqli);
}
$mysqli = closecon(); 
?>
</body></html>