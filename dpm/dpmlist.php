<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
</head>
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>
<?php 
include('../db_connection.php');

$mysqli = opencon(); 

echo "<div>Dit zijn de  klanten die cloudbackup hebben via Azure backup server (MABS).<br><br>Er zijn vijf versies in omloop, namelijk MABS v2 = DPM 12.0.332.0, MABS v3 = DPM 13.0.415.0, MABS v3 SP1 = DPM 13.0.580.0, MABS v3 SP2 = DPM 13.0.657.0 en tenslotte MABS v4 = DPM 14.0.30.0</div>";



$query="select mabsversion,count(*) from dpmserverstats where mabsversion <> '' and credat = subdate(current_date, 0) group by mabsversion;";
$php_data_array = Array(); 

$resultx = $mysqli->query($query) ;

while ($row = $resultx->fetch_row()) {
    $php_data_array[] = $row; 
   }

echo "<script>var my_2d = ".json_encode($php_data_array)."</script>";

$query="select marsversion,count(*) from dpmserverstats where marsversion <> '' and credat = subdate(current_date, 1) group by marsversion;";
$php_data_array2 = Array(); 

$resultx = $mysqli->query($query) ;

while ($row = $resultx->fetch_row()) {
    $php_data_array2[] = $row; 
   }

echo "<script>var my_2d2 = ".json_encode($php_data_array2)."</script>";

echo "<div id='chart_div' style='float:left;'></div>";
echo "<div id='chart_div2' style='float:left;'></div>";

echo "<div class='divTable blueTable'>

<div class='divTableHeading'>
  <div class='divTableHead'><a id='a' class='filter__link' href='#'>DPM servernaam</a></div>
  <div class='divTableHead'><a id='b' class='filter__link' href='#'>MARS versie</a></div>
  <div class='divTableHead'><a id='c' class='filter__link' href='#'>MABS versie</a></div>
  <div class='divTableHead'><a id='d' class='filter__link filter__link--number' href='#'>uptime (dagen)</a></div>
  <div class='divTableHead'><a id='e' class='filter__link filter__link--number' href='#'>Vrije ruimte C: schijf (GB)</a></div>
  <div class='divTableHead'><a id='f' class='filter__link filter__link--number' href='#'>OS versie</a></div>
  <div class='divTableHead'><a id='g' class='filter__link filter__link--number' href='#'>Memory (GB)</a></div>
  <div class='divTableHead'><a id='h' class='filter__link filter__link--number' href='#'>Vrij Memory (GB)</a></div>
    
</div>

<div class='divTableBody'>";
$query3="

SELECT 
    *
FROM
    dpmserverstats
WHERE
	date(credat) = curdate()
    and
    dpmserverstats_id IN (SELECT 
            MAX(dpmserverstats_id)
        FROM
            dpmserverstats
        GROUP BY dpmservername);

";
#$result=$mysqli->query($query3);
#$data=mysqli_fetch_assoc($result);
if ($result = $mysqli->query($query3)) { 
    while ($row = $result->fetch_assoc()) { 
        $field2name = $row["dpmservername"]; 
        $field3name = $row["marsversion"]; 
        $field4name = $row["mabsversion"]; 
        $field5name = $row["uptime"]; $field5name=round($field5name/24);
        $field6name = $row["freespacecdrive"]; 
        $field7name = $row["osversion"]; 
        $field8name = $row["tmemory"]; 
        $field9name = $row["fmemory"]; 
        
        echo "<div class='divTableRow'>

        <div class='divTableCell'>$field2name</div>
        <div class='divTableCell'>$field3name</div>
        <div class='divTableCell'>$field4name</div>
        <div class='divTableCell'>$field5name</div>
        <div class='divTableCell'>$field6name</div>
        <div class='divTableCell'>$field7name</div>
        <div class='divTableCell'>$field8name</div>
        <div class='divTableCell'>$field9name</div>

        
        </div>";
    } 
}



echo "</div></div>";






?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
 google.charts.load('current', {'packages':['corechart']});
     // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart);
      // Callback that draws the pie chart
      function draw_my_chart() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        var data2 = new google.visualization.DataTable();
        data.addColumn('string', '');
        data2.addColumn('string', '');
        data.addColumn('number', '');
        data2.addColumn('number', '');
		for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);

    for(i = 0; i < my_2d2.length; i++)
    data2.addRow([my_2d2[i][0], parseInt(my_2d2[i][1])]);
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {is3D:true,
                       width:400,
                       height:300};

        // Instantiate and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        var chart2 = new google.visualization.PieChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
        chart2.draw(data2, options);
      }
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