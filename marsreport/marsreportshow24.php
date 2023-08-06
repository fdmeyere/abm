<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
MARS Agent status<br><br>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br>
<?php
include('../db_connection.php'); $mysqli = opencon(); 
$query1 = "select * from marsreport where DATE(credat) = CURDATE() order by derdencode;";
$query1b = "select count(*) as total from marsreport where DATE(credat) = CURDATE();";
$result1b=$mysqli->query($query1b);
$data1b=mysqli_fetch_assoc($result1b);
echo '<br>Aantal MARS items vandaag: '.$data1b['total']."<br><br>";

echo "<div class='divTable blueTable'>
<div class='divTableHeading'>
<div class='divTableRow'>
<div class='divTableHead'>ID</div>
<div class='divTableHead'>Creatie Datum</div>
<div class='divTableHead'>Naam</div>
<div class='divTableHead'>Server</div>
<div class='divTableHead'>Derdencode</div>
<div class='divTableHead'>Oudste RP</div>
<div class='divTableHead'>Nieuwste RP</div>
<div class='divTableHead'>Grootte (GB)</div>
<div class='divTableHead'>Aantal RP's</div>
<div class='divTableHead'>Machine Type</div>
<div class='divTableHead'>Host (indien VM)</div>
<div class='divTableHead'>Versie</div>
</div>
</div>
<div class='divTableBody'>";



 
if ($result1 = $mysqli->query($query1)) {
    while ($row1 = $result1->fetch_assoc()) {
        $field1name = $row1["marsreport_id"];
        $field3name = $row1["credat"]; 
        $field4name = $row1["friendlyname"];
        $field5name = $row1["servername"]; 
        $field6name = $row1["derdencode"]; 
        $field7name = $row1["oldestmarsrp"]; 
        $field8name = $row1["newestmarsrp"]; 
        $field9name = $row1["size"]; 
        $field10name = $row1["aantalrp"]; 
        $field11name = $row1["machine"]; 
        $field12name = $row1["host"]; 
        $field13name = $row1["marsversion"]; 
        
        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field1name</div>
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>$field5name</div>
        <div class='divTableCell'>$field6name</div>
        <div class='divTableCell'>$field7name</div>
        <div class='divTableCell'>$field8name</div>
        <div class='divTableCell'>$field9name</div>
        <div class='divTableCell'>$field10name</div>
        <div class='divTableCell'>$field11name</div>
        <div class='divTableCell'>$field12name</div>
        <div class='divTableCell'>$field13name</div>
        </div>";

       
    }
    
      
      
} 
?>


</div>
</div>

 



</body>
</html>
