<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>

<div class="divTable blueTable">
<div class="divTableHeading">
<div class="divTableRow">
<div class="divTableHead">ID</div>

<div class="divTableHead">Datum RecoveryPoint</div>
<div class="divTableHead">Protected Item</div>
<div class="divTableHead">Datasource</div>
</div>
</div>
<div class="divTableBody">


<?php 
include('../db_connection.php'); $mysqli = opencon(); 

$tijd=time();
$tijd=$tijd-86400;

$query = "select * from dpmreport where dat > date_sub(now(), interval 1 day) order by dat;";
 

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["dpmreport_id"];
        $field2name = $row["credat"];
        $field3name = $row["dat"]; 
        $field4name = $row["protecteditem"];
        $field5name = $row["datasource"]; 
        
        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field1name</div>
        
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>$field5name</div>
                </div>";
    }


    }
    ?>



    </div>
    </div>
     
    </body>
    </html>