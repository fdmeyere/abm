<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>
PBU statistieken<br><br>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>
<?php 

function mysqli_last_result($link) {
    while (mysqli_more_results($link)) {
        mysqli_use_result($link); 
        mysqli_next_result($link);
    }
    return mysqli_store_result($link);
}

include('../db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") { $pbunames_id = filter_var($_POST["pbunames"], FILTER_SANITIZE_STRING); }


$mysqli = opencon(); 
      $sql="select * from pbunames where pbunames_id=$pbunames_id;";

$result=$mysqli->query($sql);

while ($row = $result->fetch_assoc()) {
    $field1name = $row["derdencode"]; 
    $field2name = $row["pbuname"]; 
       echo "De backup ".$field2name." van ".$field1name." groeit tot en met 10/11/2020 met gemiddeld <b>";
}
$mysqli -> close();

$mysqli = opencon(); 
      $sql="select @pbunames_id:=pbunames_id,@pbuname:=pbuname from pbunames where pbunames_id=$pbunames_id;";
      $sql.="select @derdencode:=derdencode from pbunames where pbunames_id=@pbunames_id;";
      $sql.="create temporary table t_table select @sitenr:=sitenr from infoklanten where derdencode=@derdencode;";
      $sql.="create temporary table t_table2 select pbudate,pbusize from pbustatus  where sitenr in(select * from t_table) and pbuname=@pbuname and pbudate<1604966400;";
      $sql.="select @a:= pbudate from t_table2 order by pbusize asc limit 1;";
      $sql.="select @c:= pbudate from t_table2 order by pbusize desc limit 1;";
      $sql.="select @b:= pbusize from t_table2 order by pbusize asc limit 1;";
      $sql.="select @d:= pbusize from t_table2 order by pbusize desc limit 1;";
      $sql.="select (@d-@b)/(@c-@a)*0.08049;";
mysqli_multi_query($mysqli, $sql);
$result = mysqli_last_result($mysqli);

while ($row = $result->fetch_assoc()) {
    $field1name = $row["(@d-@b)/(@c-@a)*0.08049"]; 
       echo round($field1name,1); echo "</b> MB per dag. Op die dag werd de -com parameter gedeployed naar alle backups waardoor een nieuwe berekening noodzakelijk werd.<br>";
}
$mysqli -> close();

$mysqli = opencon(); 
      $sql="select @pbunames_id:=pbunames_id,@pbuname:=pbuname from pbunames where pbunames_id=$pbunames_id;";
      $sql.="select @derdencode:=derdencode from pbunames where pbunames_id=@pbunames_id;";
      $sql.="create temporary table t_table select @sitenr:=sitenr from infoklanten where derdencode=@derdencode;";
      $sql.="create temporary table t_table2 select pbudate,pbusize from pbustatus  where sitenr in(select * from t_table) and pbuname=@pbuname and pbudate>1604966400;";
      $sql.="select @a:= pbudate from t_table2 order by pbusize asc limit 1;";
      $sql.="select @c:= pbudate from t_table2 order by pbusize desc limit 1;";
      $sql.="select @b:= pbusize from t_table2 order by pbusize asc limit 1;";
      $sql.="select @d:= pbusize from t_table2 order by pbusize desc limit 1;";
      $sql.="select (@d-@b)/(@c-@a)*0.08049;";
mysqli_multi_query($mysqli, $sql);
$result = mysqli_last_result($mysqli);

while ($row = $result->fetch_assoc()) {
    $field1name = $row["(@d-@b)/(@c-@a)*0.08049"]; 
       echo "De toename sinds 10/11/2020 bedraagt <b>".round($field1name,1)."</b> MB per dag.<br><br>";
}
$mysqli -> close();

$mysqli = opencon(); 

echo "
<div class='divTable blueTable'>
<div class='divTableHeading'>
<div class='divTableRow'>
<div class='divTableHead'>PBU datum</div>
<div class='divTableHead'>PBU grootte</div>
</div>
</div>
<div class='divTableBody'>";

$sql="select @pbunames_id:=pbunames_id,@pbuname:=pbuname from pbunames where pbunames_id=$pbunames_id;";
$sql.="select @derdencode:=derdencode from pbunames where pbunames_id=@pbunames_id;";
$sql.="create temporary table t_table select @sitenr:=sitenr from infoklanten where derdencode=@derdencode;";
$sql.="select pbudate,pbusize from pbustatus  where sitenr in(select * from t_table) and pbuname=@pbuname;";
mysqli_multi_query($mysqli, $sql);
$result = mysqli_last_result($mysqli);

while ($row = $result->fetch_assoc()) {
    $field1name = $row["pbudate"]; $field1name = new DateTime("@$field1name");
    $field2name = $row["pbusize"];
    $field2name=round($field2name/1024/1024/1024);

    echo "<div class='divTableRow'><div class='divTableCell'>".$field1name->format('d/m/Y H:i')."</div><div class='divTableCell'>".$field2name."</div></div>";
    #echo "<div class='divTableRow'><div class='divTableCell'>".$field1name."</div><div class='divTableCell'>".$field2name."</div></div>";
    
}

$mysqli -> close();

?>
</div>
</div>
</body>
</html>