<?php
include 'config_old.php';
$xWardNo=$_REQUEST['wardno'];
$xSubWardName=$_REQUEST['subward_name'];
if (strlen($xSubWardName)>=1)
{
$con = mysql_connect($host,$uname,$pwd) or die("connection failed");
mysql_select_db($db,$con) or die("db selection failed");
$flag['code']=0;
$xQry="insert into subward(ward_id,subward_name) values('$xWardNo','$xSubWardName') ";
echo $xQry;
if($r=mysql_query($xQry,$con))
{
	$flag['code']=1;
}
}

print(json_encode($flag));
mysql_close($con);
?>