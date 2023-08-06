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

$query2="select count(*) as total from dpmitems;";
$result=$mysqli->query($query2);
$data=mysqli_fetch_assoc($result);
echo '<br>Dit zijn alle backup items verspreid over de bovenstaande klanten (totaal:'.$data['total'].").";

$query1 = "select * from dpmitems order by derdencode;";
echo "<div class='divTable blueTable'>

<div class='divTableHeading'>
  <div class='divTableHead'><a id='x' class='filter__link' href='#'>ID</a></div>
  <div class='divTableHead'><a id='y' class='filter__link' href='#'>Derdencode</a></div>
  <div class='divTableHead'><a id='z' class='filter__link' href='#'>Protected Item</a></div>
 
</div>



<div class='divTableBody'>";


 
if ($result = $mysqli->query($query1)) {
    while ($row = $result->fetch_assoc()) {
	$field1name = $row["dpmitems_id"];
	$field3name = $row["protecteditem"];
	$field2name = $row["derdencode"]; 
        
        

    echo "<div class='divTableRow'>
    <div class='divTableCell'>$field1name</div>
    <div class='divTableCell'>$field2name</div>
    <div class='divTableCell'>$field3name</div>
    
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
	'x',
	'y',
  'z',
    
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