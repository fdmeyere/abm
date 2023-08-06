<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>




<div class="divTable blueTable">
<div class="divTableHeading">
<div class="divTableRow">
<div class="divTableHead">Datasource(s)</div>
<div class="divTableHead">Derdencode	</div>
<div class="divTableHead">Job</div>
<div class="divTableHead">Status</div>
<div class="divTableHead">Grootte (GB)	</div>
<div class="divTableHead">Start</div>
<div class="divTableHead">Duur (min.)</div>
<div class="divTableHead">ID</div>
</div>
</div>
<div class="divTableBody">



<?php 

include('../db_connection.php'); $mysqli = opencon(); 

$query1 = "select * from dpmreportstats where status='succeeded' and starttime >= NOW() - INTERVAL 1 DAY order by derdencode ;";

$result1=$mysqli->query($query1);
$data1=mysqli_fetch_assoc($result1);

 
if ($result1 = $mysqli->query($query1)) {
    while ($row1 = $result1->fetch_assoc()) {
        $field1name = $row1["dpmreportstats_id"];
        $field2name = $row1["status"];
        $field3name = $row1["datasources"]; 
        $field4name = $row1["jobcategory"];
        $field5name = round($row1["datasize"] /1024 /1024 /1024,1); 
        $field6name = $row1["starttime"]; 
        $field7name = $row1["endtime"]; 

        $to_time = strtotime($field6name);
        $from_time = strtotime($field7name);
        $duration= round(abs($to_time - $from_time) / 60,0);

        $field8name = $row1["derdencode"]; 


        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field8name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>$field2name</div>
        <div class='divTableCell'>$field5name</div>
        <div class='divTableCell'>$field6name</div>
        <div class='divTableCell'>$duration</div>
        <div class='divTableCell'>$field1name</div>
        </div>";
    }
}
 
?>



</div>
</div>

 



</body>
</html>