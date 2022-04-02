<?php

$response = array();
include 'config_old.php';
$con = mysqli_connect($host, $uname, $pwd,$db) or die("connection failed");
//mysql_select_db($db, $con) or die("db selection failed");
$result = mysqli_query($con,"select ca.*,c.*,d.*,p.*,a.*,w.*,sw.* from candidates ca,
city c,
district d,
pincode p,
assembly a,
ward w,
subward sw
where ca.city_id=c.city_id
and ca.district_id=d.district_id
and ca.pincode_id=p.pincode_id
and ca.assembly_id=a.assembly_id
and ca.ward_id=w.ward_id
and ca.subward_id=sw.subward_id
") or die(mysql_error());
if (mysqli_num_rows($result) > 0)
{
    $response["success"] = 1;
    $response["candidate_data"] = array();
    while ($row = mysqli_fetch_array($result))
    {
        $candidate_data = array();
        $candidate_data["candidate_name"] = $row["candidate_name"];
        $candidate_data["family_member"] = $row["family_member"];
        $candidate_data["gender"] = $row["gender"];
        $candidate_data["age"] = $row["age"];
        $candidate_data["relation_name"] = $row["relation_name"];
        $candidate_data["relation_type"] = $row["relation_type"];
        $candidate_data["addr_door_no"] = $row["addr_door_no"];
        $candidate_data["addr_line1"] = $row["addr_line1"];
        $candidate_data["addr_line2"] = $row["addr_line2"];
        $candidate_data["city_name"] = $row["city_name"];
        $candidate_data["district_name"] = $row["district_name"];
        $candidate_data["pincode_number"] = $row["pincode_number"];
        $candidate_data["mobile_number"] = $row["mobile_number"];
        $candidate_data["assembly_name"] = $row["assembly_id"]."-".$row["assembly_name"];       
        $candidate_data["ward_name"] = $row["ward_no"]."-".$row["ward_name"];
        $candidate_data["subward_name"] = $row["ward_name"] . " - " . $row["subward_name"];
        $candidate_data["epic_number"] = $row["epic_number"];

        array_push($response["candidate_data"], $candidate_data);
    }
    echo json_encode($response);
}
else
{
    $response["success"] = 0;
    $response["message"] = "Nothing found";
    echo json_encode($response);
}
?>

