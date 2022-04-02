<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Candidates.php';

$database = new Database();
$db = $database->getConnection();
 
$candidates = new Candidates($db);

$candidates->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $candidates->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["candidates"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $id,
            "candidate_name" => $candidate_name,
            "family_member" => $family_member,
			"gender" => $gender,
            "relation_name" => $relation_name,            
			"created" => $created,
            "modified" => $modified			
        ); 
       array_push($itemRecords["candidates"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 
?>