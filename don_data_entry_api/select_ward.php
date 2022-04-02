<?php

$response = array();
include 'config_old.php';
$con = mysql_connect($host, $uname, $pwd) or die("connection failed");
mysql_select_db($db, $con) or die("db selection failed");
$result = mysql_query("select * from ward") or die(mysql_error());
if (mysql_num_rows($result) > 0)
{
    $response["success"] = 1;
    $response["ward_data"] = array();
    while ($row = mysql_fetch_array($result))
    {
        $ward_data = array();
        $ward_data["label"] = $row["ward_no"] ."- " .$row["ward_name"];
        $ward_data["value"] = $row["ward_id"];
        array_push($response["ward_data"], $ward_data);
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
