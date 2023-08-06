<html><body><p><?php 
include('db_connection.php');

$mysqli = opencon(); 

function mysqli_last_result($link) 
{
  while (mysqli_more_results($link)) 
  {
      mysqli_use_result($link); 
      mysqli_next_result($link);
  }
return mysqli_store_result($link);}


#Deze multi-query geeft de derden weer waarvoor gisteren geen telemetrie is otnvangen.
$query3="create temporary table t_table2 select sitenr,pbuname from pbustatus where sitenr not in (select sitenr from pbustatus where not(credat  < NOW() - INTERVAL 1 DAY)) group by sitenr;";
$query3.="select derdencode from infoklanten inner join t_table2 on infoklanten.sitenr = t_table2.sitenr group by derdencode;";
#Geen telemetrie geeft aanleiding tot fout.

#Deze multi-query filtert alle backups eruit die gisteren geen geldige verify konden voorleggen
$query5 = "create temporary table t_table3 select pbunames_id,pbuname,sitenr,checkdb,pbunames.derdencode from pbunames INNER JOIN infoklanten ON infoklanten.derdencode = pbunames.derdencode ;";
$query5.="select * from t_table3 inner join pbustatus on t_table3.sitenr=pbustatus.sitenr and t_table3.pbuname=pbustatus.pbuname  where vpstatus=0 and checkdb=1 and DATE(credat) = subdate(current_date, 1) group by pbunames_id;";
#Geen geldige verify geeft aanleding tot fout.

mysqli_multi_query($mysqli, $query3);
$result3 = mysqli_last_result($mysqli);
$rowcount3=mysqli_num_rows($result3);

mysqli_multi_query($mysqli, $query5);
$result5 = mysqli_last_result($mysqli);
$rowcount5=mysqli_num_rows($result5);

if ( $rowcount5>0 ) 
{ 
      
    echo 'backup mislukt:<table border="2" cellspacing="2" cellpadding="2"> 
    <tr> 
    <td> <font face="Verdana">credat</font> </td> 
    <td> <font face="Verdana">derdencode</font> </td> 
    <td> <font face="Verdana">sitenr</font> </td> 
    <td> <font face="Verdana">pbuname</font> </td> 
    </tr>';
  
    
      while ($row = $result5->fetch_assoc()) 
      {
        $field1name = $row["credat"]; 
        $field3name = $row["sitenr"];       
        $field2name = $row["pbuname"];
        $field4name = $row["derdencode"];
        echo '<tr> 
                    <td><font face="Verdana">'.$field1name.'</font></td> 
                    <td><font face="Verdana">'.$field4name.'</font></td> 
                    <td><font face="Verdana">'.$field3name.'</font></td> 
                    <td><font face="Verdana">'.$field2name.'</font></td> 
                </tr>';
      }
      echo "</table>";     
}

if ($rowcount3>0)

{
    echo 'geen gegevens ontvangen van: ';
    
        while ($row = $result3->fetch_assoc()) 
        {
            $field1name = $row["derdencode"];
            echo $field1name; echo " ";
        }
}

if ($rowcount5==0 and $rowcount3==0)

{ 
  echo "no error ";
} 

mysqli_close($mysqli);

?></p></body></html>