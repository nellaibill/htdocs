<?php
$response = array();
include 'config_old.php';
$con = mysql_connect($host, $uname, $pwd) or die("connection failed");
mysql_select_db($db, $con) or die("db selection failed");
$result = mysql_query("select * from assembly order by assembly_id") or die(mysql_error());
if (mysql_num_rows($result) > 0)
{
    $response["success"] = 1;
    $response["assembly_data"] = array();
    while ($row = mysql_fetch_array($result))
    {
        $assembly_data = array();
        $assembly_data["label"] = $row["assembly_id"] ."- " . $row["assembly_name"];
        $assembly_data["value"] = $row["assembly_id"];
        array_push($response["assembly_data"], $assembly_data);
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
