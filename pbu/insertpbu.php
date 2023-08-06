<html><body>

<form method="post" action="insertpbunames.php">
pbuname : <input type="text" name="pbuname" placeholder="Noteer hier het volledige pad naar de pbu" style="width: 300px;"><br />
Voorbeeld: /mnt/backup/LISA.pbu   Dit moet precies hetzelfde zijn als hetgeen in het pbu script gebruikt wordt.<br><br>
derdencode:

<?php
include('../db_connection.php');
$mysqli = opencon(); 
$query="select * from infoklanten group by derdencode;";

if ($result = $mysqli->query($query)) 
{

    //open the select tag before the loop
    echo"<select name='derdencode'>";
    //populate the select
    while($row = mysqli_fetch_assoc($result)) 
    {
    
       $name=$row["derdencode"];
 
       echo"<option value=".$name.">".$name."</option>"  ;
    }
    //close the select tag after the loop
    echo"</select>";
    echo "<br>";


 } else {echo "0 results";}


?>

<br />
<input type="submit" value="Submit" />
</form>


</body></html>