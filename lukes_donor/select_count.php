<?php include 'config.php';
//Select data from database
//$query=$_GET["query"];
$getData = "SELECT id,
COUNT(*) TotalCount,
SUM(donor_annual=1) DonorAnnualCount,
SUM(donor_fd=1) DonorFDCount,
SUM(donor_things=1) DonorThingsCount,
SUM(donor_welfare=1) DonorWelfareCount,
SUM(support_cs=1) SupportCSCount,
SUM(support_fs=1) SupportFSCount,
SUM(support_bs=1) SupportBSCount,
SUM(support_cloth=1) SupportClothCount,
SUM(support_other=1) SupportOtherCount,
SUM(sr_ooc=1) SROOCCount,
SUM(sr_ntc=1) SRNTCCount,
SUM(sr_post=1) SRPostCount,
SUM(sr_visitor=1) SRVisitorCount,
SUM(sr_email=1) SREmailCount
FROM lukes_donor_registration";
//echo $getData;
$qur = $connection->query($getData);

while($r = mysqli_fetch_assoc($qur)){

$msg[] = array(
"TotalCount" => $r['TotalCount'], 
"DonorAnnualCount" => $r['DonorAnnualCount'], 
"DonorFDCount" => $r['DonorFDCount'], 
"DonorThingsCount" => $r['DonorThingsCount'], 
"DonorWelfareCount" => $r['DonorWelfareCount'],
"SupportCSCount" => $r['SupportCSCount'], 
"SupportFSCount" => $r['SupportFSCount'], 
"SupportBSCount" => $r['SupportBSCount'], 
"SupportClothCount" => $r['SupportClothCount'], 
"SupportOtherCount" => $r['SupportOtherCount'], 
"SROOCCount" => $r['SROOCCount'], 
"SRNTCCount" => $r['SRNTCCount'], 
"SRPostCount" => $r['SRPostCount'], 
"SRVisitorCount" => $r['SRVisitorCount'], 
"SREmailCount" => $r['SREmailCount'], 
);
}
$json = $msg;

header('content-type: application/json');
echo json_encode($json);

@mysqli_close($conn);

?>