<?php
include 'globalfile.php';
// include connection file
include_once ("connection.php");

// initilize all variable
$params = $columns = $totalRecords = $data = array ();

$params = $_REQUEST;

// define index of column
$columns = array (
		0 => 'id',
		1 => '',
		2 => '',
		3 => '',
		4 => '',
		5 => '',
		6 => '' ,
		7 => '',
		8 => '',
		9 => '',
		10 => '',		
		11=> '',
		12=> '',
		13=> '',
		14=> '',
		15=> '',
		16=> '',
		17=> '',
		18=> '',
		19=> ''
);

$where = $sqlTot = $sqlRec = "";

// check search value exist
if (! empty ( $params ['search'] ['value'] )) {
	$where .= " WHERE ";
	$where .= " ( patient_name LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR relation_name LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR occupation LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR religion LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR caste LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR address_line_1 LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR address_line_2 LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR address_line_3 LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR address_line_4 LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR address_line_5 LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR phone_no LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR hospital_no LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR patient_status LIKE '" . $params ['search'] ['value'] . "%' ";
	$where .= " OR lr_no LIKE '" . $params ['search'] ['value'] . "%' )";
}

// getting total number records without any search
$sql = "SELECT * FROM `patient_data` ";
$sqlTot .= $sql;
$sqlRec .= $sql;
// concatenate search sql if value exist
if (isset ( $where ) && $where != '') {
	
	$sqlTot .= $where;
	$sqlRec .= $where;
}

$sqlRec .= " ORDER BY " . $columns [$params ['order'] [0] ['column']] . "   " . $params ['order'] [0] ['dir'] . "  LIMIT " . $params ['start'] . " ," . $params ['length'] . " ";

$queryTot = mysqli_query ( $conn, $sqlTot ) or die ( "database error:" . mysqli_error ( $conn ) );

$totalRecords = mysqli_num_rows ( $queryTot );

$queryRecords = mysqli_query ( $conn, $sqlRec ) or die ( "error to fetch employees data" );

// iterate on results row and create new index array of data
while ( $row = mysqli_fetch_row ( $queryRecords ) ) {
	$data [] = $row;
}

$json_data = array (
		"draw" => intval ( $params ['draw'] ),
		"recordsTotal" => intval ( $totalRecords ),
		"recordsFiltered" => intval ( $totalRecords ),
		"data" => $data 
) // total data array
;

echo json_encode ( $json_data ); // send data as json format
?>
