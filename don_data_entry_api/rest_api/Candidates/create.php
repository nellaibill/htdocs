<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


include_once '../config/Database.php';
include_once '../class/Candidates.php';
 
$database = new Database();
$db = $database->getConnection();
 
$candidates = new Candidates($db);
 
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->candidate_name) && !empty($data->family_member) &&
!empty($data->gender) && !empty($data->relation_name) &&
!empty($data->created)){    

    $candidates->candidate_name = $data->candidate_name;
    $candidates->family_member = $data->family_member;
    $candidates->gender = $data->gender;
    $candidates->relation_name = $data->relation_name;	
    $candidates->created = date('Y-m-d H:i:s'); 
    
    if($candidates->create()){         
        http_response_code(201);         
        echo json_encode(array("message" => "Item was created."));
    } else{         
        http_response_code(503);        
        echo json_encode(array("message" => "Unable to create item."));
    }
}else{    
    http_response_code(400);    
    echo json_encode(array("message" => "Unable to create item. Data is incomplete."));
}
?>