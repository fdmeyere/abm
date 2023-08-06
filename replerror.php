<html><body><p><?php 
include('db_connection.php');

$mysqli = opencon(); 



#Deze query geeft de gerepliceerde items weer waarvan de stayus anders is dan Normal in de afgelopen 24u.
$query0 = "select reg_date,name from replreport where health<>'normal' and reg_date > date_sub(now(), interval 1 day) ;";

$result0 = $mysqli->query($query0) ;


$rowcount0=mysqli_num_rows($result0);

if ( $rowcount0>0  ) { 

    while ($row0 = $result0->fetch_assoc()) {
      
      echo 'Replicatie is mislukt voor:<table border="2" cellspacing="2" cellpadding="2"> 
      <tr> 
      <td> <font face="Verdana">credat</font> </td> 
      <td> <font face="Verdana">name</font> </td> 
      </tr>';
    
      if ($result0 = $mysqli->query($query0)) {
        while ($row = $result0->fetch_assoc()) {
          $field1name = $row["reg_date"]; 
          $field2name = $row["name"];
         
        
            echo '<tr> 
                      <td><font face="Verdana">'.$field1name.'</font></td> 
                      <td><font face="Verdana">'.$field2name.'</font></td> 
                                         
                  </tr>';
        }
        
        $result0->free();
        echo "</table>";     
        }
    
      }
    
    }




else
{ 
  echo "no error ";
} 


mysqli_close($mysqli);

?></p></body></html>