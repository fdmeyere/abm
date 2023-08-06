<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
Hyper-V Replicatie<br><br>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>
<?php 
include('../db_connection.php'); $mysqli = opencon(); 

$query2="select count(*) as total from (select * from replreport where reg_date > date_sub(now(), interval 1 day) group by name) t;";
$result=$mysqli->query($query2);
$data=mysqli_fetch_assoc($result);
$totaal=$data['total'];
echo "Dit zijn alle gerepliceerde items van de afgelopen 24u verspreid over de klanten die over Hyper-V replicatie beschikken (totaal:".$totaal." items).<br><br>";

$query4="select count(*) as subset_normal from (select * from replreport where reg_date > date_sub(now(), interval 1 day) and health != 'normal' group by name) t;";
$result=$mysqli->query($query4);
$data=mysqli_fetch_assoc($result);
$normal=$data['subset_normal'];
$percentage=round(100*($normal/$totaal),0);
$percentage2=100-$percentage;

$query3="select count(*) as total from (select * from replreport group by primaryservername) t;";
$result=$mysqli->query($query3);
$data=mysqli_fetch_assoc($result);
echo '<div>Totaal aantal primary servers (in grote lijnen gelijk aan aantal klanten) beschikken: '.$data['total'].".<br></div>";

echo "<div id='piechart' style='float:left;'></div>";

echo "<div class='divTable blueTable'>
<div class='divTableHeading'>
<div class='divTableRow'>
<div class='divTableHead'>Naam</div>
<div class='divTableHead'>Health</div>
<div class='divTableHead'>Repl Avg Size (MB)</div>
<div class='divTableHead'>Goede Cycles</div>
<div class='divTableHead'>Foute Cycles</div>
<div class='divTableHead'>Bron</div>
<div class='divTableHead'>LastReplicationTime</div>
<div class='divTableHead'>OS Versie</div>

</div>
</div>
<div class='divTableBody'>";





$query = "select * from replreport where reg_date > date_sub(now(), interval 1 day) group by name order by primaryservername asc ;";


if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        
        $field2name = $row["name"];
        $field3name = $row["health"];
        $field4name = $row["avgreplsize"];
		$field4name=round($field4name/1024/1024);
        $field5name = $row["succreplcount"]; 
        $field6name = $row["replicationerrors"]; 
        $field7name = $row["primaryservername"]; 
        $field8name = $row["lastreplicationtime"]; 
        $field9name = $row["osversion"]; 
      
        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field2name</div>
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>$field5name</div>
        <div class='divTableCell'>$field6name</div>
        <div class='divTableCell'>$field7name</div>
        <div class='divTableCell'>$field8name</div>
        <div class='divTableCell'>$field9name</div>
      
        </div>";

    }
  
} 
echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script>
google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['', ''],
          ['Repl NOK', ".$percentage."],
          ['Repl OK', ".$percentage2."],

        ]);


        var options = {
            slices: {
                0: { color: '#f59300' },
                1: { color: 'green' }
              }, 
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
}</script>";






?>
 
</body>
</html>