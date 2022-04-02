<?php
include 'config_old.php';
$data1 = json_decode( file_get_contents( 'php://input' ), true ); 
$data=$data1["user"];
$xCandidateName=$data["candidate_name"];
$xFamilyMember=$data["family_member"];
$xGender=$data["gender"];
$xAge=$data["age"];
$xRelationName=$data["relation_name"];
$xRelationType=$data["relation_type"];
$xAddrDoorNo=$data["addr_door_no"];
$xAddrLine1=$data["addr_line1"];
$xAddrLine2=$data["addr_line2"];
$xCityId=$data["selectedCity"];
$xDistrictId=$data["selectedDistrict"];
$xPinCodeId=$data["selectedPincode"];
$xMobileNumber=$data["mobile_number"];
$xSelectedAssembly=$data["selectedAssembly"];
$xSelectedWard=$data["selectedWard"];
$xAssemblyId=$data["assembly_id"];
$WardId=$data["ward_id"];
$SubWardId=$data["subward_id"];
$xEPIC=$data["epic"];

if (strlen($xCandidateName)>=1)
{
$con = mysql_connect($host,$uname,$pwd) or die("connection failed");
mysql_select_db($db,$con) or die("db selection failed");
$flag['code']=0;
$xQry="insert into candidates
(candidate_name,family_member,gender,age,relation_name,relation_type,addr_door_no,addr_line1,addr_line2,city_id,district_id,pincode_id,mobile_number,assembly_id,ward_id,subward_id,epic_number,created)
values('$xCandidateName','$xFamilyMember','$xGender','$xAge','$xRelationName','$xRelationType','$xAddrDoorNo','$xAddrLine1','$xAddrLine2',$xCityId,$xDistrictId,$xPinCodeId,$xMobileNumber,$xAssemblyId,$WardId,$SubWardId,'$xEPIC','2019-11-09 04:30:00') ";
//echo $xQry;
if($r=mysql_query($xQry,$con))
{
	$flag['code']=1;
}
}

print(json_encode($flag));
mysql_close($con);
?>
