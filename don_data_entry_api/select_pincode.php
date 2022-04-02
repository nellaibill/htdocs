<?php
$response = array();
include 'config_old.php';
$con = mysql_connect($host, $uname, $pwd) or die("connection failed");
mysql_select_db($db, $con) or die("db selection failed");
$result = mysql_query("select * from pincode") or die(mysql_error());
if (mysql_num_rows($result) > 0)
{
    $response["success"] = 1;
    $response["pincode_data"] = array();
    while ($row = mysql_fetch_array($result))
    {
        $pincode_data = array();
        $pincode_data["label"] = $row["pincode_number"];
        $pincode_data["value"] = $row["pincode_id"];
        array_push($response["pincode_data"], $pincode_data);
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
