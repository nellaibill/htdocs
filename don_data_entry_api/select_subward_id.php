<?php

$response = array();
include 'config_old.php';
$con = mysql_connect($host, $uname, $pwd) or die("connection failed");
mysql_select_db($db, $con) or die("db selection failed");
$xSelectedWardId=$_REQUEST['selectedWardId'];
$result = mysql_query("select * from subward where ward_id=".$xSelectedWardId) or die(mysql_error());
if (mysql_num_rows($result) > 0)
{
    $response["success"] = 1;
    $response["subward_data"] = array();
    while ($row = mysql_fetch_array($result))
    {
        $subward_data = array();
        $subward_data["label"] = $row["subward_name"];
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
