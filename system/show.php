<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>
<?php  
include('../db_connection.php'); $mysqli = opencon(); 
function mysqli_last_result($link) {
    while (mysqli_more_results($link)) {
        mysqli_use_result($link); 
        mysqli_next_result($link);
    }
    return mysqli_store_result($link);
  }
#servers met defecte disken
$query="


SELECT 
    MAX(credat) as credat,
    any_value(id_hpeservers) as id_hpeservers,
    any_value(JSON_UNQUOTE(JSON_EXTRACT(data, '$.serialnumber'))) AS serienummer,
    any_value(JSON_UNQUOTE(JSON_EXTRACT(data, '$.computername'))) AS naam,
    any_value(JSON_UNQUOTE(JSON_EXTRACT(data, '$.producttype'))) AS producttype
FROM
    hpeservers
WHERE
    (JSON_EXTRACT(data, '$.diskinfo') LIKE '%PredictiveFail%'
        OR JSON_EXTRACT(data, '$.diskinfo') LIKE '%Failed%')
        AND DATE(credat) = CURDATE()
        AND credat > NOW() - INTERVAL 3 HOUR
GROUP BY naam;

"; 

#servers met normale telemetrie vandaag
$query2="

SELECT  max(credat) as credat,
        any_value(id_hpeservers) as id_hpeservers,
        any_value(json_unquote(JSON_EXTRACT(data, '$.serialnumber'))) as serienummer,
        any_value(json_unquote(JSON_EXTRACT(data, '$.computername'))) as naam,
        any_value(json_unquote(JSON_EXTRACT(data, '$.producttype'))) as producttype,
        any_value(json_unquote(JSON_EXTRACT(data, '$.firmware[0].Version'))) as ilo,
        any_value(json_unquote(JSON_EXTRACT(data, '$.firmware[1].Version'))) as bios
FROM hpeservers 
WHERE date(credat) = curdate()
GROUP BY naam;


";

#servers zonder telemetrie
$query3="
drop table if exists t_0;
drop table if exists t_1;

create temporary table t_0
SELECT  max(credat) as credat,
        any_value(id_hpeservers) as id_hpeservers,
        any_value(json_unquote(JSON_EXTRACT(data, '$.serialnumber'))) as serienummer,
        any_value(json_unquote(JSON_EXTRACT(data, '$.computername'))) as naam,
        any_value(json_unquote(JSON_EXTRACT(data, '$.producttype'))) as producttype

FROM hpeservers 
WHERE date(credat) = subdate(curdate(),7)
GROUP BY naam;

create temporary table t_1
SELECT  max(credat) as credat,
        any_value(id_hpeservers),
        any_value(json_unquote(JSON_EXTRACT(data, '$.serialnumber'))) as serienummer,
        any_value(json_unquote(JSON_EXTRACT(data, '$.computername'))) as naam,
        any_value(json_unquote(JSON_EXTRACT(data, '$.producttype'))) as producttype
FROM hpeservers 
WHERE date(credat) = subdate(curdate(),0)
GROUP BY naam;

SELECT * FROM t_0 WHERE t_0.naam not IN ( SELECT t_1.naam FROM t_1);

";

echo "
Deze servers rapporteren fouten op niveau DISK!:
<br>
<div class='divTable blueTable'>
<div class='divTableHeading'>
<div class='divTableRow'>
<div class='divTableHead'>ID</div>
<div class='divTableHead'>Datum</div>
<div class='divTableHead'>Serienummer</div>
<div class='divTableHead'>Naam</div>
<div class='divTableHead'>ProductType</div>
</div>
</div>
<div class='divTableBody'>

";




if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["id_hpeservers"];
        $field2name = $row["credat"];
        $field3name = $row["serienummer"];
        $field4name = $row["naam"]; 
        $field5name = $row["producttype"]; 

        
        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field1name</div>
        <div class='divTableCell'>$field2name</div>        
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>$field5name</div>

                </div>";
    }


    }
    

echo "


    </div>
    </div>
";   
    
    echo "
    <br>Deze servers hebben ons geen telemetrie bezorgd vandaag:
    <br>
    <div class='divTable blueTable'>
    <div class='divTableHeading'>
    <div class='divTableRow'>
    <div class='divTableHead'>ID</div>
    <div class='divTableHead'>Datum</div>
    <div class='divTableHead'>Serienummer</div>
    <div class='divTableHead'>Naam</div>
    <div class='divTableHead'>ProductType</div>
    </div>
    </div>
    <div class='divTableBody'>
    
    ";
    
mysqli_multi_query($mysqli, $query3);
$result3 = mysqli_last_result($mysqli);
$rowcount3=mysqli_num_rows($result3);
    
    
    if ($rowcount3>0) {
        while ($row = $result3->fetch_assoc()) {
            $field1name = $row["id_hpeservers"];
            $field2name = $row["credat"];
            $field3name = $row["serienummer"];
            $field4name = $row["naam"]; 
            $field5name = $row["producttype"]; 
    
            
            echo "<div class='divTableRow'>
            <div class='divTableCell'>$field1name</div>
            <div class='divTableCell'>$field2name</div>        
            <div class='divTableCell'>$field3name</div>
            <div class='divTableCell'>$field4name</div>
            <div class='divTableCell'>$field5name</div>
    
                    </div>";
        }
    
    
        }
        
    
    echo "
    
    
        </div>
        </div>
    
<br>Deze " ; 
$result2 = $mysqli->query($query2);
$num_rows = mysqli_num_rows($result2);
echo $num_rows; echo " servers rapporteren vandaag zoals normaal:<br>
<div class='divTable blueTable'>
<div class='divTableHeading'>
<div class='divTableRow'>
<div class='divTableHead'>ID</div>
<div class='divTableHead'>Datum</div>
<div class='divTableHead'>Serienummer</div>
<div class='divTableHead'>Naam</div>
<div class='divTableHead'>ProductType</div>
<div class='divTableHead'>iLO versie</div>
<div class='divTableHead'>BIOS</div>
</div>
</div>
<div class='divTableBody'>
 ";

if ($result2 = $mysqli->query($query2)) {
    while ($row = $result2->fetch_assoc()) {
        $field1name = $row["id_hpeservers"];
        $field2name = $row["credat"];
        $field3name = $row["serienummer"];
        $field4name = $row["naam"]; 
        $field5name = $row["producttype"]; 
        $field6name = $row["ilo"]; 
        $field7name = $row["bios"]; 
                
        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field1name</div>
        <div class='divTableCell'>$field2name</div>        
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>$field5name</div>
        <div class='divTableCell'>$field6name</div>
        <div class='divTableCell'>$field7name</div>

                </div>";
    }


    }
    ?>



    </div>
    </div>


    </body>
    </html>

