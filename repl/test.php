<!DOCTYPE html>
<html lang="en">
<head> 

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
Hyper-V Replicatie (testpagina om Hyper-V servers te detecteren die geen telemetrie bezorgd hebben)<br><br>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>
<?php 
include('../db_connection.php'); 

$mysqli = opencon(); 

function mysqli_last_result($link) {
    while (mysqli_more_results($link)) {
        mysqli_use_result($link); 
        mysqli_next_result($link);
    }
    return mysqli_store_result($link);
  }

echo "<div class='divTable blueTable'>
<div class='divTableHeading'>
<div class='divTableRow'>

<div class='divTableHead'>Source servernaam</div>
<div class='divTableHead'>Oudste replicatie</div>

</div>
</div>
<div class='divTableBody'>";

#$query7="select max(reg_date) as oudste,replreport_id,primaryservername from replreport  where reg_date < now() group by primaryservername order by reg_date asc;";
$query7="create temporary table tbl_t1 select max(reg_date) as oudste,replreport_id,primaryservername from replreport  where reg_date < now() group by primaryservername order by reg_date asc;";
$query7.="select * from tbl_t1 where date(oudste) < now() - INTERVAL 1 DAY and date(oudste) > now() - INTERVAL 1000 DAY;";

mysqli_multi_query($mysqli, $query7);
$result7 = mysqli_last_result($mysqli);
$rowcount7=mysqli_num_rows($result7);

if ( $rowcount7>0 ) 

{
while ($row = $result7->fetch_assoc()) {

    $field1name = $row["oudste"];
    $field2name = $row["primaryservername"];
    
    echo "<div class='divTableRow'><div class='divTableCell'>".$field2name."</div><div class='divTableCell'>".$field1name."</div></div>";
    
    
}
}

$mysqli -> close();

?>
</div>
</div>
</body>
</html>