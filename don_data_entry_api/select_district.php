<?php

$response = array();
include 'config_old.php';
$con = mysql_connect($host, $uname, $pwd) or die("connection failed");
mysql_select_db($db, $con) or die("db selection failed");
$result = mysql_query("select * from district") or die(mysql_error());
if (mysql_num_rows($result) > 0)
{
    $response["success"] = 1;
    $response["district_data"] = array();
    while ($row = mysql_fetch_array($result))
    {
        $district_data = array();
        $district_data["label"] = $row["district_name"];
        $district_data["value"] = $row["district_id"];
        array_push($response["district_data"], $district_data);
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
