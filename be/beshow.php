<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
Overzicht Backup Exec jobhistorieken.<br><br>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>

<div class="divTable blueTable">
<div class="divTableHeading">
<div class="divTableRow">
<div class="divTableHead"><a id="wins" class="filter__link filter__link--number" href="#">ID</a></div>
<div class="divTableHead">Klant</div>
<div class="divTableHead">Jobnaam</div>
<div class="divTableHead">Jobstatus</div>
<div class="divTableHead">JobType</div>
<div class="divTableHead">Version</div>
<div class="divTableHead">Datasize (GB)</div>
<div class="divTableHead">Start Time</div>
<div class="divTableHead">Elapsed (hours)</div>
<div class="divTableHead">Storage</div>

</div>
</div>
<div class="divTableBody">

<?php 
include('../db_connection.php'); $mysqli = opencon(); 

$tijd=time();
$tijd=$tijd-86400;

$query = "select * from be order by starttime;";


if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["be_id"];
        $field10name = $row["agentserver"];$field10name=explode(" ",$field10name);
        $field2name = $row["jobname"];
        $field3name = $row["jobstatus"];
        $field4name = $row["jobtype"];
        $field9name = $row["versie"];
        $field5name = $row["totaldatasizebytes"];$field5name=round($field5name/1024/1024/1024);
        $field6name = $row["starttime"];
        $field7name = $row["elapsedtime"];$field7name=round($field7name/3600,1);
        $field8name = $row["storage"];
        
        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field1name</div>
        <div class='divTableCell'>$field10name</div>
        <div class='divTableCell'>$field2name</div>
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>$field9name</div>
        <div class='divTableCell'>$field5name</div>
        <div class='divTableCell'>$field6name</div>
        <div class='divTableCell'>$field7name</div>
        <div class='divTableCell'>$field8name</div>
        
        
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