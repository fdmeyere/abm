<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
Backup Jobs.<br><br>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>

Backup Jobs with Exceptions:
<div class="divTable blueTable">
<div class="divTableHeading">
<div class="divTableRow">
<div class="divTableHead">Jobnaam</div>
<div class="divTableHead">Totalsize Vandaag</div>
<div class="divTableHead">Totalsize Gisteren</div>
<div class="divTableHead">Verschil</div>

</div>
</div>
<div class="divTableBody">

<?php 
include('../db_connection.php'); $mysqli = opencon(); 


function mysqli_last_result($link) {
    while (mysqli_more_results($link)) {
        mysqli_use_result($link); 
        mysqli_next_result($link);
    }
    return mysqli_store_result($link);}

$query  = "create temporary table t1 select jobstatus,jobname,totaldatasizebytes,starttime from be where credat >= curdate() and jobstatus like '%With%';";
$query.= "create temporary table t2 select be.totaldatasizebytes,be.jobname,be.starttime from be inner join t1 on t1.jobname=be.jobname where be.starttime>=SUBDATE(CURDATE(),2) and be.starttime<subdate(curdate(),1);";
$query.= "select t1.jobname,t1.totaldatasizebytes as vandaag,t2.totaldatasizebytes as gisteren from t1 inner join t2 on t1.jobname=t2.jobname;";

mysqli_multi_query($mysqli, $query);
$result = mysqli_last_result($mysqli);
$rowcount=mysqli_num_rows($result);

if ($rowcount > 0 ) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["jobname"];
        $field2name = $row["vandaag"];$field2name=round($field2name/1024/1024,0);
        $field3name = $row["gisteren"];$field3name=round($field3name/1024/1024,0);
        $field4name = $field2name - $field3name;
           
        
        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field1name</div>
        <div class='divTableCell'>$field2name</div>
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field4name</div>
        
        
        </div>";

    }
  
} 

echo "</div></div><br>Backup Jobs in Error:";
$query = "select jobname from be where credat >= curdate() and (jobstatus = 'Error' or jobstatus = 'Canceled') and jobtype = 'Backup';";

echo "<div class='divTable blueTable'>
<div class='divTableHeading'>
<div class='divTableRow'>
<div class='divTableHead'>Jobnaam</div>
</div>
</div>
<div class='divTableBody'>";

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["jobname"];
                
        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field1name</div>
        
        
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