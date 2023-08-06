<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>HTML TABLE</title>
<style rel="stylesheet" type="text/css">
th { 
  font-weight: bold;
  text-align: left;
}
</style>
</head><body>
<meta http-equiv='refresh' content='10'>

<font face='Segoe UI' size=2>
    
<?php 
date_default_timezone_set('Europe/Brussels');
include('db_connection.php');

$mysqli = opencon(); 
$query="create temporary table raslogonlive select * from raslogon where signinstatus=2;";
$queryA="insert into raslogonlive select * from raslogon where which='RASSRV01A' order by raslogon_id desc limit 1 ;";
$queryB="insert into raslogonlive select * from raslogon where which='RASSRV01B' order by raslogon_id desc limit 1 ;";
$queryC="insert into raslogonlive select * from raslogon where which='RASSRV01C' order by raslogon_id desc limit 1 ;";
$queryD="insert into raslogonlive select * from raslogon where which='RASSRV01D' order by raslogon_id desc limit 1 ;";
$queryE="insert into raslogonlive select * from raslogon where which='RASSRV01E' order by raslogon_id desc limit 1 ;";
$queryF="insert into raslogonlive select * from raslogon where which='RASSRV01F' order by raslogon_id desc limit 1 ;";
$queryG="insert into raslogonlive select * from raslogon where which='RASSRV01G' order by raslogon_id desc limit 1 ;";
$queryH="insert into raslogonlive select * from raslogon where which='RASSRV01H' order by raslogon_id desc limit 1 ;";
$queryI="insert into raslogonlive select * from raslogon where which='RASSRV01I' order by raslogon_id desc limit 1 ;";
$queryJ="insert into raslogonlive select * from raslogon where which='RASSRV01J' order by raslogon_id desc limit 1 ;";
$queryK="insert into raslogonlive select * from raslogon where which='RASSRV01K' order by raslogon_id desc limit 1 ;";
$queryL="insert into raslogonlive select * from raslogon where which='RASSRV01L' order by raslogon_id desc limit 1 ;";
$queryM="insert into raslogonlive select * from raslogon where which='RASSRV01M' order by raslogon_id desc limit 1 ;";
$queryN="insert into raslogonlive select * from raslogon where which='RASSRV01N' order by raslogon_id desc limit 1 ;";
$queryO="insert into raslogonlive select * from raslogon where which='RASSRV01O' order by raslogon_id desc limit 1 ;";
$queryP="insert into raslogonlive select * from raslogon where which='RASSRV01P' order by raslogon_id desc limit 1 ;";
$queryQ="insert into raslogonlive select * from raslogon where which='RASSRV01Q' order by raslogon_id desc limit 1 ;";
$queryR="insert into raslogonlive select * from raslogon where which='RASSRV01R' order by raslogon_id desc limit 1 ;";
$queryS="insert into raslogonlive select * from raslogon where which='RASSRV01S' order by raslogon_id desc limit 1 ;";
$queryT="insert into raslogonlive select * from raslogon where which='RASSRV01T' order by raslogon_id desc limit 1 ;";
$queryU="insert into raslogonlive select * from raslogon where which='RASSRV01U' order by raslogon_id desc limit 1 ;";
$queryV="insert into raslogonlive select * from raslogon where which='RASSRV01V' order by raslogon_id desc limit 1 ;";
$queryW="insert into raslogonlive select * from raslogon where which='RASSRV01W' order by raslogon_id desc limit 1 ;";
$queryX="insert into raslogonlive select * from raslogon where which='RASSRV01X' order by raslogon_id desc limit 1 ;";
$queryY="insert into raslogonlive select * from raslogon where which='RASSRV01Y' order by raslogon_id desc limit 1 ;";
$queryZ="insert into raslogonlive select * from raslogon where which='RASSRV01Z' order by raslogon_id desc limit 1 ;";


$result=$mysqli->query($query);
$resultA=$mysqli->query($queryA);
$resultB=$mysqli->query($queryB);
$resultC=$mysqli->query($queryC);
$resultD=$mysqli->query($queryD);
$resultE=$mysqli->query($queryE);
$resultF=$mysqli->query($queryF);
$resultG=$mysqli->query($queryG);
$resultH=$mysqli->query($queryH);
$resultI=$mysqli->query($queryI);
$resultJ=$mysqli->query($queryJ);
$resultK=$mysqli->query($queryK);
$resultL=$mysqli->query($queryL);
$resultM=$mysqli->query($queryM);
$resultN=$mysqli->query($queryN);
$resultO=$mysqli->query($queryO);
$resultP=$mysqli->query($queryP);
$resultQ=$mysqli->query($queryQ);
$resultR=$mysqli->query($queryR);
$resultS=$mysqli->query($queryS);
$resultT=$mysqli->query($queryT);
$resultU=$mysqli->query($queryU);
$resultV=$mysqli->query($queryV);
$resultW=$mysqli->query($queryW);
$resultX=$mysqli->query($queryX);
$resultY=$mysqli->query($queryY);
$resultZ=$mysqli->query($queryZ);


$query0="select * from raslogonlive where signinstatus=0 ;";
$result0=$mysqli->query($query0);

$query1="select * from raslogonlive where signinstatus=1 ;";
$result1=$mysqli->query($query1);

echo "Vrije RASSRV01's op "; $currentDateTime = date('d/m/Y H:i:s'); echo $currentDateTime; echo ".<br>";

if ($result0 = $mysqli->query($query0)) {
  while ($row = $result0->fetch_assoc()) {
  $field1name = $row["which"];    
      echo "<a href=https://intranet.cce.be/rasinfo/rassrv01";echo substr($field1name,8,1); echo ".rdp>"; echo substr($field1name,8,1); echo "</a>&nbsp";
  }
}
echo '</table><br>';
echo "<br>Volledige lijst van de aangemelde gebruikers.<br>";
echo '<table border="0" cellspacing="2" cellpadding="2"> 
<tr> 
    <th>System</th> 
    <th>Name</th> 
    <th>Logontime</th> 
 </tr>';

if ($result1 = $mysqli->query($query1)) {
  while ($row = $result1->fetch_assoc()) {
  $field1name = substr($row["which"],8,1);
  $field2name = $row["who"];
  $field3name = $row["signinoutat"]; 
      
      
      echo '<tr> 
                <td>'.$field1name.'
                <td>'.$field2name.'
                <td>'.$field3name.'
                
            </tr>';
  }
}
echo '</table><P>Gegroet, het CCE SE Team.</P></font>';
                                             
 ?>
</body>
</html>