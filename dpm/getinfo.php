<?php
header("Content-type: application/json");
include('../db_connection.php');
$mysqli = opencon(); 

$derdencode=$_GET['derdencode'];

$sql  = "select * from dataklanten where derdencode='$derdencode' limit 1;";

$myObj=new \stdClass();

if ($result = $mysqli->query($sql)) 
{

    while($row = mysqli_fetch_assoc($result)) 
    {
    
      $emailto1=$row["emailto1"]; 
      $emailto2=$row["emailto2"]; 
      $emailfrom=$row["emailfrom"];
      $emailserver=$row["emailserver"];
 
       
    }
    

 }

$myObj->emailfrom = $emailfrom;
$myObj->emailto1 = $emailto1;
$myObj->emailto2 = $emailto2;
$myObj->emailserver = $emailserver;
$myObj->derdencode = $derdencode;

$myJSON = json_encode($myObj);
echo $myJSON;
?>