<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
RAS server statistieken<br><br>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>
<?php 
include('../db_connection.php'); $mysqli = opencon(); 


$query1="select count(*) as total from raslogon where which = 'RASSRV01A';";
$query2="select count(*) as total from raslogon where which = 'RASSRV01B';";
$query3="select count(*) as total from raslogon where which = 'RASSRV01C';";
$query4="select count(*) as total from raslogon where which = 'RASSRV01D';";
$query5="select count(*) as total from raslogon where which = 'RASSRV01E';";
$query6="select count(*) as total from raslogon where which = 'RASSRV01F';";
$query7="select count(*) as total from raslogon where which = 'RASSRV01G';";
$query8="select count(*) as total from raslogon where which = 'RASSRV01H';";
$query9="select count(*) as total from raslogon where which = 'RASSRV01I';";
$query10="select count(*) as total from raslogon where which = 'RASSRV01J';";
$query11="select count(*) as total from raslogon where which = 'RASSRV01K';";
$query12="select count(*) as total from raslogon where which = 'RASSRV01L';";
$query13="select count(*) as total from raslogon where which = 'RASSRV01M';";
$query14="select count(*) as total from raslogon where which = 'RASSRV01N';";
$query15="select count(*) as total from raslogon where which = 'RASSRV01O';";
$query16="select count(*) as total from raslogon where which = 'RASSRV01P';";
$query17="select count(*) as total from raslogon where which = 'RASSRV01Q';";
$query18="select count(*) as total from raslogon where which = 'RASSRV01R';";
$query19="select count(*) as total from raslogon where which = 'RASSRV01S';";
$query20="select count(*) as total from raslogon where which = 'RASSRV01T';";
$query21="select count(*) as total from raslogon where which = 'RASSRV01U';";
$query22="select count(*) as total from raslogon where which = 'RASSRV01V';";
$query23="select count(*) as total from raslogon where which = 'RASSRV01W';";
$query24="select count(*) as total from raslogon where which = 'RASSRV01X';";
$query25="select count(*) as total from raslogon where which = 'RASSRV01Y';";
$query26="select count(*) as total from raslogon where which = 'RASSRV01Z';";



$result1=$mysqli->query($query1);
$data1=mysqli_fetch_assoc($result1);

$result2=$mysqli->query($query2);
$data2=mysqli_fetch_assoc($result2);

$result3=$mysqli->query($query3);
$data3=mysqli_fetch_assoc($result3);

$result4=$mysqli->query($query4);
$data4=mysqli_fetch_assoc($result4);

$result5=$mysqli->query($query5);
$data5=mysqli_fetch_assoc($result5);

$result6=$mysqli->query($query6);
$data6=mysqli_fetch_assoc($result6);

$result7=$mysqli->query($query7);
$data7=mysqli_fetch_assoc($result7);

$result8=$mysqli->query($query8);
$data8=mysqli_fetch_assoc($result8);

$result9=$mysqli->query($query9);
$data9=mysqli_fetch_assoc($result9);

$result10=$mysqli->query($query10);
$data10=mysqli_fetch_assoc($result10);

$result11=$mysqli->query($query11);
$data11=mysqli_fetch_assoc($result11);

$result12=$mysqli->query($query12);
$data12=mysqli_fetch_assoc($result12);

$result13=$mysqli->query($query13);
$data13=mysqli_fetch_assoc($result13);

$result14=$mysqli->query($query14);
$data14=mysqli_fetch_assoc($result14);

$result15=$mysqli->query($query15);
$data15=mysqli_fetch_assoc($result15);

$result16=$mysqli->query($query16);
$data16=mysqli_fetch_assoc($result16);

$result17=$mysqli->query($query17);
$data17=mysqli_fetch_assoc($result17);

$result18=$mysqli->query($query18);
$data18=mysqli_fetch_assoc($result18);

$result19=$mysqli->query($query19);
$data19=mysqli_fetch_assoc($result19);

$result20=$mysqli->query($query20);
$data20=mysqli_fetch_assoc($result20);

$result21=$mysqli->query($query21);
$data21=mysqli_fetch_assoc($result21);

$result22=$mysqli->query($query22);
$data22=mysqli_fetch_assoc($result22);

$result23=$mysqli->query($query23);
$data23=mysqli_fetch_assoc($result23);

$result24=$mysqli->query($query24);
$data24=mysqli_fetch_assoc($result24);

$result25=$mysqli->query($query25);
$data25=mysqli_fetch_assoc($result25);

$result26=$mysqli->query($query26);
$data26=mysqli_fetch_assoc($result26);


echo 'RASSRV01A (totaal:'.$data1['total']." sessions).<br>";
echo 'RASSRV01B (totaal:'.$data2['total']." sessions).<br>";
echo 'RASSRV01C (totaal:'.$data3['total']." sessions).<br>";
echo 'RASSRV01D (totaal:'.$data4['total']." sessions).<br>";
echo 'RASSRV01E (totaal:'.$data5['total']." sessions).<br>";
echo 'RASSRV01F (totaal:'.$data6['total']." sessions).<br>";
echo 'RASSRV01G (totaal:'.$data7['total']." sessions).<br>";
echo 'RASSRV01H (totaal:'.$data8['total']." sessions).<br>";
echo 'RASSRV01I (totaal:'.$data9['total']." sessions).<br>";
echo 'RASSRV01J (totaal:'.$data10['total']." sessions).<br>";
echo 'RASSRV01K (totaal:'.$data11['total']." sessions).<br>";
echo 'RASSRV01L (totaal:'.$data12['total']." sessions).<br>";
echo 'RASSRV01M (totaal:'.$data13['total']." sessions).<br>";
echo 'RASSRV01N (totaal:'.$data14['total']." sessions).<br>";
echo 'RASSRV01O (totaal:'.$data15['total']." sessions).<br>";
echo 'RASSRV01P (totaal:'.$data16['total']." sessions).<br>";
echo 'RASSRV01Q (totaal:'.$data17['total']." sessions).<br>";
echo 'RASSRV01R (totaal:'.$data18['total']." sessions).<br>";
echo 'RASSRV01S (totaal:'.$data19['total']." sessions).<br>";
echo 'RASSRV01T (totaal:'.$data20['total']." sessions).<br>";
echo 'RASSRV01U (totaal:'.$data21['total']." sessions).<br>";
echo 'RASSRV01V (totaal:'.$data22['total']." sessions).<br>";
echo 'RASSRV01W (totaal:'.$data23['total']." sessions).<br>";
echo 'RASSRV01X (totaal:'.$data24['total']." sessions).<br>";
echo 'RASSRV01Y (totaal:'.$data25['total']." sessions).<br>";
echo 'RASSRV01Z (totaal:'.$data26['total']." sessions).<br>";



?>
 
</body>
</html>