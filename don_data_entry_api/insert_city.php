<?php
include 'config_old.php';
$xCityName=$_REQUEST['cityname'];
if (strlen($xCityName)>=1)
{
$con = mysql_connect($host,$uname,$pwd) or die("connection failed");
mysql_select_db($db,$con) or die("db selection failed");
$flag['code']=0;
$xQry="insert into city(city_name) values('$xCityName') ";
if($r=mysql_query($xQry,$con))
{
	$flag['code']=1;
}
}

print(json_encode($flag));
mysql_close($con);
?>