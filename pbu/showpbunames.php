<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>

<?php 
include('../db_connection.php');
$mysqli = opencon(); 

$queryb = "select count(*) as total from pbunames order by derdencode;";
$aantalklantenq = "select count(*) as totaal from (select * from pbunames group by derdencode) t;";

$resultb=$mysqli->query($queryb);
$datab=mysqli_fetch_assoc($resultb);

$resultc=$mysqli->query($aantalklantenq);
$aantalklanten=mysqli_fetch_assoc($resultc);



echo 'Vandaag monitoren we onderstaande '.$datab['total']." databases, verspreid over ".$aantalklanten['totaal']." klanten.<br><br>";

echo "
<div class='divTable blueTable'>
<div class='divTableHeading'>
<div class='divTableRow'>
<div class='divTableHead'>ID</div>
<div class='divTableHead'>Derdencode</div>
<div class='divTableHead'>Effectief?</div>
<div class='divTableHead'>PBU locatie</div>
</div>
</div>
<div class='divTableBody'>";

$query = "select * from pbunames order by derdencode;";

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["derdencode"];
        $field2name = $row["pbuname"];
        $field3name = $row["pbunames_id"];
        $field4name = $row["checkdb"];
        
		
        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field1name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>$field2name</div>

        </div>";
    }


} 

?>
</body>
</html>