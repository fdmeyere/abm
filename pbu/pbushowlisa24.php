<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
Welke LISA databases werden gebackupped in de afgelopen 24u? En voor welke zijn AfterImages actief?<br><br>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>

<?php 
include('../db_connection.php'); $mysqli = opencon(); 

$tijd=time();
$tijd=$tijd-86400;

$query = "select credat,pbustatus_id,derdencode,pbuname,pbusize,pbudate,SUBSTRING(mount, 1, 50) as mount,vpstatus,aienabled,ipaddress from infoklanten INNER JOIN pbustatus ON infoklanten.sitenr = pbustatus.sitenr where (pbudate>$tijd) and pbuname like '%LISA.pbu%' group by pbustatus_id;";
$result=$mysqli->query($query3);
$data=mysqli_fetch_assoc($result);

$querytotaal = "select count(*) as totaaldb from (select aienabled from infoklanten INNER JOIN pbustatus ON infoklanten.sitenr = pbustatus.sitenr where (pbudate>$tijd or pbudate<100)  and  pbuname like '%LISA.pbu%' group by pbustatus_id) t;";
$totaal=$mysqli->query($querytotaal);
$totaaldb=mysqli_fetch_assoc($totaal);
$totaaldb=$totaaldb['totaaldb'];

$queryaienabled = "select count(*) as aantalaienabled from (select aienabled from infoklanten INNER JOIN pbustatus ON infoklanten.sitenr = pbustatus.sitenr where (pbudate>$tijd or pbudate<100) and  aienabled=1 and pbuname like '%LISA.pbu%' group by pbustatus_id) t;";
$aienabled=$mysqli->query($queryaienabled);
$totalaienabled=mysqli_fetch_assoc($aienabled);
$totalaienabled=$totalaienabled['aantalaienabled'];

$percentage=round(100*$totalaienabled/$totaaldb,0);
$percentage2=100-$percentage;

echo "<div id='piechart' style='float:left; width: 400px; height: 200px;'></div>
<div class='divTable blueTable'>
<div class='divTableHeading'>
<div class='divTableHead'><a id='a' class='filter__link' href='#'>ID</a></div>
<div class='divTableHead'><a id='b' class='filter__link' href='#'>IP address</a></div>
<div class='divTableHead'><a id='c' class='filter__link' href='#'>Derdencode</a></div>
<div class='divTableHead'><a id='d' class='filter__link' href='#'>Creatie Datum</a></div>
<div class='divTableHead'><a id='e' class='filter__link filter__link--number' href='#'>grootte (GB)</a></div>
<div class='divTableHead'><a id='f' class='filter__link' href='#'>PBU locatie</a></div>
<div class='divTableHead'><a id='g' class='filter__link' href='#'>PBU datum</a></div>
<div class='divTableHead'><a id='h' class='filter__link' href='#'>Verified?</a></div>
<div class='divTableHead'><a id='i' class='filter__link' href='#'>AI active?</a></div>
<div class='divTableHead'><a id='j' class='filter__link' href='#'>mount</a></div>
</div>
<div class='divTableBody'>";


if ($result = $mysqli->query($query)) {
  while ($row = $result->fetch_assoc()) {



    $field1name = $row["pbustatus_id"];
    $field1aname = $row["ipaddress"];
    $field2name = $row["credat"];
    $field3name = $row["pbuname"];
    $field4name = $row["pbusize"];
    $field4name=round($field4name/1024/1024/1024);
    $field5name = date('d-m-Y H:i:s', $row["pbudate"]); 
    $field6name = $row["derdencode"]; 
    $field7name = $row["vpstatus"]; 
    $field8name = $row["aienabled"]; 
    $field9name = $row["mount"]; 
    $status_colors = array(1 => '#00FF00', 0 => '#f59300', 2 => '#6600FF');



    echo "<div class='divTableRow'>

    <div class='divTableCell'>$field1name</div>
    <div class='divTableCell'>$field1aname</div>
    <div class='divTableCell'>$field6name</div>
    <div class='divTableCell'>$field2name</div>
    <div class='divTableCell'>$field4name</div>
    <div class='divTableCell'>$field3name</div>
    <div class='divTableCell'>$field5name</div>
    <div style='background-color: ".$status_colors[$field7name]."' class='divTableCell'>$field7name</div>
    <div style='background-color: ".$status_colors[$field8name]."' class='divTableCell'>$field8name</div>
    <div class='divTableCell'>$field9name</div>

    </div>";




      
  }
}


echo "</div></div>";


echo "<script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
<script>
google.charts.load('current', {
        'packages': ['corechart']
      });
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['AI enabled', ''],

          ['AI on', ".$percentage."],
          ['AI off', ".$percentage2."],

        ]);


        var options = {
            slices: {
                0: { color: 'green' },
                1: { color: '#f59300' }
              }, 
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
}";
?>
</script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script> 
<script>
var properties = [
	'a',
	'b',
	'c',
	'd',
	'e',
  'f',
  'g',
  'h',
  'i',
  'j',
  'k',
  'l',
  'm',
  'n',
  'o',
    
];

$.each( properties, function( i, val ) {
	
	var orderClass = '';

	$("#" + val).click(function(e){
		e.preventDefault();
		$('.filter__link.filter__link--active').not(this).removeClass('filter__link--active');
  		$(this).toggleClass('filter__link--active');
   		$('.filter__link').removeClass('asc desc');

   		if(orderClass == 'desc' || orderClass == '') {
    			$(this).addClass('asc');
    			orderClass = 'asc';
       	} else {
       		$(this).addClass('desc');
       		orderClass = 'desc';
       	}

		var parent = $(this).closest('.divTableHead');
    		var index = $(".divTableHead").index(parent);
		var $table = $('.divTableBody');
		var rows = $table.find('.divTableRow').get();
		var isSelected = $(this).hasClass('filter__link--active');
		var isNumber = $(this).hasClass('filter__link--number');
			
		rows.sort(function(a, b){

			var x = $(a).find('.divTableCell').eq(index).text();
    			var y = $(b).find('.divTableCell').eq(index).text();
				
			if(isNumber == true) {
    					
				if(isSelected) {
					return x - y;
				} else {
					return y - x;
				}

			} else {
			
				if(isSelected) {		
					if(x < y) return -1;
					if(x > y) return 1;
					return 0;
				} else {
					if(x > y) return -1;
					if(x < y) return 1;
					return 0;
				}
			}
    		});

		$.each(rows, function(index,row) {
			$table.append(row);
		});

		return false;
	});

});
</script> 

<script src="https://code.jquery.com/jquery-1.12.4.min.js" 
        integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" 
        crossorigin="anonymous">
</script>
</body>
</html>