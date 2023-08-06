<html><body><p>
<?php 
include('db_connection.php');

$mysqli = opencon(); 

function mysqli_last_result($link) {
  while (mysqli_more_results($link)) {
      mysqli_use_result($link); 
      mysqli_next_result($link);
  }
  return mysqli_store_result($link);
}

#Toon verschillen met gisteren
echo "Verschil tussen vandaag en gisteren: ";
$query1 = "create temporary table tabel1 select * from marsreport WHERE DATE(credat) = DATE(NOW() - INTERVAL 1 DAY);";
$query1.= "create temporary table tabel2 select * from marsreport where DATE(credat) = CURDATE() ;";
$query1.= "create temporary table tabel3 select tabel1.servername,tabel2.newestmarsrp FROM Tabel1 LEFT JOIN Tabel2 ON Tabel1.friendlyname = Tabel2.friendlyname AND Tabel1.servername = Tabel2.servername where tabel2.newestmarsrp is NULL;";
$query1.= "select * from tabel3;";


mysqli_multi_query($mysqli, $query1);
$result1 = mysqli_last_result($mysqli);
$rowcount1=mysqli_num_rows($result1);
echo $rowcount1; echo "<br>";


if ($rowcount1>0) {
  echo '<table border="1" cellpadding="1" cellspacing="1"><tbody>
 
  <thead>
  <tr> 

  <th><font face="Verdana">servername</font></th> 
  <th><font face="Verdana">newestmarsrp</font></th> 
      
  </tr></thead><tbody>';
while ($row = $result1->fetch_assoc()) {
  $field1name = $row["servername"];
   $field2name = $row["newestmarsrp"];
 

  echo '<tr> 
            <td><font face="Verdana">'.$field1name.'</font></td> 
            <td><font face="Verdana">'.$field2name.'</font></td> 

        </tr>';
  }
  
  echo '</tbody></table>';
} 
$result1->free();
echo "<br>";
mysqli_close($mysqli);$mysqli = opencon(); 
#toon verschil tussen vandaag en eergisteren
echo "Verschil tussen vandaag en eergisteren: ";
$query1 = "create temporary table tabel1 select * from marsreport WHERE DATE(credat) = DATE(NOW() - INTERVAL 2 DAY);";
$query1.= "create temporary table tabel2 select * from marsreport where DATE(credat) = CURDATE() ;";
$query1.= "create temporary table tabel3 select tabel1.servername,tabel1.newestmarsrp FROM Tabel1 LEFT JOIN Tabel2 ON Tabel1.friendlyname = Tabel2.friendlyname AND Tabel1.servername = Tabel2.servername where tabel2.newestmarsrp is NULL;";
$query1.= "select * from tabel3;";


mysqli_multi_query($mysqli, $query1);
$result1 = mysqli_last_result($mysqli);
$rowcount1=mysqli_num_rows($result1);
echo $rowcount1; echo "<br>";


if ($rowcount1>0) {
  echo '<table border="1" cellpadding="1" cellspacing="1"><tbody>
 
  <thead>
  <tr> 

  <th><font face="Verdana">servername</font></th> 
  <th><font face="Verdana">newestmarsrp</font></th> 
      
  </tr></thead><tbody>';
while ($row = $result1->fetch_assoc()) {
  $field1name = $row["servername"];
   $field2name = $row["newestmarsrp"];
 

  echo '<tr> 
            <td><font face="Verdana">'.$field1name.'</font></td> 
            <td><font face="Verdana">'.$field2name.'</font></td> 

        </tr>';
  }
 
  echo '</tbody></table>';
} 
$result1->free();
echo "<br>";

#toon verschil tussen vandaag en twee dagen geleden
mysqli_close($mysqli);$mysqli = opencon(); 
echo "Verschil vandaag en 2 dagen geleden: ";
$query1 = "create temporary table tabel1 select * from marsreport WHERE DATE(credat) = DATE(NOW() - INTERVAL 3 DAY);";
$query1.= "create temporary table tabel2 select * from marsreport where DATE(credat) = CURDATE() ;";
$query1.= "create temporary table tabel3 select tabel1.servername,tabel1.newestmarsrp FROM Tabel1 LEFT JOIN Tabel2 ON Tabel1.friendlyname = Tabel2.friendlyname AND Tabel1.servername = Tabel2.servername where tabel2.newestmarsrp is NULL;";
$query1.= "select * from tabel3;";


mysqli_multi_query($mysqli, $query1);
$result1 = mysqli_last_result($mysqli);
$rowcount1=mysqli_num_rows($result1);
echo $rowcount1; echo "<br>";


if ($rowcount1>0) {
  echo '<table border="1" cellpadding="1" cellspacing="1"><tbody>
 
  <thead>
  <tr> 

  <th><font face="Verdana">servername</font></th> 
  <th><font face="Verdana">newestmarsrp</font></th> 
      
  </tr></thead><tbody>';
while ($row = $result1->fetch_assoc()) {
  $field1name = $row["servername"];
   $field2name = $row["newestmarsrp"];
 

  echo '<tr> 
            <td><font face="Verdana">'.$field1name.'</font></td> 
            <td><font face="Verdana">'.$field2name.'</font></td> 

        </tr>';
  }

  echo '</tbody></table>';
} 
$result1->free();
echo "<br>";

#toon verschil tussen vandaag en 10 dagen geleden
mysqli_close($mysqli);$mysqli = opencon(); 
echo "Verschil vandaag en 10 dagen geleden: ";
$query1 = "create temporary table tabel1 select * from marsreport WHERE DATE(credat) = DATE(NOW() - INTERVAL 10 DAY);";
$query1.= "create temporary table tabel2 select * from marsreport where DATE(credat) = CURDATE() ;";
$query1.= "create temporary table tabel3 select tabel1.servername,tabel1.newestmarsrp FROM Tabel1 LEFT JOIN Tabel2 ON Tabel1.friendlyname = Tabel2.friendlyname AND Tabel1.servername = Tabel2.servername where tabel2.newestmarsrp is NULL;";
$query1.= "select * from tabel3;";


mysqli_multi_query($mysqli, $query1);
$result1 = mysqli_last_result($mysqli);
$rowcount1=mysqli_num_rows($result1);
echo $rowcount1; echo "<br>";


if ($rowcount1>0) {
  echo '<table border="1" cellpadding="1" cellspacing="1"><tbody>
 
<thead>
      <tr> 
    
      <th><font face="Verdana">servername</font></th> 
      <th><font face="Verdana">newestmarsrp</font></th> 
          
      </tr></thead><tbody>';
  while ($row = $result1->fetch_assoc()) {
      $field1name = $row["servername"];
    $field2name = $row["newestmarsrp"];
     

      echo '<tr> 
                <td><font face="Verdana">'.$field1name.'</font></td> 
                <td><font face="Verdana">'.$field2name.'</font></td> 

            </tr>';
  }

  echo '</tbody></table>';
} 
$result1->free();



mysqli_close($mysqli);

?>
</p></body></html>