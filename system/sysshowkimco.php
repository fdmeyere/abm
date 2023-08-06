<!DOCTYPE html>
<html lang="en">
<head>

<link rel="stylesheet" href="../css/tabel.css">
<link rel="stylesheet" href="../css/test.css">
</head>
Overzicht HIMA resources.<br><br> 
<a href=https://azurebackupmonitor.azurewebsites.net>Ga terug.</a><br><br>

<div class="divTable blueTable">

<div class='divTableHeading'>
<div class='divTableHead'><a id='a' class='filter__link' href='#'>ID</a></div>
<div class='divTableHead'><a id='b' class='filter__link' href='#'>Credat</a></div>
<div class='divTableHead'><a id='c' class='filter__link filter__link--number' href='#'>Uptime (dagen)</a></div>
<div class='divTableHead'><a id='d' class='filter__link filter__link--number' href='#'>free /usr2 (GB)</a></div>
<div class='divTableHead'><a id='e' class='filter__link filter__link--number' href='#'>free /tmp (GB)</a></div>
<div class='divTableHead'><a id='f' class='filter__link filter__link--number' href='#'>free /data (GB)</a></div>
<div class='divTableHead'><a id='g' class='filter__link filter__link--number' href='#'>free / (GB)</a></div>
<div class='divTableHead'><a id='h' class='filter__link filter__link--number' href='#'>Use Swap (%)</a></div>
<div class='divTableHead'><a id='i' class='filter__link filter__link--number' href='#'>Use Memory (%)</a></div>

</div>

<div class="divTableBody">

<?php 
include('../db_connection.php'); $mysqli = opencon(); 

$tijd=time();
$tijd=$tijd-86400;

$query = "select * from system where hostname='hima-db01' GROUP BY DATE_FORMAT(credat, '%d-%m-%y') order by system_id asc;" ;


if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["system_id"];
        $field2name = $row["credat"];
        $field3name = $row["uptime"];$field3name=round($field3name/24);
        $field4name = $row["freeusr2"];$field4name=round($field4name/1024/1024/1024);
        $field5name = $row["freetmp"];$field5name=round($field5name/1024/1024/1024);
        $field6name = $row["freedata"];$field6name=round($field6name/1024/1024/1024);
        $field7name = $row["freeroot"];$field7name=round($field7name/1024/1024/1024);
        $field8name = $row["swapusage"];
        $field9name = $row["memusage"];     

        
        
        $status_colors = array(1 => '#00FF00', 0 => '#FF0000');

        echo "<div class='divTableRow'>
        <div class='divTableCell'>$field1name</div>
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
?>
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