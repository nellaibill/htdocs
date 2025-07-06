<?php
include 'config.php';
    //get search term
    $searchTerm = $_GET['term'];
    	$result = mysql_query ( "SELECT * FROM m_item WHERE itemname LIKE '%".$searchTerm."%' ORDER BY itemname ASC") or die ( mysql_error () );
	while ( $row = mysql_fetch_array ( $result ) ) {
        $data[] = $row['itemname'];    
    }
    
    //return json data
    echo json_encode($data);
?>