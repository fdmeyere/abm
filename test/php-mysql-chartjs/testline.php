<?php
//setting header to json
header('Content-Type: application/json');

//database
include('../../db_connection.php');
$mysqli = opencon(); 

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT hostname,date(credat) as datum, freedata/1024/1024/1024 as freedata, freeusr2/1025/1024/1024  as freeusr2, freetmp/1024/1024/1024 as freetmp FROM system where hostname='meli-db01' and credat > (curdate() - interval 28 day) group by datum;");

//execute query
$result = $mysqli->query($query);

//loop through the returned data
$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
