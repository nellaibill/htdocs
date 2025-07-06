<?php
require_once('config1.php');

$xIp= !empty($_POST[ip]) ? "$_POST[ip]" :0;
$xOpl= !empty($_POST[opl]) ? "$_POST[opl]" :0;
$xOpm= !empty($_POST[opm]) ? "$_POST[opm]" :0;
$xLab= !empty($_POST[lab]) ? "$_POST[lab]" :0;
$xScan= !empty($_POST[scan]) ? "$_POST[scan]" :0;
$xXray= !empty($_POST[xray]) ? "$_POST[xray]" :0;
$xEcg= !empty($_POST[ecg]) ? "$_POST[ecg]" :0;
$xOthers= !empty($_POST[others]) ? "$_POST[others]" :0;

$delete ="delete from income where date='$_POST[date]'";
$deleteforxincome ="delete from xincome where date='$_POST[date]'";

 $con->query($delete);
  $con->query($deleteforxincome);



$insert="INSERT INTO income (date,ip,opl,opm,lab,scan,xray,ecg,others)
VALUES
('$_POST[date]',$xIp,$xOpl,$xOpm,$xLab,$xScan,$xXray,$xEcg,$xOthers)";


$insertforxincome="INSERT INTO xincome (date,ip,opl,opm,lab,scan,xray,ecg,others)
VALUES
('$_POST[date]',$xIp,$xOpl,$xOpm,$xLab,$xScan,$xXray,$xEcg,$xOthers)";

$con->query($insert);
$con->query($insertforxincome);
echo '<script language="javascript">';
echo 'alert("Records Inserted")';
echo '</script>';
require_once('index.php');

?>