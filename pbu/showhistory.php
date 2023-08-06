<html><body>

<form method="post" action="showhistory_pbunames_id.php">
Selecteer hier de backup voor welke je de historiek wilt zien:<br><br>
<?php
include('../db_connection.php');
$mysqli = opencon(); 
$query="select * from pbunames order by derdencode;";

if ($result = $mysqli->query($query)) 
{

    //open the select tag before the loop
    echo"<select name='pbunames'>";
    //populate the select
    while($row = mysqli_fetch_assoc($result)) 
    {
    
      $pbunames_id=$row["pbunames_id"]; 
      $name=$row["pbuname"];
      $derdencode=$row["derdencode"];
 
       echo "<option value=".$pbunames_id.">".$derdencode." (".$name.")</option>"  ;
    }
    //close the select tag after the loop
    echo"</select>";
    
    echo "<br>";


 } else {echo "0 results";}


?>

<br />
<input type="submit" value="Doe het!" />
</form>


</body></html>