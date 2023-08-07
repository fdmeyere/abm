<?php

function OpenCon()
 {
 #$dbhost = "monitorbackup.mysql.database.azure.com";
 #$dbuser = "admcce@monitorbackup";
 #$dbpass = "M7.{uGvR=-6f8T3v";
 #$db = "monitorbackup";
 $dbhost = "abmcce.mysql.database.azure.com";
 $dbuser = "fpsxvhlcnx";
 $dbpass = "M7.{uGvR=-6f8T3v";
 $db = "abmcce";

 
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);

 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>
