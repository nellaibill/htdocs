<?php
include 'config.php';
$staff_name = $_POST['staff_name'];
$staff_phone = $_POST['staff_phone'];
$staff_email = $_POST['staff_email'];
$staff_gender = $_POST['staff_gender'];
$staff_dob = $_POST['staff_dob'];
$staff_age = $_POST['staff_age'];

$sql = "INSERT INTO `staff` (staff_name,staff_phone,staff_email,staff_gender,staff_dob,staff_age) 
VALUES ( '$staff_name','$staff_phone','$staff_email', '$staff_gender','$staff_dob','$staff_age');";

if ($connection->query($sql)) {
$msg = array("status" =>1 , "msg" => "Your record inserted successfully");
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

$json = $msg;

header('content-type: application/json');
echo json_encode($json);


@mysqli_close($conn);

?>