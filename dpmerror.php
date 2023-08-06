<html><body><p>
<?php 
include('db_connection.php');

$mysqli = opencon(); 

# eerste query toont ons alle items die wel gebackupped worden maar waarvoor geen recent online RP bestaat.
$query1 = "select * from dpmitems where protecteditem not in(select dpmitems.protecteditem from dpmitems inner join dpmreport on dpmitems.protecteditem=dpmreport.protecteditem where dpmreport.dat > NOW() - INTERVAL 7 DAY);";
# tweede query geeft ons de klanten waarvoor we geen data hebben ontvangen in de afgelopen 24h, issue hier is nog dat sommige servers 
#niet elke dag gebackupped worden conf-rds01 is zo'n geval
$query2 = "select derdencode,protecteditem from dpmitems where credat  < NOW() - INTERVAL 1 DAY group by derdencode;";

$result1 = $mysqli->query($query1) ;
$result2 = $mysqli->query($query2) ;

$rowcount1=mysqli_num_rows($result1);
$rowcount2=mysqli_num_rows($result2);

if ( $rowcount1>0  or  $rowcount2>0 ) 
{ 
    while ($row1 = $result1->fetch_assoc()) {
      echo "Geen recent Recovery Point voor: <b>".$row1["protecteditem"]."</b><br> ";
        
      }

      while ($row2 = $result2->fetch_assoc()) {
      #echo "<p>Geen gegevens ontvangen van: "; echo $row2["derdencode"]; echo " ";
      echo "no error";
        
      }
}
else
{ 
  echo "no error ";
}  

mysqli_close($mysqli);

?>

</body></html>