<?php
include 'config.php';
//Delete record from database

$staffId = $_POST['staff_id'];

$query = "DELETE FROM `staff` WHERE   `staff_id`='$staffId'";
if ($connection->query($query)) {
    $msg = array("status" =>1 , "msg" => "Record Deleted successfully");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
} 

$json = $msg;

header('content-type: application/json');
echo json_encode($json);

@mysqli_close($conn);
?>