<?php include 'config.php';
//Select data from database
$query=$_GET["query"];
$getData = "select * from lukes_donor_registration where is_active=1 ".$query;
//echo $getData;
$qur = $connection->query($getData);

while($r = mysqli_fetch_assoc($qur)){

$msg[] = array("id" => $r['id'],
"DonorName" => $r['donor_name'], 
"AddressLine1" => $r['address_line1'], 
"AddressLine2" => $r['address_line2'],
"PhoneNo1" => $r['phone_no1'],
"PhoneNo2" => $r['phone_no2'],
"LandLineNo1" => $r['landline_no1'],
"LandLineNo2" => $r['landline_no2'],
"FileName" => $r['donor_file_name'],
"Reference" => $r['reference'],
"RelatedFiles" => $r['related_files'],
"EmailId1" => $r['email_id1'],
"EmailId2" => $r['email_id2'],
"donor_annual" => $r['donor_annual'],
"donor_fd" => $r['donor_fd'],
"donor_things" => $r['donor_things'],
"donor_welfare" => $r['donor_welfare'],
"donor_annual" => $r['donor_annual'],
"donor_fd" => $r['donor_fd'],
"donor_things" => $r['donor_things'],
"donor_welfare" => $r['donor_welfare'],
"support_cs" => $r['support_cs'],
"support_fs" => $r['support_fs'],
"support_bs" => $r['support_bs'],
"support_cloth" => $r['support_cloth'],
"support_other" => $r['support_other'],
"sr_ooc" => $r['sr_ooc'],
"sr_ntc" => $r['sr_ntc'],
"sr_post" => $r['sr_post'],
"sr_visitor" => $r['sr_visitor'],
"sr_email" => $r['sr_email']
);
}
$json = $msg;

header('content-type: application/json');
echo json_encode($json);

@mysqli_close($conn);

?>