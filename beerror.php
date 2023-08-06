<html><body><p><?php 
include('db_connection.php'); $mysqli = opencon(); 

function mysqli_last_result($link) {
    while (mysqli_more_results($link)) {
        mysqli_use_result($link); 
        mysqli_next_result($link);
    }
    return mysqli_store_result($link);}
echo "Veritas Backup Exceptions";
$query = "create temporary table t1 select jobstatus,jobname,totaldatasizebytes,starttime from be where credat >= curdate() and jobstatus like '%With%';";
$query.= "create temporary table t2 select be.totaldatasizebytes,be.jobname,be.starttime from be inner join t1 on t1.jobname=be.jobname where be.starttime>=SUBDATE(CURDATE(),2) and be.starttime<subdate(curdate(),1);";
$query.= "select t1.jobname,t1.totaldatasizebytes as vandaag,t2.totaldatasizebytes as gisteren from t1 inner join t2 on t1.jobname=t2.jobname;";

mysqli_multi_query($mysqli, $query);
$result = mysqli_last_result($mysqli);
$rowcount=mysqli_num_rows($result);

if ($rowcount > 0 ) {
    echo '<table border="2" cellspacing="2" cellpadding="2">';
    while ($row = $result->fetch_assoc()) {
        
        $field1name = $row["jobname"];
        $field2name = $row["vandaag"];$field2name=round($field2name/1024/1024,0);
        $field3name = $row["gisteren"];$field3name=round($field3name/1024/1024,0);
        $field4name = $field2name - $field3name;
        
        if ($field4name == 0 or $field4name>20000 or $field4name<-2000) {
        echo "<tr><td><font face='Verdana'>".$field1name."</font></td>";
        echo "<td><font face='Verdana'>".$field2name."</font></td>";
        echo "<td><font face='Verdana'>".$field3name."</font></td>";
        echo "<td><font face='Verdana'>".$field4name."</font></td></tr>";
        }
 

    }
    echo "</table>";
} 

echo "<br>Veritas Backup Errors";
$query = "select jobname from be where credat >= curdate() and (jobstatus = 'Error' or jobstatus = 'Canceled') and jobtype = 'Backup';";

if ($result = $mysqli->query($query)) {
    echo '<table border="2" cellspacing="2" cellpadding="2">';
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["jobname"];  
        echo '<tr><td><font face="Verdana">'.$field1name.'</font></td></tr>';
          }
          echo "</table>";
          
            

    }
    
?>
</body>
</html>