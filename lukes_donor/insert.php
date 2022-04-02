<?php
include 'config.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$donor_name = $_POST['donor_name'];
$address_line1 = $_POST['address_line1'];
$address_line2 = $_POST['address_line2'];
$phone_no1 = $_POST['phone_no1'];
$phone_no2 = $_POST['phone_no2'];
$donor_file_name = $_POST['donor_file_name'];
$email_id1 = $_POST['email_id1'];
$email_id2 = $_POST['email_id2'];
$landline_no1 = $_POST['landline_no1'];
$landline_no2 = $_POST['landline_no2'];
$reference = $_POST['reference'];
$related_files = $_POST['related_files'];
$donor_annual = $_POST['donor_annual'];
$donor_fd = $_POST['donor_fd'];
$donor_things = $_POST['donor_things'];
$donor_welfare = $_POST['donor_welfare'];
$support_cs    = $_POST['support_cs'];
$support_fs    = $_POST['support_fs'];
$support_bs    = $_POST['support_bs'];
$support_cloth    = $_POST['support_cloth'];
$support_other  = $_POST['support_other'];
$sr_ooc    = $_POST['sr_ooc'];
$sr_ntc    = $_POST['sr_ntc'];
$sr_post    = $_POST['sr_post'];
$sr_visitor    = $_POST['sr_visitor'];
$sr_email  = $_POST['sr_email'];


$sql = "INSERT INTO `lukes_donor_registration` (
    donor_name,address_line1,address_line2,
    phone_no1,phone_no2,landline_no1,landline_no2,
    donor_file_name,email_id1,email_id2,
    reference,related_files,
    donor_annual,donor_fd,donor_things,donor_welfare,
    support_cs,support_fs,support_bs,support_cloth,support_other,
    sr_ooc,sr_ntc,sr_post,sr_visitor,sr_email
    ) 
VALUES ( 
    '$donor_name','$address_line1','$address_line2',
    '$phone_no1','$phone_no2','$landline_no1','$landline_no2',
    '$donor_file_name','$email_id1','$email_id2',
    '$reference','$related_files',
    '$donor_annual','$donor_fd','$donor_things','$donor_welfare',
    '$support_cs','$support_fs','$support_bs','$support_cloth','$support_other',
    '$sr_ooc','$sr_ntc','$sr_post','$sr_visitor','$sr_email'
    );";
//echo $sql;
if ($connection->query($sql)) {
$msg = array("status" =>1 , "msg" => "Inserted successfully");
} else {
echo "Error: " . $sql . "<br>" . mysqli_error($connection);
}

$json = $msg;

header('content-type: application/json');
echo json_encode($json);


@mysqli_close($conn);

?>