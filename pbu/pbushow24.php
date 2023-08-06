<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
Welke databases werden gebackupped in de afgelopen 24u?<br><br>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>

<div class="divTable blueTable">
<div class="divTableHeading">
<div class="divTableRow">
<div class="divTableHead"><a id="wins" class="filter__link filter__link--number" href="#">Wins</a></div>
<div class="divTableHead">Derdencode</div>
<div class="divTableHead">Creatie Datum</div>
<div class="divTableHead">PBU locatie</div>
<div class="divTableHead">Grootte (GB)</div>
<div class="divTableHead">PBU Datum</div>
<div class="divTableHead">Verified?</div>


</div>
</div>
<div class="divTableBody">

<?php 
include('../db_connection.php'); $mysqli = opencon(); 

$tijd=time();
$tijd=$tijd-86400;

$query = "select credat,pbustatus_id,derdencode,pbuname,pbusize,pbudate,mount,vpstatus from infoklanten INNER JOIN pbustatus ON infoklanten.sitenr = pbustatus.sitenr where pbudate>$tijd group by pbustatus_id;";


if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["pbustatus_id"];
        $field2name = $row["credat"];
        $field3name = $row["pbuname"];
        $field4name = $row["pbusize"];
		$field4name=round($field4name/1024/1024/1024);
        $field5name = $row["pbudate"]; $field5name = new DateTime("@$field5name");
        $field6name = $row["derdencode"]; 
        $field7name = $row["vpstatus"]; 
        
        $field9name = $row["mount"]; $field9name=substr($field9name, 0, 150);
        $status_colors = array(1 => '#00FF00', 0 => '#FF0000');

        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field1name</div>
        <div class='divTableCell'>$field6name</div>
        <div class='divTableCell'>$field2name</div>
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>".$field5name->format('d/m/Y H:i:s')."</div>";
        if ($field7name==1) {$field7show='Ja';} else {$field7show='Nee';};
        echo "<div style='background-color: ".$status_colors[$field7name]."' class='divTableCell'>$field7show</div>
        
        </div>";

    }
  
} 
?>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" 
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" 
        crossorigin="anonymous">
</script>
<script src="../js/sort.js"></script> 
</body>
</html>