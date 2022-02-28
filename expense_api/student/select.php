<?php include 'config.php';
//Select data from database

$getData = "select * from staff";
$qur = $connection->query($getData);

while($r = mysqli_fetch_assoc($qur)){

$msg[] = array("staff_id" => $r['staff_id'],
"staff_name" => $r['staff_name'], 
"staff_phone" => $r['staff_phone'], 
"staff_email" => $r['staff_email'],
"staff_gender" => $r['staff_gender'],
"staff_dob" => $r['staff_dob'],
"staff_age" => $r['staff_age']
);
}
$json = $msg;

header('content-type: application/json');
echo json_encode($json);

@mysqli_close($conn);

?>