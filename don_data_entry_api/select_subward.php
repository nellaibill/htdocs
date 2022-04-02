<?php

$response = array();
include 'config_old.php';
$con = mysql_connect($host, $uname, $pwd) or die("connection failed");
mysql_select_db($db, $con) or die("db selection failed");
$result = mysql_query("select w.*,sw.* from subward sw ,
ward w
where sw.ward_id=w.ward_id
") or die(mysql_error());
if (mysql_num_rows($result) > 0)
{
    $response["success"] = 1;
    $response["subward_data"] = array();
    while ($row = mysql_fetch_array($result))
    {
        $subward_data = array();
        $subward_data["label"] = $row["ward_name"] . " - " . $row["subward_name"];
        $subward_data["value"] = $row["subward_id"];
        array_push($response["subward_data"], $subward_data);
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
