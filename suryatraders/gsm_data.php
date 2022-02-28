<?php
//setting header to json
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'hellotam_saleem');
define('DB_PASSWORD', 'hellotamila');
define('DB_NAME', 'hellotam_suryatraders');

//get connection
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed: " . $mysqli->error);
}

//query to get data from the table
$query = sprintf("SELECT g.gsmname,count(i.gsmno)as gsmcount FROM `bill_suryatraders_section2` i ,m_gsm g 
where g.gsmno=i.gsmno
group by i.gsmno");

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