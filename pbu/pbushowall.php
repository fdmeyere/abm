<html>
<body>
<?php 
include('../db_connection.php');

$mysqli = opencon(); 

$query = "select pbustatus_id,derdencode,pbuname,pbusize,pbudate,mount,vpstatus from infoklanten INNER JOIN pbustatus ON infoklanten.sitenr = pbustatus.sitenr group by pbustatus_id;";

echo '<table border="2" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Verdana">ID</font> </td> 
          <td> <font face="Verdana">name</font> </td> 
          <td> <font face="Verdana">size (MB)</font> </td> 
          <td> <font face="Verdana">date (unix)</font> </td> 
          <td> <font face="Verdana">sitenr</font> </td> 
          <td> <font face="Verdana">verified</font> </td> 
          <td> <font face="Verdana">mount</font> </td> 
      </tr>';
 
if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["pbustatus_id"];
        $field2name = $row["pbuname"];
        $field3name = $row["pbusize"];
		$field3name=round($field3name/1024/1024);
        $field4name = $row["pbudate"];
		 

	$field4name = new DateTime("@$field4name");
        $field5name = $row["derdencode"]; 
        $field6name = $row["vpstatus"]; 
        $field7name = $row["mount"]; 

        $field7name=substr($field7name, 0, 150);
 $status_colors = array(1 => '#00FF00', 0 => '#FF0000');

        echo '<tr> 
                  <td><font face="Verdana">'.$field1name.'</font></td> 
                  <td><font face="Verdana">'.$field2name.'</font></td> 
                  <td><font face="Verdana">'.$field3name.'</font></td> 
                  <td><font face="Verdana">'.$field4name->format('d/m/Y H:i:s').'</font></td> 
                  <td><font face="Verdana">'.$field5name.'</font></td> 
                  <td style="background-color: '.$status_colors[$field6name].' " ><font face="Verdana">'.$field6name.'</font></td> 
                  <td><font face="Verdana">'.$field7name.'</font></td> 
              </tr>';
    }
    $result->free();
echo "</table>";
} 

?>
</body>
</html>