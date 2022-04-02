<?php
include 'config_old.php';
$xWardNo=$_REQUEST['wardno'];
$xWardName=$_REQUEST['wardname'];
if (strlen($xWardName)>=1)
{
$con = mysql_connect($host,$uname,$pwd) or die("connection failed");
mysql_select_db($db,$con) or die("db selection failed");
$flag['code']=0;
$xQry="insert into ward(ward_no,ward_name) values('$xWardNo','$xWardName') ";
echo $xQry;
if($r=mysql_query($xQry,$con))
{
	$flag['code']=1;
}
}

print(json_encode($flag));
mysql_close($con);
?>