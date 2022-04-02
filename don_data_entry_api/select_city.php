<?php

$response = array();
include 'config_old.php';
$con = mysql_connect($host, $uname, $pwd) or die("connection failed");
mysql_select_db($db, $con) or die("db selection failed");
$result = mysql_query("select * from city") or die(mysql_error());
if (mysql_num_rows($result) > 0)
{
    $response["success"] = 1;
    $response["city_data"] = array();
    while ($row = mysql_fetch_array($result))
    {
        $city_data = array();
        $city_data["label"] = $row["city_name"];
        $city_data["value"] = $row["city_id"];
        array_push($response["city_data"], $city_data);
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
